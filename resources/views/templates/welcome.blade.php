@extends('layouts.master')
@section('content')

<main id="home">
  <section class="gradient-bg border-b border-slate-200/70">
    <div class="max-w-7xl mx-auto px-4 pt-14 pb-12 lg:pt-20 lg:pb-20">
      <div class="grid lg:grid-cols-[1.05fr_.95fr] gap-10 items-center">
        <div class="fade-up">
          <div class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3.5 py-2 text-xs font-bold text-emerald-700 mb-5"><span class="h-2 w-2 rounded-full bg-emerald-500"></span>ভার্চুয়াল কার্ড অর্ডার চালু আছে</div>
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08]">অনলাইন পেমেন্টের জন্য <span class="text-emerald-600">আপনার ভার্চুয়াল কার্ড।</span></h1>
          <p class="mt-5 text-lg text-slate-600 max-w-xl leading-8">কয়েক মিনিটের মধ্যে একটি নিরাপদ ভার্চুয়াল Mastercard নিন। অনলাইন শপিং, সাবস্ক্রিপশন ও আন্তর্জাতিক পেমেন্ট এখন আরও সহজ।</p>
          <div class="mt-7 flex flex-wrap gap-3"><a href="#order" class="px-5 py-3.5 rounded-xl bg-slate-950 text-white font-bold hover:bg-slate-800 shadow-xl">কার্ড অর্ডার করুন</a><a href="#features" class="px-5 py-3.5 rounded-xl bg-white border border-slate-200 font-bold hover:bg-slate-50">বিস্তারিত দেখুন</a></div>
          <div class="mt-8 flex flex-wrap gap-x-7 gap-y-3 text-sm text-slate-600"><span>✓ দ্রুত ডেলিভারি</span><span>✓ নিরাপদ পেমেন্ট</span><span>✓ ২৪/৭ সাপোর্ট</span></div>
        </div>
        <div class="fade-up relative">
          <div class="absolute -inset-6 rounded-[2.5rem] bg-emerald-200/40 blur-2xl"></div>
          <div class="relative rounded-3xl bg-slate-950 p-6 sm:p-8 text-white shadow-2xl overflow-hidden"><div class="absolute -right-20 -top-20 h-56 w-56 rounded-full border-[30px] border-emerald-400/20"></div><div class="relative"><div class="flex items-center justify-between text-sm text-slate-300"><span>DOLLARXCARD</span><span>VIRTUAL</span></div><div class="mt-10 flex items-center justify-between"><div class="h-11 w-14 rounded-lg bg-amber-300/90"></div><span class="text-3xl font-black italic">mc</span></div><div class="mt-8 font-mono text-xl tracking-[.2em]">•••• 4821</div><div class="mt-7 flex items-end justify-between text-xs text-slate-400"><span>VALID THRU<br><strong class="text-white text-sm">12/30</strong></span><span>CARDHOLDER<br><strong class="text-white text-sm">YOUR NAME</strong></span><span class="text-2xl font-black italic text-white">mc</span></div></div></div>
         
        </div>
      </div>
    </div>
  </section>

  <section id="features" class="py-16 lg:py-20"><div class="max-w-7xl mx-auto px-4"><div class="max-w-2xl mb-10"><p class="text-sm font-black text-emerald-600 uppercase tracking-[.18em]">কেন DollarXcard</p><h2 class="text-3xl sm:text-4xl font-black tracking-tight mt-3">আপনার অনলাইন পেমেন্ট আরও সহজ হোক।</h2><p class="text-slate-500 mt-3 leading-7">একটি কার্ডেই অনলাইন কেনাকাটা, সফটওয়্যার সাবস্ক্রিপশন এবং আন্তর্জাতিক সার্ভিসের পেমেন্ট করুন।</p></div><div class="grid md:grid-cols-3 gap-5"><article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-card"><div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-600 grid place-items-center font-black">✓</div><h3 class="font-black text-lg mt-5">দ্রুত অ্যাক্টিভেশন</h3><p class="text-sm text-slate-500 mt-2 leading-6">পেমেন্ট নিশ্চিত হওয়ার পর সাধারণত ৫–১৫ মিনিটের মধ্যে কার্ডের তথ্য পান।</p></article><article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-card"><div class="h-11 w-11 rounded-xl bg-blue-50 text-blue-600 grid place-items-center font-black">$</div><h3 class="font-black text-lg mt-5">আন্তর্জাতিক পেমেন্ট</h3><p class="text-sm text-slate-500 mt-2 leading-6">অনলাইন শপিং, ডোমেইন, হোস্টিং, বিজ্ঞাপন ও বিভিন্ন সাবস্ক্রিপশনে ব্যবহার করুন।</p></article><article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-card"><div class="h-11 w-11 rounded-xl bg-amber-50 text-amber-600 grid place-items-center font-black">i</div><h3 class="font-black text-lg mt-5">বিশ্বস্ত সাপোর্ট</h3><p class="text-sm text-slate-500 mt-2 leading-6">অর্ডার থেকে ব্যবহার পর্যন্ত যেকোনো প্রশ্নে আমাদের সাপোর্ট টিম পাশে আছে।</p></article></div></div></section>

  <section id="order" class="py-16 lg:py-20 bg-slate-950 text-white">
    <div class="max-w-7xl mx-auto px-4">
      <div class="flex items-end justify-between gap-5 mb-10"><div><p class="text-sm font-black text-emerald-400 uppercase tracking-[.18em]">কার্ড প্যাকেজ</p><h2 class="text-3xl sm:text-4xl font-black mt-3">আপনার পছন্দের কার্ড আজই নিন।</h2><p class="text-slate-400 mt-3 leading-7">প্রতিটি পণ্যের মূল্য, সুবিধা ও ডেলিভারি সময় দেখে আপনার প্রয়োজনীয় virtual card বেছে নিন।</p></div></div>
      @if($products->isEmpty())
        <div class="rounded-3xl border border-white/10 bg-white/5 p-8 text-center text-slate-300">কোনো পণ্য বর্তমানে উপলভ্য নেই।</div>
      @else
        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
          @foreach($products as $product)
            <article class="rounded-3xl border border-white/10 bg-white p-6 text-slate-950 shadow-2xl flex flex-col">
              @if($product->image)<img src="{{ asset('uploads/products/'.$product->image) }}" alt="{{ $product->name }}" class="w-full aspect-[16/9] rounded-2xl object-cover mb-5">@endif
              <div class="flex items-start justify-between gap-3"><div><h3 class="text-xl font-black">{{ $product->name }}</h3><p class="text-sm text-slate-500 mt-1">{{ $product->description }}</p></div><span class="shrink-0 rounded-full bg-emerald-100 text-emerald-700 px-3 py-1.5 text-xs font-black">Active</span></div>
              <div class="mt-6 flex items-end justify-between border-b border-slate-100 pb-5"><strong class="text-3xl font-black">{{ $product->currency }} {{ number_format((float) $product->price, 2) }}</strong><span class="text-sm text-slate-500">{{ $product->delivery_time ?: 'দ্রুত ডেলিভারি' }}</span></div>
              @if($product->features)<ul class="mt-5 space-y-2 text-sm text-slate-600">@foreach(preg_split('/\r\n|\r|\n/', $product->features) as $feature)@if(trim($feature))<li>✓ {{ trim($feature) }}</li>@endif @endforeach</ul>@endif
              <a href="{{ route('orders.create', $product) }}" class="mt-7 block w-full rounded-2xl bg-emerald-600 py-4 text-center font-black text-white hover:bg-emerald-700 shadow-lg shadow-emerald-600/20">এই কার্ডটি অর্ডার করুন →</a>
            </article>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  <section id="steps" class="py-16 lg:py-20"><div class="max-w-7xl mx-auto px-4"><div class="text-center mb-10"><p class="text-sm font-black text-emerald-600 uppercase tracking-[.18em]">কীভাবে কাজ করে</p><h2 class="text-3xl sm:text-4xl font-black mt-2">মাত্র তিনটি ধাপে কার্ড নিন</h2></div><div class="grid md:grid-cols-3 gap-5"><div class="text-center p-6"><div class="mx-auto h-12 w-12 rounded-full bg-slate-950 text-white grid place-items-center font-black">১</div><h3 class="font-black mt-4">অর্ডার পাঠান</h3><p class="text-sm text-slate-500 mt-2">অর্ডার বাটনে ক্লিক করে আপনার প্রয়োজনীয় তথ্য দিন।</p></div><div class="text-center p-6"><div class="mx-auto h-12 w-12 rounded-full bg-slate-950 text-white grid place-items-center font-black">২</div><h3 class="font-black mt-4">পেমেন্ট নিশ্চিত করুন</h3><p class="text-sm text-slate-500 mt-2">নির্দেশনা অনুযায়ী পেমেন্ট সম্পন্ন করুন।</p></div><div class="text-center p-6"><div class="mx-auto h-12 w-12 rounded-full bg-slate-950 text-white grid place-items-center font-black">৩</div><h3 class="font-black mt-4">কার্ড ব্যবহার করুন</h3><p class="text-sm text-slate-500 mt-2">কার্ডের তথ্য পেয়ে নিরাপদে অনলাইন পেমেন্ট করুন।</p></div></div></div></section>

  <section id="faq" class="py-16 lg:py-20 bg-white border-y border-slate-200"><div class="max-w-4xl mx-auto px-4"><div class="text-center mb-10"><p class="text-sm font-black text-emerald-600 uppercase tracking-[.18em]">সাধারণ প্রশ্ন</p><h2 class="text-3xl sm:text-4xl font-black mt-2">আপনার যা জানা দরকার</h2></div><div class="space-y-3"><details class="group border border-slate-200 rounded-2xl p-5 shadow-card"><summary class="cursor-pointer list-none font-black flex justify-between gap-4">ভার্চুয়াল কার্ড কোথায় ব্যবহার করা যাবে?<span class="group-open:rotate-45 transition text-2xl leading-none">+</span></summary><p class="text-slate-500 mt-4 leading-7">যেসব অনলাইন সেবা Mastercard গ্রহণ করে সেখানে শপিং, সাবস্ক্রিপশন, হোস্টিং ও বিজ্ঞাপনের পেমেন্টে ব্যবহার করা যাবে।</p></details><details class="group border border-slate-200 rounded-2xl p-5 shadow-card"><summary class="cursor-pointer list-none font-black flex justify-between gap-4">কার্ড পেতে কত সময় লাগে?<span class="group-open:rotate-45 transition text-2xl leading-none">+</span></summary><p class="text-slate-500 mt-4 leading-7">পেমেন্ট নিশ্চিত হওয়ার পর সাধারণত ৫–১৫ মিনিটের মধ্যে কার্ডের তথ্য পাঠানো হয়।</p></details><details class="group border border-slate-200 rounded-2xl p-5 shadow-card"><summary class="cursor-pointer list-none font-black flex justify-between gap-4">কার্ডটি কি নিরাপদ?<span class="group-open:rotate-45 transition text-2xl leading-none">+</span></summary><p class="text-slate-500 mt-4 leading-7">কার্ডের তথ্য শুধু আপনার সঙ্গে শেয়ার করা হয়। OTP, CVV বা কার্ডের তথ্য কখনো কারও সঙ্গে শেয়ার করবেন না।</p></details></div></div></section>

  <section id="support" class="py-16 bg-emerald-600 text-white"><div class="max-w-7xl mx-auto px-4 flex flex-col lg:flex-row lg:items-center justify-between gap-8"><div><p class="font-black uppercase tracking-[.18em] text-emerald-100 text-sm">সহায়তা দরকার?</p><h2 class="text-3xl font-black mt-2">আমাদের টিম আপনার পাশে আছে।</h2><p class="text-emerald-50 mt-3">অর্ডার বা কার্ড ব্যবহার নিয়ে যেকোনো প্রশ্নে যোগাযোগ করুন।</p></div><div class="flex flex-wrap gap-3"><a href="https://wa.me/{{ $siteSettings->whatsapp_number }}" target="_blank" class="px-5 py-3.5 rounded-xl bg-white text-emerald-700 font-black hover:bg-emerald-50">WhatsApp</a><a href="mailto:{{ $siteSettings->email }}" class="px-5 py-3.5 rounded-xl bg-emerald-700/40 border border-white/20 font-black hover:bg-emerald-700">ইমেইল করুন</a></div></div></section>
</main>
@endsection
