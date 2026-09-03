@if ($errors->any())
    <div class="mb-5 rounded-lg bg-red-100 p-4 text-red-700"><ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="md:col-span-2"><label class="block text-gray-700 mb-1">Product Name *</label><input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name', $product->name ?? '') }}" required></div>
    <div class="md:col-span-2"><label class="block text-gray-700 mb-1">Description</label><textarea name="description" rows="4" class="w-full border px-3 py-2 rounded">{{ old('description', $product->description ?? '') }}</textarea></div>
    <div><label class="block text-gray-700 mb-1">Price *</label><input type="number" name="price" min="0" step="0.01" class="w-full border px-3 py-2 rounded" value="{{ old('price', $product->price ?? '') }}" required></div>
    <div><label class="block text-gray-700 mb-1">Currency *</label><input type="text" name="currency" value="BDT" readonly class="w-full border bg-gray-100 px-3 py-2 rounded" required></div>
    <div><label class="block text-gray-700 mb-1">Delivery Time</label><input type="text" name="delivery_time" placeholder="e.g. 5–15 minutes" class="w-full border px-3 py-2 rounded" value="{{ old('delivery_time', $product->delivery_time ?? '') }}"></div>
    <div><label class="block text-gray-700 mb-1">Display Order</label><input type="number" name="sort_order" min="0" class="w-full border px-3 py-2 rounded" value="{{ old('sort_order', $product->sort_order ?? 0) }}"></div>
    <div class="md:col-span-2"><label class="block text-gray-700 mb-1">Features <span class="text-sm text-gray-500">(one feature per line)</span></label><textarea name="features" rows="5" class="w-full border px-3 py-2 rounded" placeholder="Fast activation&#10;Secure online payments">{{ old('features', $product->features ?? '') }}</textarea></div>
    <div><label class="block text-gray-700 mb-1">Product Image</label><input type="file" name="image" accept="image/*" class="w-full border px-3 py-2 rounded">@if(!empty($product?->image))<img src="{{ asset('uploads/products/'.$product->image) }}" alt="{{ $product->name }}" class="mt-2 h-24 w-32 rounded object-cover">@endif</div>
    <div><label class="block text-gray-700 mb-1">Status *</label><select name="status" class="w-full border px-3 py-2 rounded" required><option value="active" {{ old('status', $product->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option><option value="inactive" {{ old('status', $product->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option></select></div>
</div>
<div class="mt-6"><button type="submit" class="px-6 py-2 bg-primary-700 hover:bg-primary-800 text-white rounded">{{ $submitLabel }}</button><a href="{{ route('admin.product.list') }}" class="ml-3 px-6 py-2 border border-gray-300 rounded text-gray-700">Cancel</a></div>
