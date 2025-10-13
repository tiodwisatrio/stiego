<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductHighlight;
use Illuminate\Http\Request;

class ProductHighlightController extends Controller
{
    public function index()
    {
        $highlights = ProductHighlight::with('product')->latest()->paginate(10);
        return view('admin.highlights.index', compact('highlights'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.highlights.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'highlight_type' => 'required|in:best_seller,new_series,hot_deals,featured',
            'priority' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        ProductHighlight::create($request->all());

        return redirect()->route('admin.highlights.index')->with('success', 'Highlight added successfully.');
    }

    public function edit(ProductHighlight $highlight)
    {
        $products = Product::all();
        return view('admin.highlights.edit', compact('highlight', 'products'));
    }

    public function update(Request $request, ProductHighlight $highlight)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'highlight_type' => 'required|in:best_seller,new_series,hot_deals,featured',
            'priority' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $highlight->update($request->all());

        return redirect()->route('admin.highlights.index')->with('success', 'Highlight updated successfully.');
    }

    public function destroy(ProductHighlight $highlight)
    {
        $highlight->delete();
        return redirect()->route('admin.highlights.index')->with('success', 'Highlight deleted successfully.');
    }
}
