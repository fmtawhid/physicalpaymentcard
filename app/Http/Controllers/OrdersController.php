<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

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
        $rules = [
            'product_id' => 'required|exists:products,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:30',
            'customer_country' => ['required', Rule::in(config('locations.countries'))],
            'customer_district' => ['required', Rule::in(config('locations.districts'))],
            'delivery_address' => 'required|string|max:1000',
            'payment_method' => 'required|string|in:bKash,Nagad,Rocket,Bank Transfer',
            'payment_number' => 'required|string|max:100',
            'payment_slip' => 'required|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ];

        if (!Auth::check()) {
            $rules['customer_email'] .= '|unique:users,email';
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
        }

        $data = $request->validate($rules);

        $product = Product::where('status', 'active')->findOrFail($data['product_id']);
        $directory = public_path('uploads/order-slips');
        File::ensureDirectoryExists($directory);
        $file = $request->file('payment_slip');
        $fileName = time().'_'.uniqid().'.'.$file->extension();
        $file->move($directory, $fileName);

        $user = DB::transaction(function () use ($data, $product, $fileName) {
            if (!Auth::check()) {
                $user = User::create([
                    'name' => $data['customer_name'],
                    'email' => $data['customer_email'],
                    'phone' => $data['customer_phone'],
                    'country' => $data['customer_country'],
                    'district' => $data['customer_district'],
                    'delivery_address' => $data['delivery_address'],
                    'password' => Hash::make($data['password']),
                    'role' => 'merchant',
                ]);
            } else {
                $user = Auth::user();
                $user->update([
                    'phone' => $data['customer_phone'],
                    'country' => $data['customer_country'],
                    'district' => $data['customer_district'],
                    'delivery_address' => $data['delivery_address'],
                ]);
            }

            Order::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],
                'customer_country' => $data['customer_country'],
                'customer_district' => $data['customer_district'],
                'delivery_address' => $data['delivery_address'],
                'payment_method' => $data['payment_method'],
                'payment_number' => $data['payment_number'],
                'amount' => $product->price,
                'payment_slip' => $fileName,
                'status' => 'pending',
            ]);

            return $user;
        });

        if (!Auth::check()) {
            Auth::login($user);
        }

        return redirect()->route('orders.index')->with('success', 'আপনার অর্ডার জমা হয়েছে। Admin যাচাই করার পর status আপডেট হবে।');
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        $order->load('product');

        return view('merchant.orders.show', compact('order'));
    }
}
