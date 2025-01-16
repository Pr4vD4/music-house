@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold text-center mb-6">Регистрация</h2>

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Имя -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                    required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Фамилия -->
            <div>
                <label for="surname" class="block text-sm font-medium text-gray-700">Фамилия</label>
                <input type="text" name="surname" id="surname" value="{{ old('surname') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                    required>
                @error('surname')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Отчество -->
            <div>
                <label for="patronymic" class="block text-sm font-medium text-gray-700">Отчество</label>
                <input type="text" name="patronymic" id="patronymic" value="{{ old('patronymic') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                @error('patronymic')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Логин -->
            <div>
                <label for="login" class="block text-sm font-medium text-gray-700">Логин</label>
                <input type="text" name="login" id="login" value="{{ old('login') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                    required>
                @error('login')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                    required>
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

            <!-- Подтверждение пароля -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Подтверждение пароля</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                    required>
            </div>

            <!-- Согласие с правилами -->
            <div class="flex items-center">
                <input type="checkbox" name="rules" id="rules"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <label for="rules" class="ml-2 block text-sm text-gray-700">
                    Я согласен с правилами регистрации
                </label>
            </div>
            @error('rules')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Зарегистрироваться
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Уже есть аккаунт? 
            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                Войти
            </a>
        </p>
    </div>
</div>
@endsection 