<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductHighlight;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        // Ambil semua product highlights yang masih aktif (dalam rentang tanggal)
        // Gunakan today() untuk mendapatkan tanggal lokal
        $today = today(); // Ini menggunakan timezone dari config/app.php
        
        $highlights = ProductHighlight::with(['product.images', 'product.category', 'product.variants'])
            ->where(function ($query) use ($today) {
                $query->whereDate('start_date', '<=', $today)
                      ->orWhereNull('start_date');
            })
            ->where(function ($query) use ($today) {
                $query->whereDate('end_date', '>=', $today)
                      ->orWhereNull('end_date');
            })
            ->orderBy('priority', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter manual products yang punya variant dengan stock > 0
        $highlights = $highlights->filter(function ($highlight) {
            return $highlight->product && 
                   $highlight->product->variants && 
                   $highlight->product->variants->sum('stock') > 0;
        });

        // Group by highlight type
        $newSeries = $highlights->where('highlight_type', 'new_series');
        $hotDeals = $highlights->where('highlight_type', 'hot_deals');
        $bestSellers = $highlights->where('highlight_type', 'best_seller');
        $featured = $highlights->where('highlight_type', 'featured');

        return view('frontend.catalog.index', compact('highlights', 'newSeries', 'hotDeals', 'bestSellers', 'featured'));
    }

    public function type($type)
    {
        // Validasi highlight type
        $validTypes = ['new_series', 'hot_deals', 'best_seller', 'featured'];
        
        if (!in_array($type, $validTypes)) {
            abort(404);
        }

        // Ambil products berdasarkan highlight type
        // Gunakan today() untuk mendapatkan tanggal lokal
        $today = today(); // Ini menggunakan timezone dari config/app.php
        
        $highlights = ProductHighlight::with(['product.images', 'product.category', 'product.variants'])
            ->where('highlight_type', $type)
            ->where(function ($query) use ($today) {
                $query->whereDate('start_date', '<=', $today)
                      ->orWhereNull('start_date');
            })
            ->where(function ($query) use ($today) {
                $query->whereDate('end_date', '>=', $today)
                      ->orWhereNull('end_date');
            })
            ->orderBy('priority', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter manual products yang punya variant dengan stock > 0
        $highlights = $highlights->filter(function ($highlight) {
            return $highlight->product && 
                   $highlight->product->variants && 
                   $highlight->product->variants->sum('stock') > 0;
        });

        $title = $this->getTypeTitle($type);

        return view('frontend.catalog.type', compact('highlights', 'type', 'title'));
    }

    private function getTypeTitle($type)
    {
        return match($type) {
            'new_series' => 'New Series',
            'hot_deals' => 'Hot Deals',
            'best_seller' => 'Best Sellers',
            'featured' => 'Featured Products',
            default => 'Catalog'
        };
    }
}
