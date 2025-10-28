@php
    $finalPrice = $product->product_price_after_discount;
    $hasDiscount = $product->product_discount > 0;
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
                    Save {{ $product->discount_percentage }}%
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
            Beli Sekarang
        </a>
    </div>
</div>
