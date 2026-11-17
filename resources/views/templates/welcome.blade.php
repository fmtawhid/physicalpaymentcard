@extends('layouts.master')
@section('content')

<main id="home">
  <section class="gradient-bg border-b border-slate-200/70">
    <div class="max-w-7xl mx-auto px-4 pt-14 pb-12 lg:pt-20 lg:pb-20">
      <div class="grid lg:grid-cols-[1.05fr_.95fr] gap-10 items-center">
        <div class="fade-up">
          <div class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3.5 py-2 text-xs font-bold text-emerald-700 mb-5"><span class="h-2 w-2 rounded-full bg-emerald-500"></span>Virtual card orders are open</div>
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08]">Your <span class="text-emerald-600">virtual card</span> for online payments.</h1>
          <p class="mt-5 text-lg text-slate-600 max-w-xl leading-8">Get a secure virtual Mastercard in minutes. Online shopping, subscriptions, and international payments are now simpler.</p>
          <div class="mt-7 flex flex-wrap gap-3"><a href="#order" class="px-5 py-3.5 rounded-xl bg-slate-950 text-white font-bold hover:bg-slate-800 shadow-xl">Order your card</a><a href="#features" class="px-5 py-3.5 rounded-xl bg-white border border-slate-200 font-bold hover:bg-slate-50">Explore details</a></div>
          <div class="mt-8 flex flex-wrap gap-x-7 gap-y-3 text-sm text-slate-600"><span>✓ Fast delivery</span><span>✓ Secure payments</span><span>✓ 24/7 support</span></div>
        </div>
        <div class="fade-up relative">
          <div class="absolute -inset-6 rounded-[2.5rem] bg-emerald-200/40 blur-2xl"></div>
          <div class="relative rounded-3xl bg-[#20120f] p-6 sm:p-8 text-white shadow-2xl overflow-hidden"><div class="absolute -right-20 -top-20 h-56 w-56 rounded-full border-[30px] border-orange-400/20"></div><div class="absolute -left-24 -bottom-28 h-64 w-64 rounded-full bg-[#ff5a1f]/20 blur-2xl"></div><div class="relative"><div class="flex items-center justify-between text-sm text-orange-100"><span class="text-2xl font-black tracking-[-.06em] text-white">payoneer</span><span class="rounded-full border border-orange-200/30 px-2.5 py-1 text-[10px] font-bold tracking-[.18em]">VIRTUAL</span></div><div class="mt-10 flex items-center justify-between"><div class="h-11 w-14 rounded-lg bg-gradient-to-br from-orange-300 to-amber-100 shadow-inner"></div><span class="text-3xl font-black italic">mc</span></div><div class="mt-8 font-mono text-xl tracking-[.2em]">•••• 4821</div><div class="mt-7 flex items-end justify-between text-xs text-orange-100/70"><span>VALID THRU<br><strong class="text-white text-sm">12/30</strong></span><span>CARDHOLDER<br><strong class="text-white text-sm">YOUR NAME</strong></span><span class="text-2xl font-black italic text-white">mc</span></div></div></div>
        </div>
      </div>
    </div>
  </section>

  <section id="features" class="py-16 lg:py-20"><div class="max-w-7xl mx-auto px-4"><div class="max-w-2xl mb-10"><p class="text-sm font-black text-emerald-600 uppercase tracking-[.18em]">Why payoneercard</p><h2 class="text-3xl sm:text-4xl font-black tracking-tight mt-3">Make your online payments easier.</h2><p class="text-slate-500 mt-3 leading-7">Use one card for online shopping, software subscriptions and international services.</p></div><div class="grid md:grid-cols-3 gap-5"><article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-card"><div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-600 grid place-items-center font-black">✓</div><h3 class="font-black text-lg mt-5">Fast activation</h3><p class="text-sm text-slate-500 mt-2 leading-6">Once your payment is confirmed, you’ll usually receive your card details within 5–15 minutes.</p></article><article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-card"><div class="h-11 w-11 rounded-xl bg-blue-50 text-blue-600 grid place-items-center font-black">$</div><h3 class="font-black text-lg mt-5">International payments</h3><p class="text-sm text-slate-500 mt-2 leading-6">Use it for online shopping, domains, hosting, ads and various subscriptions.</p></article><article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-card"><div class="h-11 w-11 rounded-xl bg-amber-50 text-amber-600 grid place-items-center font-black">i</div><h3 class="font-black text-lg mt-5">Trusted support</h3><p class="text-sm text-slate-500 mt-2 leading-6">From order to usage, our support team is available for any questions.</p></article></div></div></section>

  <section id="order" class="border-y border-slate-200 bg-slate-50 py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4">
      <div class="mb-10 max-w-2xl"><p class="text-sm font-black uppercase tracking-[.18em] text-emerald-700">Card packages</p><h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Choose your card today.</h2><p class="mt-3 leading-7 text-slate-600">Compare each product’s price, benefits, and delivery time to select the right virtual card for your needs.</p></div>
      @if($products->isEmpty())
        <div class="rounded-3xl border border-slate-200 bg-white p-8 text-center text-slate-600 shadow-sm">No products are currently available.</div>
      @else
        <div class="grid items-stretch gap-6 md:grid-cols-2 xl:grid-cols-3">
          @foreach($products as $product)
            <article class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
              <div class="relative aspect-[16/10] overflow-hidden bg-gradient-to-br from-slate-100 to-slate-50 p-5 sm:p-6">
                <div class="absolute -right-10 -top-12 h-36 w-36 rounded-full border-[18px] border-white/70"></div>
                @if($product->image || $product->logo)
                  <img src="{{ asset('uploads/products/'.($product->image ?: $product->logo)) }}" alt="{{ $product->name }}" class="relative h-full w-full object-contain transition duration-500 group-hover:scale-105">
                @else
                  <div class="relative grid h-full place-items-center">
                    <div class="grid h-16 w-16 place-items-center rounded-2xl bg-white text-2xl font-black text-emerald-700 shadow-sm">▣</div>
                  </div>
                @endif
                <span class="absolute bottom-4 left-4 rounded-full border border-white/80 bg-white/90 px-3 py-1 text-[10px] font-black uppercase tracking-[.16em] text-slate-600 shadow-sm">Virtual card</span>
              </div>

              <div class="flex flex-1 flex-col p-5 sm:p-6">
                <div class="flex items-start justify-between gap-3">
                  <div class="min-w-0">
                    <h3 class="text-xl font-black leading-tight text-slate-950">{{ $product->name }}</h3>
                    @if($product->description)
                      <p class="mt-2 text-sm leading-6 text-slate-500" style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden;">{{ $product->description }}</p>
                    @endif
                  </div>
                  <span class="shrink-0 rounded-full bg-emerald-50 px-3 py-1.5 text-[10px] font-black uppercase tracking-wider text-emerald-700">Available</span>
                </div>

                <div class="mt-5 flex items-center justify-between gap-3 rounded-2xl bg-slate-50 px-4 py-3.5">
                  <div>
                    <p class="text-[10px] font-bold uppercase tracking-[.16em] text-slate-400">Price</p>
                    <p class="mt-1 text-2xl font-black tracking-tight text-slate-950">{{ $product->currency }} {{ number_format((float) $product->price, 2) }}</p>
                  </div>
                  <div class="text-right">
                    <p class="text-[10px] font-bold uppercase tracking-[.16em] text-slate-400">Delivery</p>
                    <p class="mt-1 text-sm font-bold text-slate-700">{{ $product->delivery_time ?: 'Fast delivery' }}</p>
                  </div>
                </div>

                @if($product->features)
                  <div class="mt-5">
                    <p class="mb-3 text-[10px] font-black uppercase tracking-[.16em] text-slate-400">Card benefits</p>
                    <ul class="space-y-2.5 text-sm text-slate-600">
                      @foreach(preg_split('/\r\n|\r|\n/', $product->features) as $feature)
                        @if(trim($feature))
                          <li class="flex items-start gap-2.5">
                            <span class="mt-0.5 grid h-4 w-4 shrink-0 place-items-center rounded-full bg-emerald-100 text-[10px] font-black leading-none text-emerald-700">✓</span>
                            <span>{{ trim($feature) }}</span>
                          </li>
                        @endif
                      @endforeach
                    </ul>
                  </div>
                @endif

                <a href="{{ route('orders.create', $product) }}" class="mt-auto inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3.5 text-center font-black text-white shadow-lg shadow-emerald-600/15 transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                  Order this card <span aria-hidden="true">→</span>
                </a>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  <section id="steps" class="py-16 lg:py-20"><div class="max-w-7xl mx-auto px-4"><div class="text-center mb-10"><p class="text-sm font-black text-emerald-600 uppercase tracking-[.18em]">How it works</p><h2 class="text-3xl sm:text-4xl font-black mt-2">Get your card in three steps</h2></div><div class="grid md:grid-cols-3 gap-5"><div class="text-center p-6"><div class="mx-auto h-12 w-12 rounded-full bg-slate-950 text-white grid place-items-center font-black">1</div><h3 class="font-black mt-4">Place your order</h3><p class="text-sm text-slate-500 mt-2">Click the order button and enter the required information.</p></div><div class="text-center p-6"><div class="mx-auto h-12 w-12 rounded-full bg-slate-950 text-white grid place-items-center font-black">2</div><h3 class="font-black mt-4">Confirm payment</h3><p class="text-sm text-slate-500 mt-2">Complete payment as instructed and share the reference.</p></div><div class="text-center p-6"><div class="mx-auto h-12 w-12 rounded-full bg-slate-950 text-white grid place-items-center font-black">3</div><h3 class="font-black mt-4">Use your card</h3><p class="text-sm text-slate-500 mt-2">Once your card is ready, use it securely for online payments.</p></div></div></div></section>

  <section id="faq" class="py-16 lg:py-20 bg-white border-y border-slate-200"><div class="max-w-4xl mx-auto px-4"><div class="text-center mb-10"><p class="text-sm font-black text-emerald-600 uppercase tracking-[.18em]">FAQ</p><h2 class="text-3xl sm:text-4xl font-black mt-2">What you need to know</h2></div><div class="space-y-3"><details class="group border border-slate-200 rounded-2xl p-5 shadow-card"><summary class="cursor-pointer list-none font-black flex justify-between gap-4">Where can I use a virtual card?<span class="group-open:rotate-45 transition text-2xl leading-none">+</span></summary><p class="text-slate-500 mt-4 leading-7">You can use it on online services that accept Mastercard, including shopping, subscriptions, hosting, and advertising platforms.</p></details><details class="group border border-slate-200 rounded-2xl p-5 shadow-card"><summary class="cursor-pointer list-none font-black flex justify-between gap-4">How long does delivery take?<span class="group-open:rotate-45 transition text-2xl leading-none">+</span></summary><p class="text-slate-500 mt-4 leading-7">After payment confirmation, card details are usually sent within 5–15 minutes.</p></details><details class="group border border-slate-200 rounded-2xl p-5 shadow-card"><summary class="cursor-pointer list-none font-black flex justify-between gap-4">Is the card safe?<span class="group-open:rotate-45 transition text-2xl leading-none">+</span></summary><p class="text-slate-500 mt-4 leading-7">Your card information is shared only with you. Never share OTP, CVV, or card details with anyone else.</p></details></div></div></section>

  <section id="support" class="py-16 bg-emerald-600 text-white"><div class="max-w-7xl mx-auto px-4 flex flex-col lg:flex-row lg:items-center justify-between gap-8"><div><p class="font-black uppercase tracking-[.18em] text-emerald-100 text-sm">Need help?</p><h2 class="text-3xl font-black mt-2">Our team is here for you.</h2><p class="text-emerald-50 mt-3">Contact us with any questions about your order or card usage.</p></div><div class="flex flex-wrap gap-3"><a href="https://wa.me/{{ $siteSettings->whatsapp_number }}" target="_blank" class="px-5 py-3.5 rounded-xl bg-white text-emerald-700 font-black hover:bg-emerald-50">WhatsApp</a><a href="mailto:{{ $siteSettings->email }}" class="px-5 py-3.5 rounded-xl bg-emerald-700/40 border border-white/20 font-black hover:bg-emerald-700">Email us</a></div></div></section>
</main>
@endsection
