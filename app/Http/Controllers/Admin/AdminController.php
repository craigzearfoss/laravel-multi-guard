<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login()
    {
        return view('admin.admin_login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $inputs = $request->all();
        $data = [
            'username' => $inputs['username'],
            'password' => $inputs['password'],
        ];

        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin_dashboard');
        } else {
            return redirect()->route('admin_login')->with('error', 'Invalid login credentials. Please try again.');
        }
    }

    public function admin_logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('success', 'Admin logout successfully.');
    }

    public function forgot_password()
    {
        return view('admin.admin_forgot_password');
    }

    public function forgot_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['email', 'required']
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin with provided email does not exist.');
        }

        $admin->token = hash('sha256', time());
        $admin->update();

        $pResetLink = route('admin_reset_password', ['token' => $admin->token , 'email' => urlencode($request->email)]);
        $subject = "Reset Password";
        $info = [
            'user' => $admin->username,
            'pResetLink' => $pResetLink
        ];

        Mail::to($request->email)->send(new ResetPassword($subject, $info));

        return redirect()->back()->with('success', 'A reset link has been sent to your email address. Please check your
        email. If you do not find the email in your inbox, please check your spam folder.');
    }

    public function reset_password($token, $email)
    {
        $admin = Admin::where('email', $email)->where('token', $token)->first();
        if (!$admin) {
            return redirect()->route('admin_login')->with('error', 'Your reset password token is expired. Please try again.');
        } else {
            return view('admin.reset_password', compact('token', 'email'));
        }
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password']
        ]);

        $admin = Admin::where('email', $email)->where('token', $token)->first();
        if (!$admin) {
            return redirect()->back()->with('error', 'Your reset password token is expired. Please try again.');
        }

        if (Hash::check($request->password, $admin->password)) {
            return redirect()->back()->with('error', ' You cannot use your old password again.');
        }

        $admin->password = Hash::make($request->password);
        $admin->token = null;
        $admin->update();

        return redirect()->route('admin_login')->with('success', 'Your password has been changed. You can login
        with your new password.');
    }
}
