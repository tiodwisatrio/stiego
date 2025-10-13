@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Product</h2>
        <a href="{{ route('admin.products.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            ← Back to List
        </a>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="productEditForm" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Product Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Price Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Base Price (Rp)</label>
                <input type="number" name="product_price" value="{{ old('product_price', $product->product_price) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Discount (%)</label>
                <input type="number" name="product_discount" value="{{ old('product_discount', $product->product_discount) }}"
                       min="0" max="100"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>

        <!-- Variants -->
        <div class="border rounded-lg p-4 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Product Variants</h3>
                <button type="button" onclick="addVariant()" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    + Add Variant
                </button>
            </div>

            <div id="variants-container" class="space-y-4">
                @foreach($product->variants as $variant)
                    <div class="grid grid-cols-4 gap-4 items-end variant-item">
                        <div>
                            <label class="block text-sm text-gray-700">Size</label>
                            <input type="text" name="variant_size[]" value="{{ $variant->variant_size }}" class="w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700">Color</label>
                            <input type="text" name="variant_color[]" value="{{ $variant->variant_color }}" class="w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700">Stock</label>
                            <input type="number" name="variant_stock[]" value="{{ $variant->stock }}" class="w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700">Price Override</label>
                            <div class="flex items-center gap-2">
                                <input type="number" name="variant_price_override[]" value="{{ $variant->price_override }}" class="w-full rounded-md border-gray-300 shadow-sm">
                                <button type="button" class="text-red-600 hover:text-red-800" onclick="this.closest('.variant-item').remove()">✕</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="product_description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('product_description', $product->product_description) }}</textarea>
        </div>

        <!-- Image Upload -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Product Images</label>

            <div id="existingImages" class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                @foreach($product->images as $image)
                    <div class="relative border rounded-lg overflow-hidden group" data-image-id="{{ $image->id }}">
                        <img src="{{ Storage::url($image->image_path) }}" class="w-full h-32 object-cover" alt="">
                        <button type="button" class="absolute top-2 right-2 bg-black bg-opacity-50 text-white rounded-full p-1 hover:bg-opacity-75" onclick="deleteImage({{ $image->id }}, this)">✕</button>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                <label class="cursor-pointer text-indigo-600 hover:text-indigo-800">
                    <span>Upload New Images</span>
                    <input id="new_images" name="new_images[]" type="file" class="sr-only" multiple accept="image/*">
                </label>
                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB each</p>
            </div>

            <div id="newImagePreviewContainer" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                Update Product
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function addVariant(size = '', color = '', stock = '', price = '') {
    const container = document.getElementById('variants-container');
    const div = document.createElement('div');
    div.className = 'grid grid-cols-4 gap-4 items-end variant-item';
    div.innerHTML = `
        <div><label class="block text-sm text-gray-700">Size</label><input type="text" name="variant_size[]" value="${size}" class="w-full rounded-md border-gray-300 shadow-sm"></div>
        <div><label class="block text-sm text-gray-700">Color</label><input type="text" name="variant_color[]" value="${color}" class="w-full rounded-md border-gray-300 shadow-sm"></div>
        <div><label class="block text-sm text-gray-700">Stock</label><input type="number" name="variant_stock[]" value="${stock}" class="w-full rounded-md border-gray-300 shadow-sm"></div>
        <div><label class="block text-sm text-gray-700">Price Override</label><div class="flex items-center gap-2"><input type="number" name="variant_price_override[]" value="${price}" class="w-full rounded-md border-gray-300 shadow-sm"><button type="button" class="text-red-600 hover:text-red-800" onclick="this.closest('.variant-item').remove()">✕</button></div></div>
    `;
    container.appendChild(div);
}

// Multi image preview
document.getElementById('new_images').addEventListener('change', function(e) {
    const previewContainer = document.getElementById('newImagePreviewContainer');
    previewContainer.innerHTML = ''; // reset preview
    const files = Array.from(e.target.files);
    files.forEach(file => {
        const reader = new FileReader();
        reader.onload = ev => {
            const wrapper = document.createElement('div');
            wrapper.className = 'relative border rounded-lg overflow-hidden group';
            wrapper.innerHTML = `
                <img src="${ev.target.result}" class="w-full h-32 object-cover" alt="">
                <button type="button" class="absolute top-2 right-2 bg-black bg-opacity-50 text-white rounded-full p-1 hover:bg-opacity-75" onclick="this.closest('.group').remove()">✕</button>
            `;
            previewContainer.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
    });
});

// AJAX Delete Image
async function deleteImage(imageId, button) {
    if (!confirm('Yakin hapus gambar ini?')) return;

    const response = await fetch(`/admin/products/image/${imageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    });

    if (response.ok) {
        button.closest('[data-image-id]').remove();
    } else {
        alert('Gagal menghapus gambar!');
    }
}
</script>
@endpush
