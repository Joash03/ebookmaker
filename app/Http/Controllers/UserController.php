<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
 
    public function Login()
    {
        return view('user_login');
    }

    public function Register()
    {
        return view('user_register');
    }

    public function ForgetPassword(Request $request): View
    {
        return view('user_forget_password', ['request' => $request]);
    }

    public function SendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('status', trans($response));
        } else {
            return back()->withErrors(['email' => trans($response)]);
        }
    }

    public function ShowResetForm($token)
    {
        return view('user_reset_password', ['token' => $token, 'email' => request('email')]);
    }

    public function ResetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'], // Update the validation rules as needed
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        Alert::success('PasswordUpdated Successfully');
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('user.login')->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }

}
