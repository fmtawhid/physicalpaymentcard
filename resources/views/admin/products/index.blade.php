@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-6 bg-gray-50">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <div><h2 class="text-2xl font-bold text-gray-800">Products</h2><p class="text-sm text-gray-500 mt-1">Manage the virtual card products shown on the homepage.</p></div>
        <a href="{{ route('admin.product.create') }}" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md">Add Product</a>
    </div>

    @if(session('success'))<div class="mb-5 rounded-lg bg-green-100 px-4 py-3 text-green-800">{{ session('success') }}</div>@endif
    <div class="bg-white shadow-lg rounded-xl overflow-x-auto">
        <table class="min-w-full table-auto divide-y divide-gray-200">
            <thead class="bg-gray-100"><tr><th class="px-6 py-3 text-left text-sm font-medium text-gray-600">#</th><th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Product</th><th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Price</th><th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Delivery</th><th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Status</th><th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Actions</th></tr></thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $index => $product)
                <tr class="hover:bg-gray-50"><td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td><td class="px-6 py-4"><div class="flex items-center gap-3">@if($product->image)<img src="{{ asset('uploads/products/'.$product->image) }}" class="h-10 w-14 rounded object-cover" alt="{{ $product->name }}">@endif<div><div class="font-medium text-gray-800">{{ $product->name }}</div><div class="text-sm text-gray-500">Order: {{ $product->sort_order }}</div></div></div></td><td class="px-6 py-4 text-sm text-gray-700">{{ $product->currency }} {{ number_format((float) $product->price, 2) }}</td><td class="px-6 py-4 text-sm text-gray-500">{{ $product->delivery_time ?: '—' }}</td><td class="px-6 py-4"><span class="px-3 py-1 rounded-full text-xs font-semibold {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ ucfirst($product->status) }}</span></td><td class="px-6 py-4"><div class="flex gap-2"><a href="{{ route('admin.product.edit', $product->id) }}" class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-md">Edit</a><form method="POST" action="{{ route('admin.product.destroy', $product->id) }}">@csrf @method('DELETE')<button type="submit" onclick="return confirm('Delete this product?')" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded-md">Delete</button></form></div></td></tr>
                @empty
                <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">No products found. Add your first product.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>
@endsection
