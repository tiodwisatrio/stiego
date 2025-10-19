<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductHighlight;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage with active banners
     */
    public function index(): View
    {
        $banners = Banner::where('banner_status', 1)->get();

        $featured = ProductHighlight::with('product.images', 'product.category')
            ->where('highlight_type', 'featured')
            ->whereHas('product')
            ->whereDate('start_date', '<=', today())
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhereDate('end_date', '>=', today());
            })
            ->latest()
            ->take(4)
            ->get()
            ->map(function($highlight) {
                return $highlight->product;
            });
        
        // Get best seller products from product_highlights
        $bestSellers = \App\Models\ProductHighlight::with('product.images', 'product.category')
            ->where('highlight_type', 'best_seller')
            ->whereHas('product')
            ->whereDate('start_date', '<=', today())
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhereDate('end_date', '>=', today());
            })
            ->latest()
            ->take(4)
            ->get()
            ->map(function($highlight) {
                return $highlight->product;
            });

        $newSeries = ProductHighlight::with('product.images', 'product.category')
            ->where('highlight_type', 'new_series')
            ->whereHas('product')
            ->whereDate('start_date', '<=', today())
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhereDate('end_date', '>=', today());
            })
            ->latest()
            ->take(4)
            ->get()
            ->map(function($highlight) {
                return $highlight->product;
            });

            $hotDeals = ProductHighlight::with('product.images', 'product.category')
            ->where('highlight_type', 'hot_deals')
            ->whereHas('product')
            ->whereDate('start_date', '<=', today())
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhereDate('end_date', '>=', today());
            })
            ->latest()
            ->take(4)
            ->get()
            ->map(function($highlight) {
                return $highlight->product;
            });


        // Get testimonials data
        $testimonials = \App\Models\Testimonials::select(
            'testimonial_name as name',
            'testimonial_position as position',
            'testimonial_rating as rating',
            'testimonial_description as message',
            'testimonial_image as image'
        )->get();

        // Convert image path to full URL using Storage::url()
        // Database already stores: "testimonials/filename.jpg"
        foreach ($testimonials as $item) {
            $item->image = \Storage::url($item->image);
        }

        

        return view('frontend.home', [
            'banners' => $banners,
            'featured' => $featured,
            'bestSellers' => $bestSellers,
            'hotDeals' => $hotDeals,
            'newSeries' => $newSeries,
            'testimonials' => $testimonials
        ]);


        
    }



}