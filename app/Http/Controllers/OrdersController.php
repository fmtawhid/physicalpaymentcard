<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('product')->latest()->paginate(10);

        return view('merchant.orders.index', compact('orders'));
    }

    public function cards()
    {
        $cards = Order::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->whereNotNull('card_number')
            ->with('product')
            ->latest()
            ->get();

        return view('merchant.orders.cards', compact('cards'));
    }

    public function create(Product $product)
    {
        abort_unless($product->status === 'active', 404);

        $settings = SiteSetting::current();

        return view('merchant.orders.create', compact('product', 'settings'));
    }

    public function createDefault()
    {
        $product = Product::where('status', 'active')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->firstOrFail();

        return redirect()->route('orders.create', $product);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:30',
            'payment_method' => 'required|string|in:bKash,Nagad,Rocket,Bank Transfer',
            'payment_number' => 'required|string|max:100',
            'payment_slip' => 'required|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ]);

        $product = Product::where('status', 'active')->findOrFail($data['product_id']);
        $directory = public_path('uploads/order-slips');
        File::ensureDirectoryExists($directory);
        $file = $request->file('payment_slip');
        $fileName = time().'_'.uniqid().'.'.$file->extension();
        $file->move($directory, $fileName);

        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'],
            'payment_method' => $data['payment_method'],
            'payment_number' => $data['payment_number'],
            'amount' => $product->price,
            'payment_slip' => $fileName,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.index')->with('success', 'আপনার অর্ডার জমা হয়েছে। Admin যাচাই করার পর status আপডেট হবে।');
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        $order->load('product');

        return view('merchant.orders.show', compact('order'));
    }
}
