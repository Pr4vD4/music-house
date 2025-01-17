<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class CatalogController extends Controller
{
    public function index()
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
            ->paginate(12);

        return response()->json($products);
    }
} 