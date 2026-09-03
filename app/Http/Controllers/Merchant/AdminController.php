<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $merchant = Auth::user()->merchant;
        $stats = [
            'total_orders' => Order::where('user_id', Auth::id())->count(),
            'pending_orders' => Order::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'approved_orders' => Order::where('user_id', Auth::id())->where('status', 'approved')->count(),
            'profile_status' => $merchant->verified ? 'ভেরিফায়েড' : 'ভেরিফিকেশন অপেক্ষমাণ',
        ];
        $recentOrders = Order::where('user_id', Auth::id())->with('product')->latest()->take(5)->get();

        return view('merchant.index', compact('merchant', 'stats', 'recentOrders'));
    }
}
