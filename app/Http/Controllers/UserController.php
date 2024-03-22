<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repository\UserRepository;
use IAnanta\UserManagement\Models\Admin;
use Illuminate\Support\Facades\Mail;
use Exception;
use DataTables;
use IAnanta\UserManagement\Repository\RoleRepository;

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
                $data = $this->repo->getAll();
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


    public function validatePasswordRequest(UserRequest $request)
    {
        // dd('sdf');
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = \DB::table('admins')->where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
        }

        // Create Password Reset Token
        \DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => \Str::random(60),
            'created_at' => now()
        ]);

        // Get the token just created above
        $tokenData = \DB::table('password_reset_tokens')
            ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
        } else {
            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }
    }

    private function sendResetEmail($email, $token)
    {
        // Retrieve the user from the database
        $user = \DB::table('admins')->where('email', $email)->select('firstname', 'email')->first();

        // Generate the password reset link
        $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);

        try {
            // Mail::to($user->email)->send(new PasswordResetMail($link));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function resetPassword(UserRequest $request)
    {

        // Validation
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|confirmed',
            'token' => 'required'
        ]);

        // Check if payload is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => 'Please complete the form']);
        }

        $password = $request->password;

        $tokenData = \DB::table('password_reset_tokens')->where('token', $request->token)->first();

        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) {
            return view('passwordChange.form');
        }

        // Get the user
        $user = Admin::where('email', $tokenData->email)->first();

        // Redirect the user back if the email is invalid
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email not found']);
        }

        // Hash and update the new password
        $user->password = Hash::make($password);
        $user->save();

        Auth::login($user);

        // Delete the token
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        // Send Email Reset Success Email
        if ($this->sendSuccessEmail($tokenData->email)) {
            return view('index');
        } else {
            return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
        }
    }
}
