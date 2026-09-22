<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    /**
     * Show Register Page
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle Registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:20',
            'referral_code' => 'nullable|string|exists:users,referral_code',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => $validated['password'],
            'role' => 'customer',
            'referral_code' => strtoupper(Str::random(8)),
            'referred_by' => !empty($validated['referral_code'])
                ? User::where(
                    'referral_code',
                    $validated['referral_code']
                )->value('id')
                : null,
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('home')
            ->with(
                'success',
                'Registration successful! Welcome to ShopSphere, ' . $user->name . ' 🎉'
            );
    }

    /**
     * Show Login Page
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle Login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (
            Auth::attempt(
                $credentials,
                $request->boolean('remember')
            )
        ) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'The email or password is incorrect.',
            ])
            ->onlyInput('email');
    }

    /**
     * Show Forgot Password Page
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send Password Reset Link
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors([
                'email' => __($status),
            ]);
    }

    /**
     * Show Reset Password Page
     */
    public function showResetPassword(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Reset Password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function ($user, $password) {

                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(
                    str()->random(60)
                );

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()
                ->route('login')
                ->with(
                    'status',
                    'Your password has been reset successfully. You can now login.'
                )
            : back()->withErrors([
                'email' => [__($status)],
            ]);
    }
}