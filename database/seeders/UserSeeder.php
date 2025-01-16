<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем админа
        User::create([
            'name' => 'Admin',
            'surname' => 'Admin',
            'login' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin22'),
            'role' => 'admin',
        ]);

        // Создаем тестового пользователя
        User::create([
            'name' => 'Иван',
            'surname' => 'Иванов',
            'patronymic' => 'Иванович',
            'login' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
} 