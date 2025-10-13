@extends('layouts.frontend')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Our Products</h1>
            <div class="w-24 h-1 bg-red-600 mx-auto"></div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="relative pb-[100%]">
                    @if($product->images->first())
                        <img src="{{ Storage::url($product->images->first()->path) }}" 
                             alt="{{ $product->name }}"
                             class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <img src="https://placehold.co/400x400" 
                             alt="Product placeholder"
                             class="absolute inset-0 w-full h-full object-cover">
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($product->description, 100) }}</p>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-lg font-bold text-red-600">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        <a href="{{ route('frontend.products.show', $product) }}" 
                           class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">No products found.</p>
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