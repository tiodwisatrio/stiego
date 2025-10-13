@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Product Highlights</h2>
        <a href="{{ route('admin.highlights.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-xs font-semibold rounded-md hover:bg-indigo-700">
            Add Highlight
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Highlight Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($highlights as $highlight)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $highlight->product->product_name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $highlight->highlight_type)) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $highlight->priority ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $highlight->start_date ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $highlight->end_date ?? '-' }}</td>
                    <td class="px-6 py-4 text-right text-sm font-medium flex justify-end gap-2">
                        <a href="{{ route('admin.highlights.edit', $highlight) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('admin.highlights.destroy', $highlight) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No highlights found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $highlights->links() }}
    </div>
</div>
@endsection
