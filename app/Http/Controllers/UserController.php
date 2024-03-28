<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Mail\ForgotPasswordEmail;
use App\Repository\UserRepository;
use Carbon\Carbon;
use IAnanta\UserManagement\Models\Admin;
use Illuminate\Support\Facades\Mail;
use Exception;
use DataTables;
use Str;
use IAnanta\UserManagement\Repository\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    private $repo, $roleRepo;
    public function __construct(UserRepository $repo, RoleRepository $roleRepo)
    {
        $this->repo = $repo;
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        try {
            if (request()->ajax()) {
                $data = $this->repo->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->rawColumns([])
                    ->make(true);
            }
            return view('admin.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }
    public function create()
    {
        try {
            $data['roles'] = $this->roleRepo->getRoles();
            return view('admin.form')->with($data);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }
    public function store(UserRequest $request)
    {
        try {
            $this->repo->store($request->validated());
            return redirect()->route('admin.user')->with(['message' => 'Users created successfully!', 'type' => 'success']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }

    public function edit($id)
    {
        try {
            $data['roles'] = $this->roleRepo->getRoles();
            $data['user'] = $this->repo->find($id);
            return view('admin.form')->with($data);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $this->repo->update($request->validated(), $id);
            return redirect()->route('admin.user')->with(['message' => 'Users updated successfully!', 'type' => 'success']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }

    public function delete($id)
    {
        try {
            $this->repo->delete($id);
            return redirect()->back()->with(['message' => 'Users deleted successfully!', 'type' => 'success']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }


    public function validatePasswordRequest(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = \DB::table('admins')->where('email', $request->email)->first();
        if (!$user) {
            // dd('error');
            return redirect()->back()->with(['message' => 'Email doesnot exist!', 'type' => 'error']);
        }

        // Create Password Reset Token
        $existingToken = \DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if ($existingToken) {
            // If a token already exists for this email, update the existing record
            \DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->update([
                    'token' => Str::random(60),
                    'created_at' => Carbon::now()
                ]);
        } else {
            // If no token exists, insert a new record
            \DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ]);
        }

        // Get the token just created above
        $tokenData = \DB::table('password_reset_tokens')
            ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->back()->with(['message' => 'A reset link has been sent to your email address.', 'type' => 'success']);
        } else {
            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }
    }

    private function sendResetEmail($email, $token)
    {
        // Retrieve the user from the database
        $user = \DB::table('admins')->where('email', $email)->select('name', 'email')->first();

        // Generate the password reset link
        $link = url('/') . '/password/reset/' . $token;
        dd($link);
        // try {
        //     Mail::to($user->email)->send(new ForgotPasswordEmail($link));
        //     return true;
        // } catch (Exception $e) {
        //     return false;
        // }
    }

    public function passwordReset($token)
    {
        try {
            $email = $this->repo->getPasswordResetEmail($token);
            if ($email) {
                return view('auth.forgotpassword', ['email' => $email]);
            } else {
                return redirect()->back()->with(['message' => 'Email not found!', 'type' => 'error']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }
    public function changePasswordPost(Request $request)
    {
        // dd($request);
        try {
            $request->validate([
                'password' => 'required|min:4',
                'confirm_password' => 'required|same:password',
                'email' => 'required|email'
            ]);

            $email = $request->input('email');
            $result = $this->repo->resetPassword($email, $request->password);

            // dd($result);
            if ($result) {
                return redirect()->route('login')->with(['message' => 'Password has been changed successfully!.', 'type' => 'success']);
            } else {
                return redirect()->back()->with(['message' => 'Failed to change the password!', 'type' => 'error']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }
}
