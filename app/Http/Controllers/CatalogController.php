<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact('category_id'),
                AllowedFilter::callback('price_from', fn ($query, $value) => 
                    $query->where('price', '>=', $value)
                ),
                AllowedFilter::callback('price_to', fn ($query, $value) => 
                    $query->where('price', '<=', $value)
                ),
            ])
            ->allowedSorts(['name', 'price', 'year'])
            ->with('category')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::all();

        return view('catalog.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('catalog.show', compact('product'));
    }
} 