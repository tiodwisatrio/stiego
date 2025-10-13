@extends('layouts.frontend')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Product Details -->
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-8">
        <!-- Product Image Gallery -->
        <div class="relative">
            @if($product->images->isNotEmpty())
                <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                    <img src="{{ Storage::url($product->images->first()->path) }}" 
                         alt="{{ $product->name }}"
                         class="w-full h-full object-center object-cover">
                </div>
                @if($product->images->count() > 1)
                    <div class="mt-4 grid grid-cols-4 gap-4">
                        @foreach($product->images->skip(1) as $image)
                            <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                                <img src="{{ Storage::url($image->path) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-center object-cover cursor-pointer">
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                    <img src="https://placehold.co/600x600" 
                         alt="Product placeholder"
                         class="w-full h-full object-center object-cover">
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->name }}</h1>
            
            <div class="mt-3">
                <h2 class="sr-only">Product information</h2>
                <p class="text-3xl text-red-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>

            <!-- Category -->
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-900">Category</h3>
                <p class="mt-1 text-sm text-gray-500">{{ $product->category->name }}</p>
            </div>

            <!-- Description -->
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-900">Description</h3>
                <div class="mt-4 prose prose-sm text-gray-500">
                    {{ $product->description }}
                </div>
            </div>

            <!-- Stock Status -->
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-900">Stock Status</h3>
                <p class="mt-1 text-sm {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                    @if($product->stock > 0)
                        ({{ $product->stock }} available)
                    @endif
                </p>
            </div>

            <!-- Add to Cart Form -->
            <form class="mt-6">
                <div class="mt-10 flex sm:flex-col1">
                    <button type="submit"
                            class="max-w-xs flex-1 bg-red-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-red-500 sm:w-full">
                        Add to Cart
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Related Products -->
    <div class="mt-24">
        <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Related Products</h2>
        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <!-- Related products will go here -->
        </div>
    </div>
</div>
@endsection