@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Уведомления -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Закрыть</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </button>
        </div>
    @endif

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

                        @auth
                            <form x-data="{ 
                                loading: false, 
                                showNotification: false,
                                inCart: {{ Cart::content()->where('id', $product->id)->count() > 0 ? 'true' : 'false' }},
                                cartQty: {{ Cart::content()->where('id', $product->id)->first() ? Cart::content()->where('id', $product->id)->first()->qty : 0 }},
                                async addToCart() {
                                    this.loading = true;
                                    try {
                                        const response = await fetch('{{ route('cart.add', $product) }}', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                                            },
                                            body: JSON.stringify({
                                                quantity: document.getElementById('quantity').value
                                            })
                                        });
                                        
                                        if (response.ok) {
                                            this.inCart = true;
                                            this.cartQty = parseInt(this.cartQty) + parseInt(document.getElementById('quantity').value);
                                            this.showNotification = true;
                                            setTimeout(() => this.showNotification = false, 3000);
                                        }
                                    } catch (error) {
                                        console.error('Ошибка:', error);
                                    } finally {
                                        this.loading = false;
                                    }
                                }
                            }" 
                            @submit.prevent="addToCart">
                                <div x-cloak x-show="showNotification" 
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                                     x-transition:enter-end="opacity-100 transform translate-y-0"
                                     x-transition:leave="transition ease-in duration-300"
                                     x-transition:leave-start="opacity-100 transform translate-y-0"
                                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                                     class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                                    Товар успешно добавлен в корзину
                                </div>

                                <template x-if="cartQty > 0">
                                    <div class="mb-4">
                                        <a href="{{ route('cart.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            В корзине: <span x-text="cartQty" class="ml-2"></span> шт.
                                        </a>
                                    </div>
                                </template>

                                @csrf
                                <div class="flex items-center space-x-4 mb-4">
                                    <label for="quantity" class="text-gray-600">Количество:</label>
                                    <input type="number" 
                                           name="quantity" 
                                           id="quantity" 
                                           value="1" 
                                           min="1" 
                                           max="{{ $product->quantity }}"
                                           class="w-20 rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <button type="submit"
                                        x-bind:disabled="loading"
                                        x-bind:class="{ 'opacity-75 cursor-not-allowed': loading }"
                                        class="w-full bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center justify-center">
                                    <template x-if="loading">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </template>
                                    <span x-text="inCart ? 'Добавить ещё' : 'Добавить в корзину'"></span>
                                </button>
                            </form>
                        @else
                            <div class="text-center">
                                <a href="{{ route('login') }}" 
                                   class="w-full inline-block bg-gray-600 text-white px-6 py-3 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                    Войдите, чтобы добавить в корзину
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 