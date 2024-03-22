<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use IAnanta\UserManagement\Models\Admin;
use Illuminate\Http\Request;
use Exception;

class ChangePasswordController extends Controller
{

    public function create()
    {
        return view('passwordChange.form');
    }

    public function passwordChange()
    {
        try {
            $auth = Auth::guard('admin')->user();
            if (Hash::check(request()->get('current_password'), $auth->password)) {
                $newPassword =  Hash::make(request()->new_password);
                Admin::where('id', $auth->id)->update([
                    'password' => $newPassword
                ]);
                return redirect()
                    ->back()->with(['message' => 'Password changes successfully', 'type' => 'success']);
            } else {
                return redirect()
                    ->back()->with(['message' => 'Current password did not match', 'type' => 'error']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => 'Somthing were wrong', 'type' => 'error']);
        }
    }
}
