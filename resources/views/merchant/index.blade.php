@extends('layouts.master')

@section('content')
<main class="flex-1 overflow-y-auto bg-gray-50 p-4 md:p-8">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div><p class="text-sm font-semibold text-primary-700">Merchant Dashboard</p><h1 class="mt-1 text-3xl font-bold text-gray-900">Welcome, {{ auth()->user()->name }}!</h1><p class="mt-2 text-gray-500">View a quick summary of your card orders, status, and profile here.</p></div>
            <a href="{{ url('/') }}#order" class="inline-flex w-fit items-center rounded-lg bg-primary-700 px-5 py-3 font-semibold text-white shadow hover:bg-primary-800">Buy a new card</a>
        </div>
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl bg-white p-6 shadow"><p class="text-sm text-gray-500">Total Orders</p><p class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p><a href="{{ route('orders.index') }}" class="mt-4 inline-block text-sm font-semibold text-primary-700">View orders →</a></div>
            <div class="rounded-xl bg-white p-6 shadow"><p class="text-sm text-gray-500">Pending</p><p class="mt-2 text-3xl font-bold text-amber-600">{{ $stats['pending_orders'] }}</p></div>
            <div class="rounded-xl bg-white p-6 shadow"><p class="text-sm text-gray-500">Approved</p><p class="mt-2 text-3xl font-bold text-green-600">{{ $stats['approved_orders'] }}</p></div>
            <div class="rounded-xl bg-white p-6 shadow"><p class="text-sm text-gray-500">Profile Status</p><p class="mt-2 text-2xl font-bold text-gray-900">{{ $stats['profile_status'] }}</p><a href="{{ route('merchant.settings.edit') }}" class="mt-4 inline-block text-sm font-semibold text-primary-700">Update profile →</a></div>
        </div>
        <div class="mt-8 grid gap-6 lg:grid-cols-[1.4fr_.8fr]">
            <section class="rounded-xl bg-white p-6 shadow"><div class="flex items-center justify-between"><h2 class="text-xl font-bold text-gray-900">Recent Orders</h2><a href="{{ route('orders.index') }}" class="text-sm font-semibold text-primary-700">View all</a></div><div class="mt-5 divide-y divide-gray-100">@forelse($recentOrders as $order)<a href="{{ route('orders.show', $order) }}" class="flex items-center justify-between gap-4 py-4 hover:bg-gray-50"><div><p class="font-semibold text-gray-800">#{{ $order->id }} · {{ $order->product?->name ?? 'Product removed' }}</p><p class="mt-1 text-sm text-gray-500">{{ $order->created_at->format('d M Y, h:i A') }}</p></div><span class="rounded-full px-3 py-1 text-xs font-bold {{ $order->status === 'approved' ? 'bg-green-100 text-green-700' : ($order->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">{{ ucfirst($order->status) }}</span></a>@empty<div class="py-8 text-center text-gray-500">You have no orders yet.</div>@endforelse</div></section>
            <section class="rounded-xl bg-primary-700 p-6 text-white shadow"><h2 class="text-xl font-bold">Quick actions</h2><div class="mt-5 space-y-3"><a href="{{ url('/') }}#order" class="block rounded-lg bg-white/10 px-4 py-3 hover:bg-white/20">Buy a new card</a><a href="{{ route('orders.index') }}" class="block rounded-lg bg-white/10 px-4 py-3 hover:bg-white/20">View my orders</a><a href="{{ route('merchant.settings.edit') }}" class="block rounded-lg bg-white/10 px-4 py-3 hover:bg-white/20">Edit profile</a></div></section>
        </div>
    </div>
</main>
@endsection
