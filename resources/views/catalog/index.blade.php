@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" 
    x-data="catalogFilter()" 
    x-init="loadProducts"
>
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Сайдбар с фильтрами -->
        <div class="w-full md:w-1/4">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">Фильтры</h2>
                
                <form @submit.prevent="applyFilters">
                    <!-- Категории -->
                    <div class="mb-6">
                        <h3 class="font-medium mb-2">Категории</h3>
                        <div class="space-y-2">
                            @foreach($categories as $category)
                            <label class="flex items-center">
                                <input 
                                    type="radio" 
                                    name="category" 
                                    value="{{ $category->id }}"
                                    x-model="filters['filter[category_id]']"
                                    @change="applyFilters"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                >
                                <span class="ml-2">{{ $category->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Цена -->
                    <div class="mb-6">
                        <h3 class="font-medium mb-2">Цена</h3>
                        <div 
                            x-data="{
                                minPrice: 0,
                                maxPrice: 1000000,
                                priceFrom: @json(request()->input('filter.price_from', 0)),
                                priceTo: @json(request()->input('filter.price_to', 1000000)),
                                updateProgress() {
                                    const progress = this.$refs.progress;
                                    const priceGap = 1000;
                                    
                                    if (this.priceTo - this.priceFrom < priceGap) {
                                        if (this.priceTo === this.maxPrice) {
                                            this.priceFrom = this.priceTo - priceGap;
                                        } else {
                                            this.priceTo = this.priceFrom + priceGap;
                                        }
                                    }

                                    const percent1 = ((this.priceFrom - this.minPrice) / (this.maxPrice - this.minPrice)) * 100;
                                    const percent2 = ((this.priceTo - this.minPrice) / (this.maxPrice - this.minPrice)) * 100;
                                    progress.style.left = percent1 + '%';
                                    progress.style.right = (100 - percent2) + '%';

                                    this.filters['filter[price_from]'] = this.priceFrom;
                                    this.filters['filter[price_to]'] = this.priceTo;
                                }
                            }"
                            x-init="updateProgress"
                            @price-changed.debounce.500ms="applyFilters"
                            class="space-y-4"
                        >
                            <!-- Ручной ввод -->
                            <div class="flex items-center gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm text-gray-600 mb-1">От</label>
                                    <input 
                                        type="number" 
                                        x-model.number="priceFrom"
                                        @input="updateProgress(); $dispatch('price-changed')"
                                        min="0"
                                        :max="priceTo - 1000"
                                        step="1000"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                    >
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm text-gray-600 mb-1">До</label>
                                    <input 
                                        type="number" 
                                        x-model.number="priceTo"
                                        @input="updateProgress(); $dispatch('price-changed')"
                                        :min="priceFrom + 1000"
                                        :max="maxPrice"
                                        step="1000"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                    >
                                </div>
                            </div>

                            <!-- Слайдер -->
                            <div class="price-slider">
                                <div class="progress" x-ref="progress"></div>
                            </div>
                            <div class="range-input">
                                <input 
                                    type="range" 
                                    x-model.number="priceFrom"
                                    :min="minPrice"
                                    :max="maxPrice"
                                    step="1000"
                                    @input="updateProgress(); $dispatch('price-changed')"
                                >
                                <input 
                                    type="range" 
                                    x-model.number="priceTo"
                                    :min="minPrice"
                                    :max="maxPrice"
                                    step="1000"
                                    @input="updateProgress(); $dispatch('price-changed')"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Сортировка -->
                    <div class="mb-6">
                        <h3 class="font-medium mb-2">Сортировка</h3>
                        <div class="flex flex-wrap gap-2">
                            <!-- По названию -->
                            <button 
                                type="button" 
                                @click="sortBy('name')"
                                :class="{
                                    'bg-blue-600 text-white': filters.sort === 'name' || filters.sort === '-name',
                                    'bg-gray-100 text-gray-700 hover:bg-gray-200': filters.sort !== 'name' && filters.sort !== '-name'
                                }"
                                class="flex items-center gap-2 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            >
                                <i class="fas fa-font"></i>
                                <i 
                                    :class="{
                                        'fa-sort': filters.sort !== 'name' && filters.sort !== '-name',
                                        'fa-sort-up': filters.sort === 'name',
                                        'fa-sort-down': filters.sort === '-name'
                                    }"
                                    class="fas"
                                ></i>
                            </button>

                            <!-- По цене -->
                            <button 
                                type="button" 
                                @click="sortBy('price')"
                                :class="{
                                    'bg-blue-600 text-white': filters.sort === 'price' || filters.sort === '-price',
                                    'bg-gray-100 text-gray-700 hover:bg-gray-200': filters.sort !== 'price' && filters.sort !== '-price'
                                }"
                                class="flex items-center gap-2 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            >
                                <i class="fas fa-ruble-sign"></i>
                                <i 
                                    :class="{
                                        'fa-sort': filters.sort !== 'price' && filters.sort !== '-price',
                                        'fa-sort-up': filters.sort === 'price',
                                        'fa-sort-down': filters.sort === '-price'
                                    }"
                                    class="fas"
                                ></i>
                            </button>

                            <!-- По году -->
                            <button 
                                type="button" 
                                @click="sortBy('year')"
                                :class="{
                                    'bg-blue-600 text-white': filters.sort === 'year' || filters.sort === '-year',
                                    'bg-gray-100 text-gray-700 hover:bg-gray-200': filters.sort !== 'year' && filters.sort !== '-year'
                                }"
                                class="flex items-center gap-2 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            >
                                <i class="fas fa-calendar-alt"></i>
                                <i 
                                    :class="{
                                        'fa-sort': filters.sort !== 'year' && filters.sort !== '-year',
                                        'fa-sort-up': filters.sort === 'year',
                                        'fa-sort-down': filters.sort === '-year'
                                    }"
                                    class="fas"
                                ></i>
                            </button>
                        </div>
                    </div>

                    <!-- Кнопка сброса -->
                    <button 
                        type="button"
                        @click="resetFilters"
                        class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 mb-4"
                    >
                        <i class="fas fa-undo-alt mr-2"></i>
                        Сбросить фильтры
                    </button>
                </form>
            </div>
        </div>

        <!-- Основной контент -->
        <div class="w-full md:w-3/4">
            <!-- Индикатор загрузки -->
            <div x-show="loading" class="flex justify-center items-center py-12">
                <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>

            <!-- Сетка товаров -->
            <div x-show="!loading" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="product in products" :key="product.id">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img :src="product.image" :alt="product.name" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2" x-text="product.name"></h3>
                            <p class="text-gray-600 mb-2" x-text="product.category.name"></p>
                            <p class="text-gray-800 font-medium mb-4" x-text="formatPrice(product.price)"></p>
                            <a 
                                :href="'/catalog/' + product.id" 
                                class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            >
                                Подробнее
                            </a>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Пагинация -->
            <div class="mt-8 flex justify-center space-x-2">
                <template x-for="link in links" :key="link.label">
                    <button 
                        @click="goToPage(link.url)"
                        :class="{
                            'bg-blue-600 text-white': link.active,
                            'bg-white text-gray-700': !link.active,
                            'opacity-50 cursor-not-allowed': !link.url,
                            'hover:bg-blue-700': link.url && !link.active
                        }"
                        class="px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        x-html="link.label"
                    ></button>
                </template>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function catalogFilter() {
    return {
        filters: {
            'filter[category_id]': @json(request('filter.category_id')),
            'filter[price_from]': @json(request('filter.price_from')),
            'filter[price_to]': @json(request('filter.price_to')),
            'sort': @json(request('sort', 'name'))
        },
        products: [],
        links: [],
        loading: true,
        debounceTimeout: null,

        sortBy(field) {
            if (this.filters.sort === field) {
                this.filters.sort = '-' + field;
            } else if (this.filters.sort === '-' + field) {
                this.filters.sort = field;
            } else {
                this.filters.sort = field;
            }
            this.loadProducts();
        },

        resetFilters() {
            this.filters = {
                'filter[category_id]': null,
                'filter[price_from]': null,
                'filter[price_to]': null,
                'sort': 'name'
            };
            this.loadProducts();
        },

        async loadProducts(url = null) {
            this.loading = true;
            
            const params = new URLSearchParams();
            Object.entries(this.filters).forEach(([key, value]) => {
                if (value !== null && value !== '') {
                    params.append(key, value);
                }
            });

            try {
                const response = await fetch(url || `/api/catalog?${params.toString()}`);
                const data = await response.json();
                
                this.products = data.data;
                this.links = data.meta.links;

                // Обновляем URL без перезагрузки страницы
                window.history.pushState({}, '', `${window.location.pathname}?${params.toString()}`);
            } catch (error) {
                console.error('Error:', error);
            } finally {
                this.loading = false;
            }
        },

        debounceFilters() {
            clearTimeout(this.debounceTimeout);
            this.debounceTimeout = setTimeout(() => {
                this.applyFilters();
            }, 500);
        },

        applyFilters() {
            this.loadProducts();
        },

        goToPage(url) {
            if (url) {
                this.loadProducts(url);
            }
        },

        formatPrice(price) {
            return new Intl.NumberFormat('ru-RU', {
                style: 'currency',
                currency: 'RUB',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(price);
        }
    }
}
</script>
@endpush
@endsection 