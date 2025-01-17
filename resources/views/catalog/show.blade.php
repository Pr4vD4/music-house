@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Хлебные крошки -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">
                            Главная
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('catalog') }}" class="text-gray-700 hover:text-blue-600">
                                Каталог
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="text-gray-500">{{ $product->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <!-- Изображение товара -->
                <div class="md:w-1/2">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover">
                </div>

                <!-- Информация о товаре -->
                <div class="p-8 md:w-1/2">
                    <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>
                    
                    <div class="space-y-4">
                        <div>
                            <span class="text-gray-600">Категория:</span>
                            <span class="font-medium">{{ $product->category->name }}</span>
                        </div>
                        
                        <div>
                            <span class="text-gray-600">Производитель:</span>
                            <span class="font-medium">{{ $product->country }}</span>
                        </div>

                        <div>
                            <span class="text-gray-600">Год выпуска:</span>
                            <span class="font-medium">{{ $product->year }}</span>
                        </div>

                        <div>
                            <span class="text-gray-600">Модель:</span>
                            <span class="font-medium">{{ $product->model }}</span>
                        </div>

                        <div>
                            <span class="text-gray-600">В наличии:</span>
                            <span class="font-medium">{{ $product->quantity }} шт.</span>
                        </div>

                        <div class="text-3xl font-bold text-blue-600">
                            {{ number_format($product->price, 0, '.', ' ') }} ₽
                        </div>

                        <p class="text-gray-600">{{ $product->description }}</p>

                        <button 
                            type="button"
                            class="w-full bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            Добавить в корзину
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 