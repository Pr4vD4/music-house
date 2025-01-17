@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="mb-6">
        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Вернуться к списку заказов
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold mb-2">Заказ #{{ $order->id }}</h1>
                    <p class="text-gray-600">Оформлен: {{ $order->created_at->format('d.m.Y H:i') }}</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
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

            <div class="border-t border-gray-200 pt-6">
                <h2 class="text-lg font-semibold mb-4">Состав заказа</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                            <div class="flex items-center space-x-4">
                                <div>
                                    <h3 class="font-medium">
                                        <a href="{{ route('catalog.show', $item->product) }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $item->product->name }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ number_format($item->price, 0, '.', ' ') }} ₽ × {{ $item->quantity }} шт.
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium">{{ number_format($item->price * $item->quantity, 0, '.', ' ') }} ₽</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6 mt-6">
                <div class="flex justify-between items-center">
                    <div class="text-gray-600">Итого:</div>
                    <div class="text-2xl font-bold">{{ number_format($order->total_amount, 0, '.', ' ') }} ₽</div>
                </div>
            </div>

            @if($order->status === 'cancelled' && $order->rejection_reason)
                <div class="mt-6 p-4 bg-rose-50 rounded-lg">
                    <h3 class="font-medium text-rose-800 mb-2">Причина отмены:</h3>
                    <p class="text-rose-700">{{ $order->rejection_reason }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 