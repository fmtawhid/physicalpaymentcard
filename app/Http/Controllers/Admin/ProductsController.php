<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('sort_order')->orderByDesc('id')->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['image'] = $this->uploadImage($request);

        Product::create($data);

        return redirect()->route('admin.product.list')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $this->validatedData($request);

        if ($request->hasFile('image')) {
            $this->deleteImage($product->image);
            $data['image'] = $this->uploadImage($request);
        }

        $product->update($data);

        return redirect()->route('admin.product.list')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->deleteImage($product->image);
        $product->delete();

        return redirect()->route('admin.product.list')->with('success', 'Product deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|in:BDT',
            'delivery_time' => 'nullable|string|max:100',
            'features' => 'nullable|string|max:2000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }

    private function uploadImage(Request $request): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $directory = public_path('uploads/products');
        File::ensureDirectoryExists($directory);
        $image = $request->file('image');
        $name = time().'_'.uniqid().'.'.$image->extension();
        $image->move($directory, $name);

        return $name;
    }

    private function deleteImage(?string $image): void
    {
        if ($image) {
            File::delete(public_path('uploads/products/'.$image));
        }
    }
}
