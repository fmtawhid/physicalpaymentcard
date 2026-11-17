@extends('layouts.master')

@section('content')
<main class="min-h-screen bg-slate-100 py-8 sm:py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <header class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-black uppercase tracking-[.2em] text-emerald-700">Card wallet</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">My cards</h1>
                <p class="mt-2 text-sm text-slate-500 sm:text-base">Your approved cards and available balance in one place.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('orders.index') }}" class="flex-1 rounded-xl border border-slate-200 bg-white px-4 py-3 text-center text-sm font-bold text-slate-700 shadow-sm hover:bg-slate-50 sm:flex-none">My Orders</a>
                <a href="{{ url('/') }}#order" class="flex-1 rounded-xl bg-slate-950 px-4 py-3 text-center text-sm font-bold text-white shadow-sm hover:bg-slate-800 sm:flex-none">Order a card</a>
            </div>
        </header>

        <section class="mt-7 overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-700 via-emerald-600 to-teal-500 p-6 text-white shadow-lg shadow-emerald-900/10 sm:p-8">
            <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
                <div>
                    <p class="text-sm font-semibold text-emerald-50">Total available balance</p>
                    <p class="mt-2 text-4xl font-black tracking-tight sm:text-5xl">${{ number_format((float) auth()->user()->balance, 2) }} <span class="text-xl font-bold text-emerald-100 sm:text-2xl">USD</span></p>
                </div>
                <div class="rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-sm text-emerald-50 backdrop-blur-sm">
                    <span class="font-bold text-white">{{ $cards->count() }}</span> active {{ \Illuminate\Support\Str::plural('card', $cards->count()) }}
                </div>
            </div>
        </section>

        @if($cards->isEmpty())
            <section class="mt-8 rounded-3xl border border-slate-200 bg-white px-6 py-14 text-center shadow-sm sm:px-12">
                <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-slate-100 text-2xl text-slate-500">▣</div>
                <h2 class="mt-5 text-xl font-black text-slate-900">No approved card yet</h2>
                <p class="mt-2 text-sm text-slate-500">Once an order is approved and card details are ready, your card will appear here.</p>
                <a href="{{ url('/') }}#order" class="mt-6 inline-flex rounded-xl bg-emerald-600 px-5 py-3 font-bold text-white hover:bg-emerald-700">Browse cards</a>
            </section>
        @else
            <section class="mt-8 grid justify-items-center gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach($cards as $card)
                    <article class="w-full max-w-[390px] min-w-0 overflow-hidden rounded-3xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg sm:p-5">
                        <div class="relative mx-auto h-[220px] w-[350px] max-w-full overflow-hidden rounded-[1.4rem] bg-[#111217] p-5 text-white shadow-xl">
                            <div class="relative flex h-full flex-col justify-between">
                                <div class="flex min-w-0 items-center justify-between gap-3">
                                    <div class="flex min-w-0 items-center gap-3">
                                        @if($card->product?->logo || $card->product?->image)
                                            <img src="{{ asset('uploads/products/'.($card->product->logo ?: $card->product->image)) }}" alt="{{ $card->product->name }} logo" class="h-10 w-10 shrink-0 rounded-xl bg-white object-contain shadow-sm">
                                        @else
                                            <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl border border-white/20 bg-white/10 text-lg font-black">▣</div>
                                        @endif
                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-black leading-tight text-white">{{ $card->card_info_name ?: ($card->product?->name ?? 'Virtual Mastercard') }}</p>
                                            <p class="mt-1 text-[8px] font-bold uppercase tracking-[.2em] text-slate-400">Virtual card</p>
                                        </div>
                                    </div>
                                    <span class="shrink-0 rounded-full border border-white/15 bg-white/5 px-2.5 py-1 text-[9px] font-bold uppercase tracking-[.16em] text-slate-300">Virtual</span>
                                </div>

                                <div class="relative">
                                    <p class="font-mono text-base font-semibold tracking-[.12em]">{{ $card->card_number }}</p>
                                    <div class="mt-4 grid grid-cols-[minmax(0,1fr)_auto_auto_auto] items-end gap-3 text-[9px] uppercase tracking-[.12em] text-slate-400">
                                        <div class="min-w-0">
                                            <span>Cardholder</span>
                                            <p class="mt-1 truncate text-xs font-bold tracking-normal text-white">{{ $card->card_holder_name ?: $card->customer_name }}</p>
                                        </div>
                                        <div class="shrink-0">
                                            <span>Valid thru</span>
                                            <p class="mt-1 text-xs font-bold tracking-normal text-white">{{ $card->card_expiry ?: '--/--' }}</p>
                                        </div>
                                        <div class="shrink-0">
                                            <span>CVV</span>
                                            <p class="mt-1 text-xs font-bold tracking-normal text-white">{{ $card->card_cvv ?: '---' }}</p>
                                        </div>
                                        <div class="flex shrink-0 items-center" aria-label="Mastercard">
                                            <span class="h-5 w-5 rounded-full bg-[#eb001b]/90"></span>
                                            <span class="-ml-2 h-5 w-5 rounded-full bg-[#f79e1b]/90"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="truncate text-xs font-bold uppercase tracking-wider text-slate-400">Order #{{ $card->id }}</p>
                                <h3 class="mt-1 truncate text-lg font-black text-slate-900">{{ $card->product?->name ?? 'Virtual Card' }}</h3>
                            </div>
                            <span class="shrink-0 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">Approved</span>
                        </div>

                        <div class="mt-4 rounded-2xl bg-emerald-50 p-3">
                            <p class="text-xs font-semibold text-emerald-700">Added to balance</p>
                            <p class="mt-1 font-black text-emerald-900">${{ number_format((float) $card->balance_credit, 2) }} USD</p>
                        </div>

                        @if($card->card_info_note)
                            <div class="mt-4 whitespace-pre-line rounded-2xl border border-slate-100 bg-slate-50 p-4 text-sm leading-6 text-slate-600">{{ $card->card_info_note }}</div>
                        @endif
                    </article>
                @endforeach
            </section>
        @endif
    </div>
</main>
@endsection
