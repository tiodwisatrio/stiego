<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->paginate(12);
            
        return view('frontend.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('frontend.products.show', compact('product'));
    }
}