<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[А-Яа-яЁё\s-]+$/u'],
            'surname' => ['required', 'regex:/^[А-Яа-яЁё\s-]+$/u'],
            'patronymic' => ['nullable', 'regex:/^[А-Яа-яЁё\s-]+$/u'],
            'login' => ['required', 'unique:users', 'regex:/^[A-Za-z0-9-]+$/'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
            'rules' => ['required', 'accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);
        
        return redirect('/')->with('success', 'Регистрация успешно завершена!');
    }
} 