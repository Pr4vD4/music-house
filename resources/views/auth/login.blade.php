@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold text-center mb-6">Вход</h2>

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Email или Логин -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email или Логин</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                    required autofocus>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Пароль -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                    required>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Запомнить меня -->
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <label for="remember" class="ml-2 block text-sm text-gray-700">
                    Запомнить меня
                </label>
            </div>

            @if(session('error'))
                <div class="text-sm text-red-600">
                    {{ session('error') }}
                </div>
            @endif

            <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Войти
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Нет аккаунта? 
            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                Зарегистрироваться
            </a>
        </p>
    </div>
</div>
@endsection 