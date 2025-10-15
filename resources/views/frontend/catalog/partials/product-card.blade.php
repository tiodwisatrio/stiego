<div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group">
    <a href="{{ route('frontend.products.show', $product->id) }}" class="block">
        <!-- Product Image -->
        <div class="relative aspect-square overflow-hidden bg-gray-100">
            @if($product->images->first())
                <img 
                    src="{{ Storage::url($product->images->first()->image_path) }}" 
                    alt="{{ $product->product_name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            @else
                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif

            <!-- Stock Badge -->
            @php
                $totalStock = $product->variants->sum('stock');
            @endphp
            @if($totalStock <= 0)
                <div class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded">
                    Out of Stock
                </div>
            @elseif($totalStock <= 5)
                <div class="absolute top-2 right-2 bg-orange-500 text-white text-xs px-2 py-1 rounded">
                    Only {{ $totalStock }} left
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="p-3 sm:p-4">
            <!-- Category -->
            @if($product->category)
                <p class="text-xs text-gray-500 mb-1">{{ $product->category->category_name }}</p>
            @endif

            <!-- Product Name -->
            <h3 class="font-semibold text-gray-900 text-sm sm:text-base mb-2 line-clamp-2 min-h-[2.5rem] sm:min-h-[3rem]" 
                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                {{ $product->product_name }}
            </h3>

            <!-- Price -->
            <div class="flex items-center justify-between">
                <div>
                    @if($product->product_discount > 0)
                        <div class="flex items-center gap-2">
                            <span class="text-sm sm:text-base font-bold text-red-600">
                                Rp {{ number_format($product->product_price * (1 - $product->product_discount / 100), 0, ',', '.') }}
                            </span>
                            <span class="text-xs text-gray-400 line-through">
                                Rp {{ number_format($product->product_price, 0, ',', '.') }}
                            </span>
                        </div>
                        <span class="inline-block mt-1 text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded">
                            -{{ $product->product_discount }}%
                        </span>
                    @else
                        <span class="text-sm sm:text-base font-bold text-gray-900">
                            Rp {{ number_format($product->product_price, 0, ',', '.') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </a>

    <!-- Add to Cart Button -->
    <div class="px-3 sm:px-4 pb-3 sm:pb-4">
        @php
            $totalStock = $product->variants->sum('stock');
        @endphp
        @if($totalStock > 0)
            <a href="{{ route('frontend.products.show', $product->id) }}" 
               class="block w-full py-2 bg-red-600 hover:bg-red-700 text-white text-xs sm:text-sm font-medium rounded-md transition duration-150 text-center">
                View Details
            </a>
        @else
            <button disabled 
                    class="w-full py-2 bg-gray-300 text-gray-500 text-xs sm:text-sm font-medium rounded-md cursor-not-allowed">
                Out of Stock
            </button>
        @endif
    </div>
</div>
