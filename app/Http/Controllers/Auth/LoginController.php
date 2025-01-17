<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';
        $credentials[$loginType] = $credentials['email'];
        unset($credentials['email']);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if ($request->wantsJson()) {
                return response()->json([
                    'redirect' => route('home')
                ]);
            }

            return redirect()->intended(route('home'));
        }

        if ($request->wantsJson()) {
            return response()->json([
                'errors' => [
                    'email' => ['Неверный логин/email или пароль']
                ]
            ], 422);
        }

        return back()->withErrors([
            'email' => 'Неверный логин/email или пароль',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->wantsJson()) {
            return response()->json(['redirect' => route('login')]);
        }

        return redirect()->route('login');
    }
} 