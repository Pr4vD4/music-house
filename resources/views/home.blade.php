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
        
        <div class="swiper-container relative">
            <div class="swiper-wrapper mb-8">
                @foreach($latestProducts as $product)
                    <div class="swiper-slide">
                        <a href="{{ route('catalog') }}" class="block">
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
            
            <div class="swiper-pagination"></div>
            
            <div class="swiper-button-prev absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-6 !text-gray-800"></div>
            <div class="swiper-button-next absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-6 !text-gray-800"></div>
        </div>
    </div>
</div>


@endsection
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
<style>
    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 24px;
        font-weight: bold;
    }
    
    .swiper-button-next,
    .swiper-button-prev {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: #f8f8f8;
    }
    
    .swiper-pagination {
        position: relative;
        bottom: 0;
        margin-top: 1rem;
    }
    
    .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: #ccc;
    }
    
    .swiper-pagination-bullet-active {
        background: #666;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script>
    new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
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
</script>
@endpush 