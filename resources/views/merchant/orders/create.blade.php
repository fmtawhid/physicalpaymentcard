@extends('layouts.master')

@section('content')
<main class="min-h-screen bg-[#f5f7fb] py-8 lg:py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <a href="{{ url('/') }}#order" class="text-sm font-black text-orange-600 hover:text-orange-700">← পণ্যের তালিকায় ফিরুন</a>
                <p class="mt-6 text-xs font-black uppercase tracking-[.22em] text-orange-600">Secure checkout</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">আপনার virtual card order সম্পূর্ণ করুন</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">আপনার তথ্য, payment reference এবং slip দিয়ে order submit করুন। Verification শেষ হলে card details আপনার account-এ পাওয়া যাবে।</p>
            </div>
            <div class="flex items-center gap-2 text-xs font-bold text-slate-500"><span class="grid h-8 w-8 place-items-center rounded-full bg-emerald-100 text-emerald-700">1</span><span>Details</span><span class="h-px w-8 bg-slate-200"></span><span class="grid h-8 w-8 place-items-center rounded-full bg-slate-950 text-white">2</span><span>Payment</span></div>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-100 bg-red-50 p-4 text-sm text-red-700 shadow-sm"><p class="font-black">Form-এ কিছু তথ্য ঠিক করতে হবে</p><ul class="mt-2 list-disc space-y-1 pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif

        <div class="grid items-start gap-6 lg:grid-cols-[minmax(0,1.45fr)_minmax(320px,.7fr)]">
            <form class="space-y-6" method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <section class="rounded-3xl border border-slate-200/80 bg-white p-6 shadow-[0_16px_50px_rgba(15,23,42,.06)] sm:p-8">
                    <div class="mb-6 flex items-start justify-between gap-4 border-b border-slate-100 pb-5"><div><p class="text-xs font-black uppercase tracking-[.18em] text-orange-600">01 / Customer</p><h2 class="mt-2 text-2xl font-black text-slate-950">আপনার তথ্য</h2><p class="mt-1 text-sm text-slate-500">Profile-এর তথ্য থাকলে automatically পূরণ হবে।</p></div><span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-orange-50 text-xl font-black text-orange-600">$</span></div>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div><label class="block text-sm font-bold text-slate-700">আপনার নাম *</label><input name="customer_name" value="{{ old('customer_name', auth()->user()?->name) }}" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100"></div>
                        <div><label class="block text-sm font-bold text-slate-700">ইমেইল *</label><input type="email" name="customer_email" value="{{ old('customer_email', auth()->user()?->email) }}" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100"></div>
                        @guest
                            <div><label class="block text-sm font-bold text-slate-700">পাসওয়ার্ড *</label><input type="password" name="password" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100"><p class="mt-1 text-xs text-slate-500">Order submit হলে account তৈরি হবে।</p></div>
                            <div><label class="block text-sm font-bold text-slate-700">পাসওয়ার্ড নিশ্চিত করুন *</label><input type="password" name="password_confirmation" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100"></div>
                        @endguest
                        <div><label class="block text-sm font-bold text-slate-700">মোবাইল নম্বর *</label><input name="customer_phone" value="{{ old('customer_phone', auth()->user()?->phone) }}" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100"></div>
                        <div><label class="block text-sm font-bold text-slate-700">Country *</label><select name="customer_country" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100"><option value="">Select country</option>@foreach(config('locations.countries') as $country)<option value="{{ $country }}" {{ old('customer_country', auth()->user()?->country) === $country ? 'selected' : '' }}>{{ $country }}</option>@endforeach</select></div>
                        <div><label class="block text-sm font-bold text-slate-700">District *</label><select name="customer_district" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100"><option value="">Select district</option>@foreach(config('locations.districts') as $district)<option value="{{ $district }}" {{ old('customer_district', auth()->user()?->district) === $district ? 'selected' : '' }}>{{ $district }}</option>@endforeach</select></div>
                    </div>
                    <div class="mt-5"><label class="block text-sm font-bold text-slate-700">Delivery Address *</label><textarea name="delivery_address" rows="3" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100">{{ old('delivery_address', auth()->user()?->delivery_address) }}</textarea></div>
                </section>

                <section class="rounded-3xl border border-slate-200/80 bg-white p-6 shadow-[0_16px_50px_rgba(15,23,42,.06)] sm:p-8">
                    <div class="mb-6 border-b border-slate-100 pb-5"><p class="text-xs font-black uppercase tracking-[.18em] text-orange-600">02 / Payment</p><h2 class="mt-2 text-2xl font-black text-slate-950">Payment details</h2><p class="mt-1 text-sm text-slate-500">Payment করার পর reference এবং proof upload করুন।</p></div>
                    <div class="grid gap-5 sm:grid-cols-2"><div><label class="block text-sm font-bold text-slate-700">পেমেন্ট মাধ্যম *</label><select name="payment_method" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100"><option value="">নির্বাচন করুন</option>@foreach(['bKash','Nagad','Rocket','Bank Transfer'] as $method)<option value="{{ $method }}" {{ old('payment_method') === $method ? 'selected' : '' }}>{{ $method }}</option>@endforeach</select></div><div><label class="block text-sm font-bold text-slate-700">যে নম্বর/অ্যাকাউন্ট থেকে পেমেন্ট করেছেন *</label><input name="payment_number" value="{{ old('payment_number') }}" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100"></div></div>
                    <div class="mt-5"><label class="block text-sm font-bold text-slate-700">পেমেন্ট স্লিপ *</label><input type="file" name="payment_slip" accept="image/jpeg,image/png,image/webp,application/pdf" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-3 text-sm"><p class="mt-1 text-xs text-slate-500">JPG, PNG, WEBP অথবা PDF, সর্বোচ্চ ৫MB</p></div>
                </section>

                <button class="flex w-full items-center justify-center gap-3 rounded-2xl bg-slate-950 py-4 text-base font-black text-white shadow-xl shadow-slate-950/15 transition hover:bg-orange-600" type="submit">অর্ডার জমা দিন <span class="text-xl">→</span></button>
            </form>

            <aside class="space-y-6 lg:sticky lg:top-24">
                <section class="overflow-hidden rounded-3xl bg-[#21130f] p-6 text-white shadow-2xl sm:p-7"><div class="flex items-start justify-between"><div><p class="text-xs font-black uppercase tracking-[.18em] text-orange-200">Your selection</p><h2 class="mt-2 text-2xl font-black">{{ $product->name }}</h2></div><span class="grid h-11 w-11 place-items-center rounded-2xl bg-orange-500 text-xl font-black">$</span></div><div class="mt-7 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-300 p-5 text-slate-950 shadow-xl"><div class="flex items-start justify-between"><span class="text-xl font-black tracking-[-.08em]">dollarX</span><span class="text-lg font-black italic">mc</span></div><div class="mt-8 h-8 w-11 rounded-lg bg-gradient-to-br from-yellow-100 to-orange-100"></div><p class="mt-6 font-mono text-lg tracking-[.2em]">•••• 4821</p><div class="mt-5 flex justify-between text-[10px] font-black uppercase tracking-widest text-slate-900/60"><span>Virtual Mastercard</span><span>Secure</span></div></div><div class="mt-6 flex items-end justify-between border-t border-white/10 pt-5"><span class="text-sm text-orange-100/65">পরিশোধযোগ্য</span><strong class="text-2xl font-black">{{ $product->currency }} {{ number_format((float) $product->price, 2) }}</strong></div></section>
                <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_16px_50px_rgba(15,23,42,.06)]"><p class="text-xs font-black uppercase tracking-[.18em] text-orange-600">Payment account</p><h3 class="mt-2 text-lg font-black text-slate-950">এই account-এ payment করুন</h3><div class="mt-4 space-y-2 text-sm text-slate-600">@if($settings->bkash_number)<p><strong>bKash:</strong> {{ $settings->bkash_number }}</p>@endif @if($settings->nagad_number)<p><strong>Nagad:</strong> {{ $settings->nagad_number }}</p>@endif @if($settings->rocket_number)<p><strong>Rocket:</strong> {{ $settings->rocket_number }}</p>@endif @if($settings->bank_name)<p><strong>{{ $settings->bank_name }}:</strong> {{ $settings->bank_account_number }} ({{ $settings->bank_account_name }})</p>@endif</div>@if($settings->payment_instructions)<p class="mt-4 whitespace-pre-line border-t border-slate-100 pt-4 text-xs leading-5 text-slate-500">{{ $settings->payment_instructions }}</p>@endif</section>
                <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4 text-xs leading-5 text-amber-800">Payment-এর আগে product price মিলিয়ে নিন। Admin যাচাই শেষ না হওয়া পর্যন্ত order status <strong>Pending</strong> থাকবে।</div>
            </aside>
        </div>
    </div>
</main>
@endsection
