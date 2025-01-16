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
            [
                'category' => 'Струнные',
                'name' => 'Электрогитара Fender Squier Bullet',
                'description' => 'Отличная электрогитара для начинающих музыкантов',
                'price' => 25000,
                'quantity' => 6,
                'country' => 'Индонезия',
                'year' => 2023,
                'model' => 'Bullet Strat'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Синтезатор Roland JUNO-DS61',
                'description' => 'Профессиональный синтезатор с множеством функций',
                'price' => 85000,
                'quantity' => 3,
                'country' => 'Япония',
                'year' => 2023,
                'model' => 'JUNO-DS61'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Виолончель Cremona SC-100',
                'description' => 'Виолончель для учащихся музыкальных школ',
                'price' => 35000,
                'quantity' => 4,
                'country' => 'Чехия',
                'year' => 2023,
                'model' => 'SC-100'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Укулеле Kala KA-15S',
                'description' => 'Сопрано укулеле из красного дерева',
                'price' => 8000,
                'quantity' => 15,
                'country' => 'Китай',
                'year' => 2022,
                'model' => 'KA-15S'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Цифровое пианино Yamaha P-125',
                'description' => 'Портативное цифровое пианино с реалистичным звучанием',
                'price' => 65000,
                'quantity' => 7,
                'country' => 'Япония',
                'year' => 2021,
                'model' => 'P-125'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Альт Hans Klein HKV-7',
                'description' => 'Альт для профессиональных музыкантов',
                'price' => 28000,
                'quantity' => 5,
                'country' => 'Германия',
                'year' => 2023,
                'model' => 'HKV-7'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Бас-гитара Ibanez GSR180',
                'description' => 'Бас-гитара начального уровня с активными звукоснимателями',
                'price' => 32000,
                'quantity' => 4,
                'country' => 'Индонезия',
                'year' => 2022,
                'model' => 'GSR180'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Акустическая гитара Martin D-28',
                'description' => 'Премиальная акустическая гитара с корпусом из массива розового дерева',
                'price' => 280000,
                'quantity' => 2,
                'country' => 'США',
                'year' => 2020,
                'model' => 'D-28'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Электрогитара Gibson Les Paul Standard',
                'description' => 'Легендарная электрогитара с хамбакерами',
                'price' => 195000,
                'quantity' => 3,
                'country' => 'США',
                'year' => 2021,
                'model' => 'Les Paul Standard'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Классическая гитара Cordoba C5',
                'description' => 'Классическая гитара среднего уровня с кедровой декой',
                'price' => 35000,
                'quantity' => 8,
                'country' => 'Португалия',
                'year' => 2022,
                'model' => 'C5'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Банджо Gold Tone CC-100R',
                'description' => 'Резонаторное банджо для кантри и блюграсс',
                'price' => 45000,
                'quantity' => 4,
                'country' => 'США',
                'year' => 2021,
                'model' => 'CC-100R'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Мандолина Kentucky KM-150',
                'description' => 'Традиционная мандолина F-стиля',
                'price' => 38000,
                'quantity' => 5,
                'country' => 'Китай',
                'year' => 2022,
                'model' => 'KM-150'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Рояль Yamaha GB1K',
                'description' => 'Компактный акустический рояль для дома',
                'price' => 1200000,
                'quantity' => 1,
                'country' => 'Япония',
                'year' => 2019,
                'model' => 'GB1K'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Синтезатор Nord Stage 3',
                'description' => 'Профессиональный сценический синтезатор',
                'price' => 320000,
                'quantity' => 2,
                'country' => 'Швеция',
                'year' => 2020,
                'model' => 'Stage 3'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Цифровое пианино Kawai ES920',
                'description' => 'Портативное цифровое пианино премиум-класса',
                'price' => 125000,
                'quantity' => 4,
                'country' => 'Япония',
                'year' => 2021,
                'model' => 'ES920'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Аккордеон Weltmeister Achat',
                'description' => 'Полный аккордеон 120 басов',
                'price' => 185000,
                'quantity' => 2,
                'country' => 'Германия',
                'year' => 2020,
                'model' => 'Achat'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Синтезатор Korg Minilogue XD',
                'description' => 'Аналоговый полифонический синтезатор',
                'price' => 75000,
                'quantity' => 6,
                'country' => 'Япония',
                'year' => 2021,
                'model' => 'Minilogue XD'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Скрипка Stradivarius копия',
                'description' => 'Высококачественная копия знаменитой скрипки',
                'price' => 150000,
                'quantity' => 2,
                'country' => 'Италия',
                'year' => 2018,
                'model' => 'Strad Copy'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Виолончель Yamaha VC5S',
                'description' => 'Виолончель среднего уровня 4/4',
                'price' => 120000,
                'quantity' => 3,
                'country' => 'Япония',
                'year' => 2022,
                'model' => 'VC5S'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Контрабас Stentor Student II',
                'description' => 'Учебный контрабас 3/4',
                'price' => 95000,
                'quantity' => 2,
                'country' => 'Китай',
                'year' => 2021,
                'model' => 'Student II'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Электрогитара PRS SE Custom 24',
                'description' => 'Универсальная электрогитара с двумя хамбакерами',
                'price' => 89000,
                'quantity' => 5,
                'country' => 'Южная Корея',
                'year' => 2022,
                'model' => 'SE Custom 24'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Бас-гитара Fender Jazz Bass',
                'description' => 'Классический джазовый бас',
                'price' => 145000,
                'quantity' => 3,
                'country' => 'Мексика',
                'year' => 2020,
                'model' => 'Jazz Bass'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Цифровое пианино Roland FP-90X',
                'description' => 'Профессиональное цифровое пианино',
                'price' => 155000,
                'quantity' => 4,
                'country' => 'Япония',
                'year' => 2021,
                'model' => 'FP-90X'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Акустическая гитара Taylor 214ce',
                'description' => 'Электроакустическая гитара с вырезом',
                'price' => 125000,
                'quantity' => 6,
                'country' => 'США',
                'year' => 2022,
                'model' => '214ce'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Скрипка Franz Hoffmann Amadeus',
                'description' => 'Студенческая скрипка высокого качества',
                'price' => 45000,
                'quantity' => 7,
                'country' => 'Германия',
                'year' => 2021,
                'model' => 'Amadeus'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Синтезатор Moog Subsequent 37',
                'description' => 'Аналоговый монофонический синтезатор',
                'price' => 195000,
                'quantity' => 2,
                'country' => 'США',
                'year' => 2020,
                'model' => 'Subsequent 37'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Электрогитара Jackson Soloist',
                'description' => 'Электрогитара для тяжелой музыки',
                'price' => 115000,
                'quantity' => 4,
                'country' => 'Индонезия',
                'year' => 2022,
                'model' => 'Soloist'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Виола da Gamba',
                'description' => 'Историческая виола для барочной музыки',
                'price' => 280000,
                'quantity' => 1,
                'country' => 'Германия',
                'year' => 2019,
                'model' => 'Baroque'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Цифровое пианино Casio PX-S3100',
                'description' => 'Компактное цифровое пианино с Bluetooth',
                'price' => 85000,
                'quantity' => 8,
                'country' => 'Япония',
                'year' => 2022,
                'model' => 'PX-S3100'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Акустическая гитара Seagull S6',
                'description' => 'Канадская акустическая гитара',
                'price' => 45000,
                'quantity' => 5,
                'country' => 'Канада',
                'year' => 2021,
                'model' => 'S6'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Скрипка Scott Cao STV-850',
                'description' => 'Профессиональная концертная скрипка',
                'price' => 320000,
                'quantity' => 1,
                'country' => 'США',
                'year' => 2020,
                'model' => 'STV-850'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Синтезатор Arturia MatrixBrute',
                'description' => 'Аналоговый модульный синтезатор',
                'price' => 245000,
                'quantity' => 2,
                'country' => 'Франция',
                'year' => 2021,
                'model' => 'MatrixBrute'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Бас-гитара Music Man StingRay',
                'description' => 'Активный бас премиум-класса',
                'price' => 185000,
                'quantity' => 3,
                'country' => 'США',
                'year' => 2022,
                'model' => 'StingRay'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Виолончель Luis and Clark',
                'description' => 'Карбоновая виолончель',
                'price' => 450000,
                'quantity' => 1,
                'country' => 'США',
                'year' => 2020,
                'model' => 'Carbon Fiber'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Цифровое пианино Kawai CA99',
                'description' => 'Премиальное цифровое пианино',
                'price' => 385000,
                'quantity' => 2,
                'country' => 'Япония',
                'year' => 2021,
                'model' => 'CA99'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Электрогитара Gretsch G5422T',
                'description' => 'Полуакустическая электрогитара',
                'price' => 135000,
                'quantity' => 4,
                'country' => 'Корея',
                'year' => 2022,
                'model' => 'G5422T'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Скрипка Yamaha V5SA',
                'description' => 'Студенческая скрипка 4/4',
                'price' => 35000,
                'quantity' => 6,
                'country' => 'Индонезия',
                'year' => 2023,
                'model' => 'V5SA'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Синтезатор Dave Smith Prophet Rev2',
                'description' => 'Полифонический аналоговый синтезатор',
                'price' => 225000,
                'quantity' => 2,
                'country' => 'США',
                'year' => 2020,
                'model' => 'Prophet Rev2'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Акустическая гитара Guild D-55',
                'description' => 'Премиальная акустическая гитара',
                'price' => 235000,
                'quantity' => 2,
                'country' => 'США',
                'year' => 2021,
                'model' => 'D-55'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Альт Otto Benjamin MA200',
                'description' => 'Мастеровой альт',
                'price' => 145000,
                'quantity' => 3,
                'country' => 'Германия',
                'year' => 2022,
                'model' => 'MA200'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Цифровое пианино Yamaha CLP-785',
                'description' => 'Топовое цифровое пианино Clavinova',
                'price' => 425000,
                'quantity' => 2,
                'country' => 'Япония',
                'year' => 2021,
                'model' => 'CLP-785'
            ],
            [
                'category' => 'Струнные',
                'name' => 'Электрогитара ESP E-II Horizon',
                'description' => 'Электрогитара премиум-класса',
                'price' => 165000,
                'quantity' => 3,
                'country' => 'Япония',
                'year' => 2022,
                'model' => 'E-II Horizon'
            ],
            [
                'category' => 'Смычковые',
                'name' => 'Контрабас Engelhardt ES9',
                'description' => 'Профессиональный контрабас',
                'price' => 385000,
                'quantity' => 1,
                'country' => 'США',
                'year' => 2020,
                'model' => 'ES9'
            ],
            [
                'category' => 'Клавишные',
                'name' => 'Синтезатор Behringer Poly D',
                'description' => 'Аналоговый полифонический синтезатор',
                'price' => 95000,
                'quantity' => 4,
                'country' => 'Китай',
                'year' => 2021,
                'model' => 'Poly D'
            ]
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
                'image' => 'storage/' . $randomImage, // Путь будет относительно storage/app/public
                'country' => $productData['country'],
                'year' => $productData['year'],
                'model' => $productData['model'],
            ]);
        }
    }
} 