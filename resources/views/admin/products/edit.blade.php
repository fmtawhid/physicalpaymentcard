@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6"><div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow"><h2 class="text-2xl font-semibold mb-6">Edit Product</h2><form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT') @php($submitLabel = 'Update Product') @include('admin.products._form')</form></div></main>
@endsection
