@extends('layouts.frontend')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        
        <!-- Breadcrumb -->
        <!-- <nav class="flex mb-6 text-sm text-gray-500">
            <a href="{{ route('frontend.home') }}" class="hover:text-red-600">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('frontend.products.index') }}" class="hover:text-red-600">Products</a>
            <span class="mx-2">/</span>
            @if($product->category)
                @if($product->category->parent)
                    <a href="{{ route('frontend.products.index', ['category' => $product->category->parent_id]) }}" class="hover:text-red-600">
                        {{ $product->category->parent->category_name }}
                    </a>
                    <span class="mx-2">/</span>
                @endif
                <a href="{{ route('frontend.products.index', ['category' => $product->category_id]) }}" class="hover:text-red-600">
                    {{ $product->category->category_name }}
                </a>
                <span class="mx-2">/</span>
            @endif
            <span class="text-gray-900">{{ Str::limit($product->product_name, 30) }}</span>
        </nav> -->

        <!-- Product Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12" x-data="productDetail()">
            
            <!-- Left Column: Image Gallery -->
            <div class="space-y-4">
                <!-- Main Image -->
                <div class="relative bg-gray-100 rounded-lg overflow-hidden" style="padding-bottom: 100%;">
                    @if($product->images->isNotEmpty())
                        <img :src="mainImage" 
                             alt="{{ $product->product_name }}"
                             class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-200">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif

                    <!-- Discount Badge -->
                    @if($product->product_discount > 0)
                        <div class="absolute bg-red-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg z-10" style="top: 16px; left: 16px;">
                            Save {{ $product->product_discount }}%
                        </div>
                    @endif
                </div>

                <!-- Thumbnail Images -->
                @if($product->images->count() > 1)
                    <div class="grid grid-cols-4 gap-3">
                        @foreach($product->images as $image)
                            <button type="button"
                                    @click="selectImage('{{ Storage::url($image->image_path) }}')"
                                    :class="mainImage === '{{ Storage::url($image->image_path) }}' ? 'ring-2 ring-red-600' : 'ring-1 ring-gray-300'"
                                    class="relative bg-gray-100 rounded-lg overflow-hidden hover:ring-red-600 transition cursor-pointer"
                                    style="padding-bottom: 100%;">
                                <img src="{{ Storage::url($image->image_path) }}" 
                                     alt="{{ $product->product_name }}"
                                     class="absolute inset-0 w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right Column: Product Info -->
            <div class="space-y-6">
                <!-- Product Title -->
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-tight">
                        {{ $product->product_name }}
                    </h1>
                    
                    <!-- Category Badge -->
                    @if($product->category)
                        <div class="mt-3 flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            @if($product->category->parent)
                                <span>{{ $product->category->parent->category_name }} • </span>
                            @endif
                            <span class="font-medium">{{ $product->category->category_name }}</span>
                        </div>
                    @endif
                </div>

                <!-- Price Section -->
                <div class="border-t border-b border-gray-200 py-4">
                    @php
                        $finalPrice = $product->product_price;
                        $hasDiscount = $product->product_discount > 0;
                        if ($hasDiscount) {
                            $finalPrice = $product->product_price - ($product->product_price * $product->product_discount / 100);
                        }
                    @endphp

                    @if($hasDiscount)
                        <div class="flex items-baseline gap-3">
                            <span class="text-3xl sm:text-4xl font-bold text-red-600">
                                Rp {{ number_format($finalPrice, 0, ',', '.') }}
                            </span>
                            <span class="text-xl text-gray-400 line-through" style="text-decoration: line-through;">
                                Rp {{ number_format($product->product_price, 0, ',', '.') }}
                            </span>
                        </div>
                        <p class="mt-2 text-sm text-green-600 font-medium">
                            Kamu hemat Rp {{ number_format($product->product_price - $finalPrice, 0, ',', '.') }} ({{ $product->product_discount }}%)
                        </p>
                    @else
                        <span class="text-3xl sm:text-4xl font-bold text-gray-900">
                            Rp {{ number_format($product->product_price, 0, ',', '.') }}
                        </span>
                    @endif
                </div>

                <!-- Variants Selection -->
                @if($product->variants->isNotEmpty())
                    @php
                        $sizes = $product->variants->pluck('variant_size')->unique();
                        $colors = $product->variants->pluck('variant_color')->unique();
                    @endphp

                    <!-- Size Selection -->
                    @if($sizes->count() > 0)
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-3">
                                Ukuran: <span x-text="selectedSize || 'Pilih ukuran'" class="text-red-600"></span>
                            </label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($sizes as $size)
                                    <button type="button"
                                            @click="selectSize('{{ $size }}')"
                                            :class="selectedSize === '{{ $size }}' ? 'bg-red-600 text-white border-red-600' : 'bg-white text-gray-900 border-gray-300 hover:border-red-600'"
                                            class="px-6 py-2.5 border-2 rounded-lg font-medium transition-colors">
                                        {{ strtoupper($size) }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Color Selection -->
                    @if($colors->count() > 0)
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-3">
                                Warna: <span x-text="selectedColor || 'Pilih warna'" class="text-red-600"></span>
                            </label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($colors as $color)
                                    <button type="button"
                                            @click="selectColor('{{ $color }}')"
                                            :class="selectedColor === '{{ $color }}' ? 'ring-2 ring-red-600 ring-offset-2' : 'ring-1 ring-gray-300'"
                                            class="px-6 py-2.5 bg-white border-2 border-gray-200 rounded-lg font-medium hover:border-red-600 transition-all capitalize">
                                        {{ $color }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Stock Info for Selected Variant -->
                    <div x-show="selectedVariant" class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Stock tersedia:</span>
                            <span x-text="availableStock + ' pcs'" class="text-sm font-bold" :class="availableStock > 0 ? 'text-green-600' : 'text-red-600'"></span>
                        </div>
                    </div>
                @endif

                <!-- Quantity Selector -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Jumlah</label>
                    <div class="flex items-center gap-3">
                        <button type="button"
                                @click="decreaseQuantity()"
                                class="w-10 h-10 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-lg transition px-5 py-2.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </button>
                        <input type="number" 
                               x-model="quantity"
                               min="1"
                               :max="availableStock"
                               class="w-20 text-center text-lg font-semibold border-2 border-gray-300 rounded-lg py-2 focus:border-red-600 focus:ring-0">
                        <button type="button"
                                @click="increaseQuantity()"
                                class="w-10 h-10 flex items-center justify-center bg-red-600 hover:bg-red-700 text-white rounded-lg transition px-5 py-2.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4">
                    <button type="button"
                            @click="addToCart()"
                            :disabled="!canAddToCart()"
                            :class="canAddToCart() ? 'bg-red-600 hover:bg-red-700' : 'bg-gray-400 cursor-not-allowed'"
                            class="flex-1 py-4 px-6 rounded-lg text-white font-semibold text-lg transition flex items-center justify-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Add to Cart</span>
                    </button>
                    
                    <button type="button"
                            class="w-16 h-16 flex items-center justify-center border-2 border-gray-300 hover:border-red-600 rounded-lg transition px-5 py-2.5">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>

                <!-- Product Description -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi Produk</h3>
                    <div class="prose prose-sm text-gray-600 leading-relaxed">
                        {{ $product->product_description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function productDetail() {
    return {
        mainImage: '{{ $product->images->first() ? Storage::url($product->images->first()->image_path) : "" }}',
        selectedSize: '',
        selectedColor: '',
        selectedVariant: null,
        availableStock: 0,
        quantity: 1,
        variants: @json($product->variants),

        selectImage(imageUrl) {
            this.mainImage = imageUrl;
        },

        selectSize(size) {
            this.selectedSize = size;
            this.updateVariant();
        },

        selectColor(color) {
            this.selectedColor = color;
            this.updateVariant();
        },

        updateVariant() {
            if (this.selectedSize && this.selectedColor) {
                this.selectedVariant = this.variants.find(v => 
                    v.variant_size === this.selectedSize && 
                    v.variant_color === this.selectedColor
                );
                
                if (this.selectedVariant) {
                    this.availableStock = this.selectedVariant.stock;
                    this.quantity = 1;
                } else {
                    this.availableStock = 0;
                    alert('Kombinasi size dan warna tidak tersedia');
                }
            }
        },

        increaseQuantity() {
            if (this.quantity < this.availableStock) {
                this.quantity++;
            }
        },

        decreaseQuantity() {
            if (this.quantity > 1) {
                this.quantity--;
            }
        },

        canAddToCart() {
            // Jika ada variants, harus pilih size dan color
            if (this.variants.length > 0) {
                return this.selectedVariant && this.availableStock > 0 && this.quantity > 0;
            }
            // Jika tidak ada variants, bisa langsung add
            return true;
        },

        addToCart() {
            if (!this.canAddToCart()) {
                if (!this.selectedSize) {
                    alert('Pilih ukuran terlebih dahulu');
                } else if (!this.selectedColor) {
                    alert('Pilih warna terlebih dahulu');
                } else if (this.availableStock <= 0) {
                    alert('Stock tidak tersedia');
                }
                return;
            }

            // TODO: Implement add to cart logic
            console.log({
                product_id: {{ $product->id }},
                variant_id: this.selectedVariant?.id,
                size: this.selectedSize,
                color: this.selectedColor,
                quantity: this.quantity
            });

            alert('Product berhasil ditambahkan ke cart!');
        }
    }
}
</script>
@endpush
@endsection