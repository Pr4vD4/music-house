<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем список всех изображений из storage
        $images = Storage::disk('public')->files('images');
        
        if (empty($images)) {
            throw new \Exception('Нет изображений в папке storage/app/public/images. Пожалуйста, добавьте изображения.');
        }

        $products = [
            [
                'category' => 'Струнные',
                'name' => 'Классическая гитара Yamaha C40',
                'description' => 'Классическая гитара начального уровня от известного производителя',
                'price' => 15000,
                'quantity' => 10,
                'country' => 'Япония',
                'year' => 2023,
                'model' => 'C40'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Цифровое пианино Casio CDP-S100',
                'description' => 'Компактное цифровое пианино с молоточковой механикой',
                'price' => 45000,
                'quantity' => 5,
                'country' => 'Япония',
                'year' => 2023,
                'model' => 'CDP-S100'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Скрипка Stagg VN-4/4',
                'description' => 'Скрипка полного размера для начинающих музыкантов',
                'price' => 12000,
                'quantity' => 8,
                'country' => 'Китай',
                'year' => 2023,
                'model' => 'VN-4/4'
            ],
        ];

        foreach ($products as $index => $productData) {
            $category = Category::where('name', $productData['category'])->first();
            
            // Выбираем случайное изображение
            $randomImage = $images[array_rand($images)];

            Product::create([
                'category_id' => $category->id,
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => $productData['description'],
                'price' => $productData['price'],
                'quantity' => $productData['quantity'],
                'image' => $randomImage, // Путь будет относительно storage/app/public
                'country' => $productData['country'],
                'year' => $productData['year'],
                'model' => $productData['model'],
            ]);
        }
    }
} 