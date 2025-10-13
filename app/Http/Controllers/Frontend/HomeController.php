<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage with active banners
     */
    public function index(): View
    {
        $banners = Banner::where('banner_status', 1)->get();

        return view('frontend.home', [
            'banners' => $banners
            
        ]);
        
    }


    // Menampilkan beberapa produk unggulan di homepage
    public function featuredProducts(): View
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.home', compact('featuredProducts'));
    }
}