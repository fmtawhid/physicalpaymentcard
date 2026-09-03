<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'product'])->latest()->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function edit(Order $order)
    {
        $order->load(['user', 'product']);

        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'card_info_name' => 'nullable|string|max:255',
            'card_number' => 'nullable|string|max:32',
            'card_holder_name' => 'nullable|string|max:255',
            'card_expiry' => 'nullable|string|max:10',
            'card_cvv' => 'nullable|string|max:10',
            'card_info_note' => 'nullable|string|max:5000',
            'admin_note' => 'nullable|string|max:2000',
        ]);

        $order->update($data);

        return redirect()->route('admin.order.list')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        if ($order->payment_slip) {
            File::delete(public_path('uploads/order-slips/'.$order->payment_slip));
        }

        $order->delete();

        return redirect()->route('admin.order.list')->with('success', 'Order deleted successfully.');
    }
}
