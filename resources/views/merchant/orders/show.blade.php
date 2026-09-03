@extends('layouts.master')

@section('content')
<main class="min-h-screen bg-slate-50 py-12">
    <div class="mx-auto max-w-3xl px-4">
        <a href="{{ route('orders.index') }}" class="text-sm font-bold text-emerald-700">← আমার অর্ডারে ফিরুন</a>

        <div class="mt-5 rounded-3xl bg-white p-6 shadow-xl sm:p-8">
            <div class="flex flex-col justify-between gap-4 border-b border-slate-100 pb-6 sm:flex-row">
                <div>
                    <p class="text-sm text-slate-500">Order #{{ $order->id }}</p>
                    <h1 class="mt-1 text-2xl font-black text-slate-950">{{ $order->product?->name ?? 'Product removed' }}</h1>
                </div>
                <span class="h-fit rounded-full px-4 py-2 text-sm font-bold {{ $order->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($order->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="mt-6 grid gap-4 text-sm sm:grid-cols-2">
                <div><span class="text-slate-500">পেমেন্ট মাধ্যম</span><strong class="mt-1 block">{{ $order->payment_method }}</strong></div>
                <div><span class="text-slate-500">পেমেন্ট নম্বর</span><strong class="mt-1 block">{{ $order->payment_number }}</strong></div>
                <div><span class="text-slate-500">Amount</span><strong class="mt-1 block">{{ $order->product?->currency ?? 'USD' }} {{ number_format((float) $order->amount, 2) }}</strong></div>
                <div><span class="text-slate-500">Submitted</span><strong class="mt-1 block">{{ $order->created_at->format('d M Y, h:i A') }}</strong></div>
            </div>

            @if($order->status === 'approved')
                <div class="mt-7 rounded-2xl border border-emerald-200 bg-emerald-50 p-5">
                    <h2 class="text-lg font-black text-emerald-900">আপনার Card Information</h2>
                    <p class="mt-1 text-sm text-emerald-800">Admin কর্তৃক approve করা তথ্য নিচে দেওয়া হলো।</p>

                    @if($order->card_info_name)
                        <div class="mt-5">
                            <span class="text-xs font-bold uppercase text-emerald-700">Card Info Name</span>
                            <p class="mt-1 text-lg font-black text-emerald-950">{{ $order->card_info_name }}</p>
                        </div>
                    @endif

                    @if($order->card_info_note)
                        <div class="mt-4 whitespace-pre-line rounded-xl bg-white/70 p-4 text-sm leading-7 text-emerald-950">{{ $order->card_info_note }}</div>
                    @endif
                </div>
            @elseif($order->status === 'rejected')
                <div class="mt-7 rounded-2xl bg-red-50 p-5 text-red-800">
                    <h2 class="font-black">Order rejected</h2>
                    <p class="mt-1 text-sm">{{ $order->admin_note ?: 'Admin আপনার order approve করেনি। Support-এর সঙ্গে যোগাযোগ করুন।' }}</p>
                </div>
            @else
                <div class="mt-7 rounded-2xl bg-amber-50 p-5 text-amber-800">
                    <h2 class="font-black">Order যাচাই হচ্ছে</h2>
                    <p class="mt-1 text-sm">Payment slip যাচাই শেষ হলে এই page-এ card information দেখা যাবে।</p>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
