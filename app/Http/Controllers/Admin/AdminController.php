<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $approvedRevenue = Order::where('status', 'approved')->sum('amount');
        $statusCounts = [
            'pending' => Order::where('status', 'pending')->count(),
            'approved' => Order::where('status', 'approved')->count(),
            'rejected' => Order::where('status', 'rejected')->count(),
        ];

        $months = collect(range(5, 0))->map(function (int $monthsAgo): array {
            $month = Carbon::now()->startOfMonth()->subMonths($monthsAgo);

            return [
                'label' => $month->format('M Y'),
                'orders' => Order::whereBetween('created_at', [$month->copy(), $month->copy()->endOfMonth()])->count(),
                'revenue' => (float) Order::where('status', 'approved')
                    ->whereBetween('created_at', [$month->copy(), $month->copy()->endOfMonth()])
                    ->sum('amount'),
            ];
        });

        $stats = [
            'merchants' => Merchant::count(),
            'products' => Product::count(),
            'orders' => Order::count(),
            'revenue' => (float) $approvedRevenue,
        ];

        $recentOrders = Order::with(['user', 'product'])->latest()->take(5)->get();

        return view('admin.index', compact('stats', 'statusCounts', 'months', 'recentOrders'));
    }
}
