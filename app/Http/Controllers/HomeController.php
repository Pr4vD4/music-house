<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestProducts = Product::where('quantity', '>', 0)
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('latestProducts'));
    }
} 