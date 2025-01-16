<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = OrderItem::where('user_id', auth()->id())
            ->whereNull('order_id')
            ->with('product')
            ->get();
            
        return view('cart', compact('cartItems'));
    }
} 