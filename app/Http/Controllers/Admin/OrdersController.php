<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search'));
        $status = $request->input('status');
        $productId = $request->input('product_id');
        $paymentMethod = $request->input('payment_method');

        $orders = Order::with(['user', 'product'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('id', is_numeric($search) ? (int) $search : -1)
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_email', 'like', "%{$search}%")
                        ->orWhere('customer_phone', 'like', "%{$search}%")
                        ->orWhere('payment_number', 'like', "%{$search}%");
                });
            })
            ->when(in_array($status, ['pending', 'approved', 'rejected'], true), fn ($query) => $query->where('status', $status))
            ->when($productId !== null && $productId !== '', fn ($query) => $query->where('product_id', $productId))
            ->when(in_array($paymentMethod, ['bKash', 'Nagad', 'Rocket', 'Bank Transfer'], true), fn ($query) => $query->where('payment_method', $paymentMethod))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $products = Product::orderBy('name')->get(['id', 'name']);

        return view('admin.orders.index', compact('orders', 'products'));
    }

    public function edit(Order $order)
    {
        $order->load(['user', 'product']);

        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $rules = [
            'status' => 'required|in:pending,approved,rejected',
            'card_info_name' => 'nullable|string|max:255',
            'card_number' => 'nullable|string|max:32',
            'card_holder_name' => 'nullable|string|max:255',
            'card_expiry' => 'nullable|string|max:10',
            'card_cvv' => 'nullable|string|max:10',
            'card_info_note' => 'nullable|string|max:5000',
            'admin_note' => 'nullable|string|max:2000',
        ];

        if ($order->balance_credited_at) {
            $rules['additional_balance_credit'] = 'nullable|numeric|decimal:0,2|min:0|max:9999999999.99';
            $rules['balance_credit'] = 'prohibited';
        } else {
            $rules['balance_credit'] = 'required|numeric|decimal:0,2|min:0|max:9999999999.99';
            $rules['additional_balance_credit'] = 'prohibited';
        }

        $data = $request->validate($rules);

        DB::transaction(function () use ($data, $order) {
            $lockedOrder = Order::query()->lockForUpdate()->findOrFail($order->id);

            if ($lockedOrder->balance_credited_at) {
                $additionalCredit = $data['additional_balance_credit'] ?? '0.00';
                unset($data['additional_balance_credit'], $data['balance_credit']);

                if ((float) $additionalCredit > 0 && $data['status'] !== 'approved') {
                    throw ValidationException::withMessages([
                        'additional_balance_credit' => 'The order must be approved before adding more balance.',
                    ]);
                }

                if ((float) $additionalCredit > 0) {
                    $lockedOrder->user()->lockForUpdate()->firstOrFail()
                        ->increment('balance', $additionalCredit);
                    $lockedOrder->increment('balance_credit', $additionalCredit);
                }
            } else {
                if ($data['status'] === 'approved') {
                    $lockedOrder->user()->lockForUpdate()->firstOrFail()
                        ->increment('balance', $data['balance_credit']);
                    $data['balance_credited_at'] = now();
                }
            }

            $lockedOrder->update($data);
        });

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
