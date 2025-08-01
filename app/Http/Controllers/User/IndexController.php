<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Mail\ResetPassword;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        if (Auth::guard('web')->check()) {
            return view('user.dashboard');
        } else {
            return view('front.index');
        }
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function login(Request $request): RedirectResponse|View
    {
        if ($request->isMethod('post')) {

            $inputs = $request->all();
            $email = $inputs['email'] ?? '';

            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $data = [
                'email' => $email,
                'password' => $inputs['password'],
            ];

            if (Auth::guard('web')->attempt($data)) {
                return redirect()->route('homepage');
            } else {
                $title = 'Login';
                return view('user.login', compact('title'))->withErrors('Invalid login credentials. Please try again.');
            }

        } else {

            $title = 'Login';
            return view('user.login', compact('title'));
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('web')->logout();

        return redirect()->route('homepage')->with('error', 'User logout successful.');
    }

    public function forgot_password(Request $request): RedirectResponse|View
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'email' => ['email', 'required']
            ]);

            $email = $request->email ?? '';
            $user = User::where('email', $email)->where('status', 1)->first();
            if (!$user) {
                return view('user.forgot_password')->withErrors('User with provided email does not exist.');
            }

            $user->token = hash('sha256', time());
            $user->update();

            $pResetLink = route('reset_password', ['token' => $user->token, 'email' => urlencode($email)]);
            $subject = "Reset Password from " . config('app.name');
            $info = [
                'user' => $user->name,
                'email' => $user->email,
                'pResetLink' => $pResetLink
            ];

            Mail::to($request->email)->send(new ResetPassword($subject, $info));

            return redirect()->back()->with('success', 'A reset link has been sent to your email address. Please check your
            email. If you do not find the email in your inbox, please check your spam folder.');

        } else {

            $title = 'Forgot Password';
            return view('user.forgot_password', compact('title'));
        }
    }

    public function reset_password($token, $email): RedirectResponse|View
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Your reset password token is expired. Please try again.');
        } else {
            $title = 'Reset Password';
            return view('user.reset_password', compact('token', 'email', 'title'));
        }
    }

    public function reset_password_submit(Request $request, $token, $email): RedirectResponse
    {
        $request->validate([
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password']
        ]);

        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Your reset password token is expired. Please try again.');
        }

        if (Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', ' You cannot use your old password again.');
        }

        $user->password = Hash::make($request->password);
        $user->token = null;
        $user->update();

        return redirect()->route('login')->with('success', 'Your password has been changed. You can login
        with your new password.');
    }

    public function register(Request $request): RedirectResponse|View
    {
        if ($request->isMethod('post') && config('app.open_enrollment')) {

            $request->validate((new UserStoreRequest())->rules());

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->token = hash('sha256', time());
            $user->status = 0;
            $user->disabled = 1;

            $user->save();

            $verificationLink = route('email_verification', ['token' => $user->token, 'email' => urlencode($request->email)]);
            $subject = "Email Verification from " . config('app.name');
            $info = [
                'name' => $user->name,
                'verificationLink' => $verificationLink
            ];

            Mail::to($request->email)->send(new VerifyEmail($subject, $info));

            return redirect()->back()->with('success', 'You need to verify your email to complete your registration.
            We have sent a verification link to your email. If you cannot find the email in your inbox, please check
            your spam folder.');

        } else {

            $title = 'Register';
            return view('user.register', compact('title'));
        }
    }

    public function email_verification($token, $email): RedirectResponse
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->route('login');
        }

        $user->token = null;
        $user->status = 1;
        $user->disabled = 0;
        $user->update();

        $user->markEmailAsVerified();

        return redirect()->route('login')->with('success', 'Your email has been verified. You can now login
        to your account.');
    }

    /**
     * Display the current user.
     */
    public function profile(): View
    {
        $user = Auth::user();

        $title = $user->name;
        return view('user.profile', compact('user', 'title'));
    }

    /**
     * Show the form for editing the current user.
     */
    public function profile_edit(): View
    {
        $user = Auth::user();

        $title = 'Edit My Profile';
        return view('user.profile-edit', compact('user', 'title'));
    }

    /**
     * Update the current user in storage.
     */
    public function profile_update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name'  => ['string', 'min:6', 'max:255'],
            'email' => ['email', 'max:255', 'unique:users,email,'.$user->id],
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile')
            ->with('success', 'Profile updated successfully.');
    }
}
