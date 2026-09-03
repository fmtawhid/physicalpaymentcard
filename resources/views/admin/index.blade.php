@extends('admin.layout.layout')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<main class="flex-1 overflow-y-auto bg-gray-50 p-4 md:p-6">
    <div class="mx-auto max-w-7xl">
        <div class="mb-6"><p class="text-sm font-semibold text-primary-700">Admin Dashboard</p><h1 class="mt-1 text-3xl font-bold text-gray-900">Overview</h1><p class="mt-2 text-gray-500">আপনার card business-এর বর্তমান তথ্য এক নজরে দেখুন।</p></div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border-l-4 border-blue-500 bg-white p-5 shadow-sm"><div class="flex items-center justify-between"><div><p class="text-sm text-gray-500">Total Merchants</p><p class="mt-2 text-3xl font-bold text-gray-800">{{ number_format($stats['merchants']) }}</p></div><div class="rounded-full bg-blue-100 p-3 text-blue-600"><i class="fas fa-users"></i></div></div><a href="{{ route('admin.merchant.list') }}" class="mt-3 inline-block text-xs font-semibold text-blue-600">View merchants →</a></div>
            <div class="rounded-xl border-l-4 border-emerald-500 bg-white p-5 shadow-sm"><div class="flex items-center justify-between"><div><p class="text-sm text-gray-500">Total Products</p><p class="mt-2 text-3xl font-bold text-gray-800">{{ number_format($stats['products']) }}</p></div><div class="rounded-full bg-emerald-100 p-3 text-emerald-600"><i class="fas fa-credit-card"></i></div></div><a href="{{ route('admin.product.list') }}" class="mt-3 inline-block text-xs font-semibold text-emerald-600">Manage products →</a></div>
            <div class="rounded-xl border-l-4 border-amber-500 bg-white p-5 shadow-sm"><div class="flex items-center justify-between"><div><p class="text-sm text-gray-500">Total Orders</p><p class="mt-2 text-3xl font-bold text-gray-800">{{ number_format($stats['orders']) }}</p></div><div class="rounded-full bg-amber-100 p-3 text-amber-600"><i class="fas fa-shopping-cart"></i></div></div><a href="{{ route('admin.order.list') }}" class="mt-3 inline-block text-xs font-semibold text-amber-600">Review orders →</a></div>
            <div class="rounded-xl border-l-4 border-primary-700 bg-white p-5 shadow-sm"><div class="flex items-center justify-between"><div><p class="text-sm text-gray-500">Approved Revenue</p><p class="mt-2 text-3xl font-bold text-gray-800">৳{{ number_format($stats['revenue'], 2) }}</p></div><div class="rounded-full bg-red-100 p-3 text-primary-700"><i class="fas fa-coins"></i></div></div><span class="mt-3 inline-block text-xs text-gray-500">Approved orders only (BDT)</span></div>
        </div>

        <div class="mt-6 grid gap-6 lg:grid-cols-[1.6fr_.8fr]">
            <section class="rounded-xl bg-white p-5 shadow-sm"><div class="mb-4 flex items-center justify-between"><div><h2 class="text-lg font-semibold text-gray-800">Orders & Revenue</h2><p class="text-xs text-gray-500">গত ৬ মাসের database data</p></div></div><div class="h-72"><canvas id="ordersRevenueChart"></canvas></div></section>
            <section class="rounded-xl bg-white p-5 shadow-sm"><h2 class="text-lg font-semibold text-gray-800">Order Status</h2><p class="text-xs text-gray-500">সব order-এর বর্তমান অবস্থা</p><div class="mx-auto mt-5 h-56 max-w-xs"><canvas id="orderStatusChart"></canvas></div><div class="mt-4 grid grid-cols-3 gap-2 text-center text-xs"><div><strong class="block text-lg text-amber-600">{{ $statusCounts['pending'] }}</strong><span class="text-gray-500">Pending</span></div><div><strong class="block text-lg text-emerald-600">{{ $statusCounts['approved'] }}</strong><span class="text-gray-500">Approved</span></div><div><strong class="block text-lg text-red-600">{{ $statusCounts['rejected'] }}</strong><span class="text-gray-500">Rejected</span></div></div></section>
        </div>

        <section class="mt-6 rounded-xl bg-white p-5 shadow-sm"><div class="mb-4 flex items-center justify-between"><h2 class="text-lg font-semibold text-gray-800">Recent Orders</h2><a href="{{ route('admin.order.list') }}" class="text-sm font-semibold text-primary-700">View all →</a></div><div class="overflow-x-auto"><table class="min-w-full divide-y divide-gray-200"><thead class="bg-gray-50"><tr><th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Order</th><th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Customer</th><th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Product</th><th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Amount</th><th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Status</th></tr></thead><tbody class="divide-y divide-gray-100">@forelse($recentOrders as $order)<tr><td class="px-4 py-4 text-sm font-semibold text-gray-700">#{{ $order->id }}<div class="text-xs font-normal text-gray-400">{{ $order->created_at->format('d M Y, h:i A') }}</div></td><td class="px-4 py-4 text-sm text-gray-700">{{ $order->customer_name }}</td><td class="px-4 py-4 text-sm text-gray-700">{{ $order->product?->name ?? 'Product removed' }}</td><td class="px-4 py-4 text-sm text-gray-700">{{ $order->product?->currency ?? 'USD' }} {{ number_format((float) $order->amount, 2) }}</td><td class="px-4 py-4"><span class="rounded-full px-3 py-1 text-xs font-bold {{ $order->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($order->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">{{ ucfirst($order->status) }}</span></td></tr>@empty<tr><td colspan="5" class="px-4 py-10 text-center text-gray-500">No orders found.</td></tr>@endforelse</tbody></table></div></section>
        <div id="chartData" class="hidden" data-labels='@json($months->pluck("label")->values())' data-orders='@json($months->pluck("orders")->values())' data-revenue='@json($months->pluck("revenue")->values())' data-pending="{{ $statusCounts['pending'] }}" data-approved="{{ $statusCounts['approved'] }}" data-rejected="{{ $statusCounts['rejected'] }}"></div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    const chartData = document.getElementById('chartData');
    const monthLabels = JSON.parse(chartData.dataset.labels);
    const monthlyOrders = JSON.parse(chartData.dataset.orders);
    const monthlyRevenue = JSON.parse(chartData.dataset.revenue);

    new Chart(document.getElementById('ordersRevenueChart'), {
        data: { labels: monthLabels, datasets: [
            { type: 'bar', label: 'Orders', data: monthlyOrders, backgroundColor: 'rgba(37, 99, 235, .72)', borderRadius: 6, yAxisID: 'orders' },
            { type: 'line', label: 'Approved Revenue (BDT)', data: monthlyRevenue, borderColor: '#059669', backgroundColor: 'rgba(5, 150, 105, .12)', fill: true, tension: .35, yAxisID: 'revenue' }
        ] },
        options: { responsive: true, maintainAspectRatio: false, interaction: { mode: 'index', intersect: false }, scales: { orders: { beginAtZero: true, position: 'left', ticks: { precision: 0 } }, revenue: { beginAtZero: true, position: 'right', grid: { drawOnChartArea: false } } } }
    });

    new Chart(document.getElementById('orderStatusChart'), {
        type: 'doughnut', data: { labels: ['Pending', 'Approved', 'Rejected'], datasets: [{ data: [Number(chartData.dataset.pending), Number(chartData.dataset.approved), Number(chartData.dataset.rejected)], backgroundColor: ['#f59e0b', '#10b981', '#ef4444'], borderWidth: 0 }] }, options: { responsive: true, maintainAspectRatio: false, cutout: '68%', plugins: { legend: { position: 'bottom' } } }
    });
</script>
@endpush
