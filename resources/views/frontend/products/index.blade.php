@extends('layouts.frontend')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto py-4 sm:py-6 lg:py-8">
        
        <!-- Header -->
        <div class="text-center mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-3">Our Products</h1>
            <div class="w-20 sm:w-24 h-1 bg-red-600 mx-auto"></div>
        </div>

        <!-- Filter & Search Section -->
<div 
    x-data="{ open: false }" 
    class="bg-white rounded-lg shadow-sm p-4 sm:p-6 mb-6"
>
    <!-- Mobile Toggle Button -->
    <div class="flex justify-between items-center sm:hidden">
        <h2 class="text-base font-semibold text-gray-800">Filter & Sort</h2>
        <button 
            @click="open = !open" 
            class="px-4 py-2 text-sm font-medium bg-red-600 text-white rounded-md hover:bg-red-700 transition">
            <span x-text="open ? 'Close' : 'Open'"></span>
        </button>
    </div>

    <!-- Filter Form -->
    <div 
        x-show="open || window.innerWidth >= 640" 
        x-transition 
        x-cloak
        class="mt-4 sm:mt-0"
    >
        <form method="GET" action="{{ route('frontend.products.index') }}" class="space-y-3 sm:space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                
                <!-- Search -->
                <div class="lg:col-span-2">
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Search Product</label>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search by name..."
                           class="w-full px-3 sm:px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>

                <!-- Category Filter -->
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Category</label>
                    <select name="category" 
                            class="w-full px-3 sm:px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="">All Categories</option>
                        @foreach($parentCategories as $parent)
                            <optgroup label="{{ $parent->category_name }}">
                                <option value="{{ $parent->id }}" {{ request('category') == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->category_name }} (All)
                                </option>
                                @foreach($parent->children as $child)
                                    <option value="{{ $child->id }}" {{ request('category') == $child->id ? 'selected' : '' }}>
                                        └─ {{ $child->category_name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>

                <!-- Price Range -->
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Min Price</label>
                    <input type="number" 
                           name="price_min" 
                           value="{{ request('price_min') }}"
                           placeholder="Rp 0"
                           class="w-full px-3 sm:px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Max Price</label>
                    <input type="number" 
                           name="price_max" 
                           value="{{ request('price_max') }}"
                           placeholder="Rp 999,999"
                           class="w-full px-3 sm:px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>
            </div>

            <!-- Sort & Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-2">
                <div class="flex items-center gap-2 sm:gap-3">
                    <label class="text-xs sm:text-sm font-medium text-gray-700 whitespace-nowrap">Sort:</label>
                    <select name="sort" 
                            onchange="this.form.submit()"
                            class="flex-1 sm:flex-none px-2 sm:px-3 py-1.5 border border-gray-300 rounded-lg text-xs sm:text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A-Z</option>
                    </select>
                </div>

                <div class="flex gap-2 w-full sm:w-auto">
                    <button type="submit" 
                            class="flex-1 sm:flex-none px-4 sm:px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium text-xs sm:text-sm">
                        Apply
                    </button>
                    <a href="{{ route('frontend.products.index') }}" 
                       class="flex-1 sm:flex-none px-4 sm:px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium text-xs sm:text-sm">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>


        <!-- Results Info -->
        <div class="text-xs sm:text-sm text-gray-600" style="margin-bottom: 10px;">
            Showing <span class="font-semibold">{{ $products->firstItem() ?? 0 }}</span> to 
            <span class="font-semibold">{{ $products->lastItem() ?? 0 }}</span> of 
            <span class="font-semibold">{{ $products->total() }}</span> products
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
            @forelse ($products as $product)
                @php
                    $finalPrice = $product->product_price;
                    $hasDiscount = $product->product_discount > 0;
                    if ($hasDiscount) {
                        $finalPrice = $product->product_price - ($product->product_price * $product->product_discount / 100);
                    }
                @endphp

                <div class="overflow-hidden duration-300 group">
                    <!-- Image Container with Discount Badge -->
                    <a href="{{ route('frontend.products.show', $product) }}" class="block relative">
                        <div class="relative pb-[100%] bg-gray-100">
                            @if($product->images->first())
                                <img src="{{ Storage::url($product->images->first()->image_path) }}" 
                                     alt="{{ $product->product_name }}"
                                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center bg-gray-200">
                                    <svg class="w-12 h-12 sm:w-16 sm:h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif

                            <!-- Discount Badge (Top-Left) -->
                            @if($hasDiscount)
                                <div class="absolute top-2 left-2 bg-red-600 text-white px-2 py-1 sm:px-3 sm:py-1.5 rounded-full text-xs font-bold shadow-lg">
                                    Save {{ $product->product_discount }}%
                                </div>
                            @endif
                        </div>
                    </a>

                    <!-- Product Info -->
                    <div class="">
                        <!-- Product Name -->
                        <h3 class="text-xs sm:text-sm lg:text-xl font-semibold text-gray-900 pt-2 sm:pt-4 mb-1 sm:mb-2 h-8 sm:h-10 lg:h-12">
                            <a href="{{ route('frontend.products.show', $product) }}" 
                               class="hover:text-red-600 transition block overflow-hidden"
                               style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; line-height: 1.3rem;">
                                {{ $product->product_name }}
                            </a>
                        </h3>

                        <!-- Category Badge -->
                        @if($product->category)
                            <p class="text-gray-500 mt-3 mb-1 sm:text-xs lg:text-sm" style="font-size: 12px;">
                                @if($product->category->parent)
                                    {{ $product->category->parent->category_name }} • 
                                @endif
                                {{ $product->category->category_name }}
                            </p>
                        @endif

                        <!-- Price Section -->
                        <div class="mt-2 sm:mt-3 mb-2 sm:mb-4">
                            @if($hasDiscount)
                                <div class="flex flex-col sm:flex-row sm:items-baseline gap-1 sm:gap-2">
                                    <span class="text-sm sm:text-base lg:text-lg font-extrabold text-red-600">
                                        Rp {{ number_format($finalPrice, 0, ',', '.') }}
                                    </span>
                                    <span class=" sm:text-xs lg:text-sm text-gray-400 line-through" style="text-decoration: line-through; font-size: 12px;">
                                        Rp {{ number_format($product->product_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            @else
                                <span class="text-sm sm:text-base lg:text-lg font-bold text-gray-900">
                                    Rp {{ number_format($product->product_price, 0, ',', '.') }}
                                </span>
                            @endif
                        </div>

                        <!-- View Details Button -->
                        <a href="{{ route('frontend.products.show', $product) }}" 
                           class="block w-full text-center px-3 py-2 sm:px-5 sm:py-3 bg-red-600 text-white text-xs sm:text-sm font-medium hover:bg-red-700 transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-gray-500 text-lg mb-2">No products found</p>
                    <a href="{{ route('frontend.products.index') }}" class="text-red-600 hover:underline">
                        Reset filters
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection