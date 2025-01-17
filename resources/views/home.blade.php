@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Логотип и девиз -->
    <div class="text-center mb-12">
        <img src="{{ asset('images/logo.png') }}" alt="Music House" class="mx-auto mb-4 h-32">
        <h2 class="text-2xl font-bold text-gray-800">Ваш путь в мир музыки начинается здесь</h2>
    </div>

    <!-- Слайдер новинок -->
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-6">Новинки компании</h3>
        
        <div class="swiper relative w-full h-full">
            <div class="swiper-wrapper">
                @foreach($latestProducts as $product)
                    <div class="swiper-slide">
                        <a href="{{ route('catalog.show', $product) }}" class="block">
                            <div class="bg-white rounded-lg shadow p-4 h-full hover:shadow-lg transition-shadow">
                                <div class="aspect-square mb-4">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                                </div>
                                <h4 class="text-lg font-medium truncate mb-2">{{ $product->name }}</h4>
                                <p class="text-gray-600">{{ number_format($product->price, 0, ',', ' ') }} ₽</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            
            <div class="swiper-pagination !static mt-4"></div>
            <div class="swiper-button-prev !text-gray-800 !-left-6"></div>
            <div class="swiper-button-next !text-gray-800 !-right-6"></div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            }
        });
    });
</script>
@endpush 