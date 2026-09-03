@extends('layouts.master')

@section('content')
<main class="flex-1 overflow-y-auto bg-gray-50 p-4 md:p-8">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div><p class="text-sm font-semibold text-primary-700">Merchant Dashboard</p><h1 class="mt-1 text-3xl font-bold text-gray-900">স্বাগতম, {{ auth()->user()->name }}!</h1><p class="mt-2 text-gray-500">আপনার card order, status এবং profile-এর সংক্ষিপ্ত চিত্র এখানে দেখুন।</p></div>
            <a href="{{ url('/') }}#order" class="inline-flex w-fit items-center rounded-lg bg-primary-700 px-5 py-3 font-semibold text-white shadow hover:bg-primary-800">নতুন কার্ড কিনুন</a>
        </div>
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl bg-white p-6 shadow"><p class="text-sm text-gray-500">মোট অর্ডার</p><p class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p><a href="{{ route('orders.index') }}" class="mt-4 inline-block text-sm font-semibold text-primary-700">অর্ডার দেখুন →</a></div>
            <div class="rounded-xl bg-white p-6 shadow"><p class="text-sm text-gray-500">Pending</p><p class="mt-2 text-3xl font-bold text-amber-600">{{ $stats['pending_orders'] }}</p></div>
            <div class="rounded-xl bg-white p-6 shadow"><p class="text-sm text-gray-500">Approved</p><p class="mt-2 text-3xl font-bold text-green-600">{{ $stats['approved_orders'] }}</p></div>
            <div class="rounded-xl bg-white p-6 shadow"><p class="text-sm text-gray-500">প্রোফাইল স্ট্যাটাস</p><p class="mt-2 text-2xl font-bold text-gray-900">{{ $stats['profile_status'] }}</p><a href="{{ route('merchant.settings.edit') }}" class="mt-4 inline-block text-sm font-semibold text-primary-700">প্রোফাইল আপডেট করুন →</a></div>
        </div>
        <div class="mt-8 grid gap-6 lg:grid-cols-[1.4fr_.8fr]">
            <section class="rounded-xl bg-white p-6 shadow"><div class="flex items-center justify-between"><h2 class="text-xl font-bold text-gray-900">সাম্প্রতিক অর্ডার</h2><a href="{{ route('orders.index') }}" class="text-sm font-semibold text-primary-700">সব দেখুন</a></div><div class="mt-5 divide-y divide-gray-100">@forelse($recentOrders as $order)<a href="{{ route('orders.show', $order) }}" class="flex items-center justify-between gap-4 py-4 hover:bg-gray-50"><div><p class="font-semibold text-gray-800">#{{ $order->id }} · {{ $order->product?->name ?? 'Product removed' }}</p><p class="mt-1 text-sm text-gray-500">{{ $order->created_at->format('d M Y, h:i A') }}</p></div><span class="rounded-full px-3 py-1 text-xs font-bold {{ $order->status === 'approved' ? 'bg-green-100 text-green-700' : ($order->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">{{ ucfirst($order->status) }}</span></a>@empty<div class="py-8 text-center text-gray-500">আপনার কোনো order নেই।</div>@endforelse</div></section>
            <section class="rounded-xl bg-primary-700 p-6 text-white shadow"><h2 class="text-xl font-bold">দ্রুত কাজ</h2><div class="mt-5 space-y-3"><a href="{{ url('/') }}#order" class="block rounded-lg bg-white/10 px-4 py-3 hover:bg-white/20">নতুন কার্ড কিনুন</a><a href="{{ route('orders.index') }}" class="block rounded-lg bg-white/10 px-4 py-3 hover:bg-white/20">আমার অর্ডার দেখুন</a><a href="{{ route('merchant.settings.edit') }}" class="block rounded-lg bg-white/10 px-4 py-3 hover:bg-white/20">প্রোফাইল সম্পাদনা করুন</a></div></section>
        </div>
    </div>
</main>
@endsection
