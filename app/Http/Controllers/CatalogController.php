<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CatalogController extends Controller
{
    public function index()
    {
        $products = Product::where('quantity', '>', 0)->latest()->paginate(12);
        return view('catalog.index', compact('products'));
    }
} 