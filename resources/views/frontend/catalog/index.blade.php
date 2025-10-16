@extends('layouts.frontend')

@section('title', 'Catalog - Product Highlights')

@section('content')
<!-- Catalog Header -->
<div class=" text-white py-12 sm:py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-10">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-3 text-gray-900">Product <span class="text-red-700">Highlights</span></h1>
        <p class="text-base sm:text-lg text-gray-600">Discover our curated selection of highlighted products, featuring the best deals, new arrivals, and top sellers just for you.</p>
    </div>

<!-- Filter Tabs -->
<div class=" sticky top-0 z-10">
    <div class="container mx-auto px-4 sm:px-6 lg:px-10">
        <div class="flex space-x-4 sm:space-x-8 overflow-x-auto py-4">
            <a href="{{ route('frontend.catalog.index') }}" 
               class="whitespace-nowrap px-4 py-2 text-sm sm:text-base font-medium rounded-full transition
                      {{ !request()->route('type') ? 'bg-red-600 text-white' : 'text-gray-600 hover:text-red-600 hover:bg-red-50' }}">
                All Highlights
            </a>
            <a href="{{ route('frontend.catalog.type', 'featured') }}" 
               class="whitespace-nowrap px-4 py-2 text-sm sm:text-base font-medium rounded-full transition
                      {{ request()->route('type') == 'featured' ? 'bg-red-600 text-white' : 'text-gray-600 hover:text-red-600 hover:bg-red-50' }}">
                🚀Featured
            </a>
            <a href="{{ route('frontend.catalog.type', 'new_series') }}" 
               class="whitespace-nowrap px-4 py-2 text-sm sm:text-base font-medium rounded-full transition
                      {{ request()->route('type') == 'new_series' ? 'bg-red-600 text-white' : 'text-gray-600 hover:text-red-600 hover:bg-red-50' }}">
                🆕New Series
            </a>
            <a href="{{ route('frontend.catalog.type', 'hot_deals') }}" 
               class="whitespace-nowrap px-4 py-2 text-sm sm:text-base font-medium rounded-full transition
                      {{ request()->route('type') == 'hot_deals' ? 'bg-red-600 text-white' : 'text-gray-600 hover:text-red-600 hover:bg-red-50' }}">
                🔥Hot Deals
            </a>
            <a href="{{ route('frontend.catalog.type', 'best_seller') }}" 
               class="whitespace-nowrap px-4 py-2 text-sm sm:text-base font-medium rounded-full transition
                      {{ request()->route('type') == 'best_seller' ? 'bg-red-600 text-white' : 'text-gray-600 hover:text-red-600 hover:bg-red-50' }}">
                🌟Best Sellers
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 sm:px-6 lg:px-10 py-8 sm:py-12">
    
    @if($highlights->isEmpty())
        <!-- Empty State -->
        <div class="text-center py-16">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">No highlighted products</h3>
            <p class="mt-2 text-sm text-gray-500">Check back later for featured products</p>
            <div class="mt-6">
                <a href="{{ route('frontend.products.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Browse All Products
                </a>
            </div>
        </div>
    @else
        <!-- Featured Products Section -->
        @if($featured->isNotEmpty())
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Featured Products</h2>
                <a href="{{ route('frontend.catalog.type', 'featured') }}" 
                   class="text-sm text-red-600 hover:text-red-700 font-medium">
                    View All →
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($featured->take(4) as $highlight)
                    @include('frontend.catalog.partials.product-card', ['product' => $highlight->product])
                @endforeach
            </div>
        </section>
        @endif

        <!-- New Series Section -->
        @if($newSeries->isNotEmpty())
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">New Series</h2>
                <a href="{{ route('frontend.catalog.type', 'new_series') }}" 
                   class="text-sm text-red-600 hover:text-red-700 font-medium">
                    View All →
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($newSeries->take(4) as $highlight)
                    @include('frontend.catalog.partials.product-card', ['product' => $highlight->product])
                @endforeach
            </div>
        </section>
        @endif

        <!-- Hot Deals Section -->
        @if($hotDeals->isNotEmpty())
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Hot Deals</h2>
                <a href="{{ route('frontend.catalog.type', 'hot_deals') }}" 
                   class="text-sm text-red-600 hover:text-red-700 font-medium">
                    View All →
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($hotDeals->take(4) as $highlight)
                    @include('frontend.catalog.partials.product-card', ['product' => $highlight->product])
                @endforeach
            </div>
        </section>
        @endif

        <!-- Best Sellers Section -->
        @if($bestSellers->isNotEmpty())
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Best Sellers</h2>
                <a href="{{ route('frontend.catalog.type', 'best_seller') }}" 
                   class="text-sm text-red-600 hover:text-red-700 font-medium">
                    View All →
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($bestSellers->take(4) as $highlight)
                    @include('frontend.catalog.partials.product-card', ['product' => $highlight->product])
                @endforeach
            </div>
        </section>
        @endif
    @endif

</div>
@endsection
