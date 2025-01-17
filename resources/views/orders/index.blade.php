@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Мои заказы</h1>

    @if($orders->count() > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h2 class="text-lg font-semibold">Заказ #{{ $order->id }}</h2>
                                <p class="text-gray-600">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-blue-600">
                                    {{ number_format($order->total_amount, 0, '.', ' ') }} ₽
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($order->status === 'new') bg-yellow-200 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-200 text-blue-800
                                    @elseif($order->status === 'completed') bg-emerald-200 text-emerald-800
                                    @elseif($order->status === 'cancelled') bg-rose-200 text-rose-800
                                    @endif">
                                    @switch($order->status)
                                        @case('new')
                                            Новый
                                            @break
                                        @case('processing')
                                            В обработке
                                            @break
                                        @case('completed')
                                            Выполнен
                                            @break
                                        @case('cancelled')
                                            Отменён
                                            @break
                                        @default
                                            {{ $order->status }}
                                    @endswitch
                                </span>
                            </div>
                        </div>

                        <div class="border-t pt-4">
                            <div class="space-y-2">
                                @foreach($order->items as $item)
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <a href="{{ route('catalog.show', $item->product) }}" class="text-blue-600 hover:text-blue-800">
                                                {{ $item->product->name }}
                                            </a>
                                            <span class="text-gray-600">× {{ $item->quantity }}</span>
                                        </div>
                                        <div class="text-gray-900">
                                            {{ number_format($item->price * $item->quantity, 0, '.', ' ') }} ₽
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4 text-right">
                            <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                Подробнее
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500 mb-4">У вас пока нет заказов</p>
            <a href="{{ route('catalog') }}" class="text-blue-600 hover:text-blue-800">Перейти в каталог</a>
        </div>
    @endif
</div>
@endsection 