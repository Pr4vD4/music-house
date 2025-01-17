@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div x-data="registerForm()" @submit.prevent="submitForm">
            <form>
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="name">
                        Имя
                    </label>
                    <input 
                        x-model="form.name" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                        :class="{'border-red-500': errors.name}"
                        id="name" 
                        type="text" 
                        name="name" 
                        required 
                        autofocus
                    >
                    <template x-if="errors.name">
                        <p x-cloak class="mt-1 text-sm text-red-600" x-text="errors.name[0]"></p>
                    </template>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="surname">
                        Фамилия
                    </label>
                    <input 
                        x-model="form.surname" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                        :class="{'border-red-500': errors.surname}"
                        id="surname" 
                        type="text" 
                        name="surname" 
                        required
                    >
                    <template x-if="errors.surname">
                        <p x-cloak class="mt-1 text-sm text-red-600" x-text="errors.surname[0]"></p>
                    </template>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="patronymic">
                        Отчество
                    </label>
                    <input 
                        x-model="form.patronymic" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                        :class="{'border-red-500': errors.patronymic}"
                        id="patronymic" 
                        type="text" 
                        name="patronymic"
                    >
                    <template x-if="errors.patronymic">
                        <p x-cloak class="mt-1 text-sm text-red-600" x-text="errors.patronymic[0]"></p>
                    </template>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="login">
                        Логин
                    </label>
                    <input 
                        x-model="form.login" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                        :class="{'border-red-500': errors.login}"
                        id="login" 
                        type="text" 
                        name="login" 
                        required
                    >
                    <template x-if="errors.login">
                        <p x-cloak class="mt-1 text-sm text-red-600" x-text="errors.login[0]"></p>
                    </template>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="email">
                        Email
                    </label>
                    <input 
                        x-model="form.email" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                        :class="{'border-red-500': errors.email}"
                        id="email" 
                        type="email" 
                        name="email" 
                        required
                    >
                    <template x-if="errors.email">
                        <p x-cloak class="mt-1 text-sm text-red-600" x-text="errors.email[0]"></p>
                    </template>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="password">
                        Пароль
                    </label>
                    <input 
                        x-model="form.password" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                        :class="{'border-red-500': errors.password}"
                        id="password" 
                        type="password" 
                        name="password" 
                        required
                    >
                    <template x-if="errors.password">
                        <p x-cloak class="mt-1 text-sm text-red-600" x-text="errors.password[0]"></p>
                    </template>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
                        Подтверждение пароля
                    </label>
                    <input 
                        x-model="form.password_confirmation" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        required
                    >
                </div>

                <div class="mt-4">
                    <label class="flex items-center">
                        <input 
                            x-model="form.rules" 
                            type="checkbox" 
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            :class="{'border-red-500': errors.rules}"
                            name="rules"
                        >
                        <span class="ml-2 text-sm text-gray-600">Я согласен с правилами регистрации</span>
                    </label>
                    <template x-if="errors.rules">
                        <p x-cloak class="mt-1 text-sm text-red-600" x-text="errors.rules[0]"></p>
                    </template>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        Уже зарегистрированы?
                    </a>

                    <button 
                        type="submit" 
                        class="ml-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        :class="{ 'opacity-50 cursor-not-allowed': loading }" 
                        :disabled="loading"
                    >
                        <span x-show="loading" x-cloak class="mr-2">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                        Регистрация
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function registerForm() {
    return {
        form: {
            name: '',
            surname: '',
            patronymic: '',
            login: '',
            email: '',
            password: '',
            password_confirmation: '',
            rules: false
        },
        errors: {},
        loading: false,

        async submitForm() {
            this.loading = true;
            this.errors = {};

            try {
                const response = await fetch('/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(this.form)
                });

                const data = await response.json();

                if (!response.ok) {
                    if (response.status === 422) {
                        this.errors = data.errors || {};
                        console.log('Validation errors:', this.errors);
                    } else {
                        console.error('Server error:', data);
                    }
                } else {
                    window.location.href = data.redirect;
                }
            } catch (error) {
                console.error('Error:', error);
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>
@endpush
@endsection 