<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $siteSettings->site_name }} - ভার্চুয়াল Mastercard</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  @stack('scripts')

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif']
          },
          boxShadow: {
            soft: '0 12px 40px rgba(15, 23, 42, 0.08)',
            card: '0 8px 30px rgba(15, 23, 42, 0.06)'
          }
        }
      }
    }
  </script>

  <style>
    html { scroll-behavior: smooth; }
    body { background: #f8fafc; color: #0f172a; }
    .gradient-bg {
      background:
        radial-gradient(circle at 15% 20%, rgba(59,130,246,.16), transparent 32%),
        radial-gradient(circle at 85% 10%, rgba(16,185,129,.12), transparent 30%),
        linear-gradient(135deg, #f8fbff 0%, #ffffff 52%, #f0fdf8 100%);
    }
    .glass {
      background: rgba(255,255,255,.78);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
    }
    .rate-row:hover { background: #f8fafc; }
    .fade-up {
      animation: fadeUp .55s ease both;
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(12px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .pulse-dot { animation: pulseDot 1.8s infinite; }
    @keyframes pulseDot {
      0%, 100% { box-shadow: 0 0 0 0 rgba(16,185,129,.35); }
      50% { box-shadow: 0 0 0 8px rgba(16,185,129,0); }
    }
  </style>
</head>

<body class="font-sans">

  <!-- Announcement -->
  <div class="bg-slate-950 text-white text-sm">
    <div class="max-w-7xl mx-auto px-4 py-2.5 flex flex-col sm:flex-row items-center justify-center gap-2 text-center">
      <span class="inline-flex items-center gap-2">
        <span class="h-2 w-2 rounded-full bg-emerald-400 pulse-dot"></span>
        ভার্চুয়াল কার্ড ডেলিভারি: সাধারণত {{ $siteSettings->order_processing_time ?: '৫–১৫ মিনিট' }}
      </span>
      <span class="hidden sm:inline text-slate-500">•</span>
      <a href="{{ route('home') }}#support" class="text-emerald-300 hover:text-emerald-200">সহায়তা দরকার? যোগাযোগ করুন</a>
    </div>
  </div>

  <!-- Navbar -->
  <header class="sticky top-0 z-50 glass border-b border-slate-200/70">
    <nav class="max-w-7xl mx-auto px-4 h-18 min-h-[72px] flex items-center justify-between">
      <a href="{{ route('home') }}" class="flex items-center gap-3">
        <div class="h-11 w-11 rounded-2xl bg-slate-950 text-white grid place-items-center font-black shadow-lg">
          $
        </div>
        <div>
          <div class="font-black tracking-tight text-lg">{{ $siteSettings->site_name }}</div>
          <div class="text-[11px] uppercase tracking-[.2em] text-slate-500">Virtual Mastercard</div>
        </div>
      </a>

      <div class="hidden lg:flex items-center gap-7 text-sm font-semibold text-slate-600">
        <a href="{{ route('home') }}#home" class="hover:text-slate-950">হোম</a>
        <a href="{{ route('home') }}#features" class="hover:text-slate-950">সুবিধা</a>
        <a href="{{ route('home') }}#order" class="hover:text-slate-950">কার্ড অর্ডার</a>
        <a href="{{ route('home') }}#steps" class="hover:text-slate-950">প্রক্রিয়া</a>
        <a href="{{ route('home') }}#faq" class="hover:text-slate-950">জিজ্ঞাসা</a>
        <a href="{{ route('home') }}#support" class="hover:text-slate-950">যোগাযোগ</a>
      </div>

      <div class="hidden lg:flex items-center gap-2">
        @auth
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.index') }}" class="inline-flex px-4 py-2.5 rounded-xl bg-slate-950 text-white text-sm font-bold hover:bg-slate-800">Dashboard</a>
        @elseif(auth()->user()->role === 'merchant')
        <div class="relative">
          <button type="button" onclick="toggleAccountMenu()" aria-controls="accountMenu" aria-expanded="false" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold hover:bg-slate-50">
            <span class="grid h-7 w-7 place-items-center rounded-full bg-emerald-100 text-emerald-700">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
            <span>{{ auth()->user()->name }}</span><span class="text-slate-400">⌄</span>
          </button>
          <div id="accountMenu" class="absolute right-0 mt-2 hidden w-52 rounded-2xl border border-slate-200 bg-white p-2 shadow-xl">
            <a href="{{ route('merchant.index') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold hover:bg-slate-50">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold hover:bg-slate-50">Profile</a>
            <a href="{{ route('orders.index') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold hover:bg-slate-50">My Orders</a>
            <a href="{{ route('cards.index') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold hover:bg-slate-50">My Card</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-1 border-t border-slate-100 pt-1">@csrf<button type="submit" class="block w-full rounded-xl px-3 py-2.5 text-left text-sm font-semibold text-red-600 hover:bg-red-50">Logout</button></form>
          </div>
        </div>
        @endif
        @else
        <a href="{{ route('login') }}" class="inline-flex px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-bold hover:bg-slate-50">
          লগইন
        </a>
        <a href="{{ route('register') }}" class="inline-flex px-4 py-2.5 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 text-sm font-bold hover:bg-emerald-100">
          রেজিস্টার
        </a>
        @endauth
      </div>

      <button type="button" onclick="toggleMobileMenu()" aria-controls="mobileMenu" aria-expanded="false" class="lg:hidden inline-flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700" aria-label="Open navigation menu">
        <span class="text-2xl leading-none">☰</span>
      </button>
    </nav>

    <div id="mobileMenu" class="hidden border-t border-slate-200/70 bg-white/95 px-4 pb-4 pt-3 shadow-lg lg:hidden">
      <div class="flex flex-col gap-1 text-sm font-semibold text-slate-700">
        <a href="{{ route('home') }}#home" onclick="closeMobileMenu()" class="rounded-xl px-4 py-3 hover:bg-slate-50">হোম</a>
        <a href="{{ route('home') }}#features" onclick="closeMobileMenu()" class="rounded-xl px-4 py-3 hover:bg-slate-50">সুবিধা</a>
        <a href="{{ route('home') }}#order" onclick="closeMobileMenu()" class="rounded-xl px-4 py-3 hover:bg-slate-50">কার্ড অর্ডার</a>
        <a href="{{ route('home') }}#steps" onclick="closeMobileMenu()" class="rounded-xl px-4 py-3 hover:bg-slate-50">প্রক্রিয়া</a>
        <a href="{{ route('home') }}#faq" onclick="closeMobileMenu()" class="rounded-xl px-4 py-3 hover:bg-slate-50">জিজ্ঞাসা</a>
        <a href="{{ route('home') }}#support" onclick="closeMobileMenu()" class="rounded-xl px-4 py-3 hover:bg-slate-50">যোগাযোগ</a>
      </div>
      <div class="mt-3 border-t border-slate-100 pt-3">
        @auth
        @if(auth()->user()->role === 'admin')
          <a href="{{ route('admin.index') }}" onclick="closeMobileMenu()" class="block rounded-xl bg-slate-950 px-4 py-3 text-sm font-bold text-white hover:bg-slate-800">Dashboard</a>
        @elseif(auth()->user()->role === 'merchant')
        <div class="mb-2 rounded-xl bg-slate-50 px-4 py-3 text-sm font-bold text-slate-700">{{ auth()->user()->name }}</div>
        <a href="{{ route('merchant.index') }}" onclick="closeMobileMenu()" class="mb-1 block rounded-xl px-4 py-3 text-sm font-semibold hover:bg-slate-50">Dashboard</a>
        <a href="{{ route('profile.edit') }}" onclick="closeMobileMenu()" class="mb-1 block rounded-xl px-4 py-3 text-sm font-semibold hover:bg-slate-50">Profile</a>
        <a href="{{ route('orders.index') }}" onclick="closeMobileMenu()" class="mb-1 block rounded-xl px-4 py-3 text-sm font-semibold hover:bg-slate-50">My Orders</a>
        <a href="{{ route('cards.index') }}" onclick="closeMobileMenu()" class="mb-1 block rounded-xl px-4 py-3 text-sm font-semibold hover:bg-slate-50">My Card</a>
        @endif
        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="w-full rounded-xl bg-slate-950 px-4 py-3 text-sm font-bold text-white hover:bg-slate-800">Logout</button></form>
        @else
        <a href="{{ route('login') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-center text-sm font-bold text-slate-700 hover:bg-slate-50">লগইন</a>
        <a href="{{ route('register') }}" class="rounded-xl bg-emerald-600 px-4 py-3 text-center text-sm font-bold text-white hover:bg-emerald-700">রেজিস্টার</a>
        @endauth
      </div>
      <a href="#order" onclick="closeMobileMenu()" class="mt-2 block rounded-xl bg-slate-950 px-4 py-3 text-center text-sm font-bold text-white hover:bg-slate-800">কার্ড অর্ডার করুন</a>
    </div>
  </header>
@yield('content')

  
  <!-- Footer -->
  <footer class="bg-slate-950 text-slate-400">
    <div class="max-w-7xl mx-auto px-4 py-12">
      <div class="grid md:grid-cols-4 gap-8">
        <div class="md:col-span-2">
          <div class="text-white font-black text-xl">{{ $siteSettings->site_name }}</div>
          <p class="mt-3 max-w-md leading-7 text-sm">
            {{ $siteSettings->support_text ?: 'অনলাইন পেমেন্টের জন্য দ্রুত ও নিরাপদ ভার্চুয়াল Mastercard পাওয়ার সহজ ঠিকানা।' }}
          </p>
        </div>
        <div>
          <div class="text-white font-bold mb-3">Quick Links</div>
          <div class="space-y-2 text-sm">
            <a href="{{ route('home') }}#order" class="block hover:text-white">কার্ড অর্ডার</a>
            <a href="{{ route('home') }}#steps" class="block hover:text-white">কীভাবে কাজ করে</a>
            <a href="{{ route('home') }}#faq" class="block hover:text-white">সাধারণ প্রশ্ন</a>
          </div>
        </div>
        <div>
          <div class="text-white font-bold mb-3">Legal</div>
          <div class="space-y-2 text-sm">
            <a href="{{ route('legal.privacy') }}" class="block hover:text-white">গোপনীয়তা নীতি</a>
            <a href="{{ route('legal.terms') }}" class="block hover:text-white">সেবার শর্তাবলী</a>
            <a href="{{ route('legal.refund') }}" class="block hover:text-white">রিফান্ড নীতি</a>
          </div>
        </div>
      </div>

      <div class="border-t border-white/10 mt-10 pt-6 flex flex-col sm:flex-row justify-between gap-3 text-xs">
        <span>© ২০২৬ {{ $siteSettings->site_name }}. সর্বস্বত্ব সংরক্ষিত।</span>
        <span>নিরাপদে ব্যবহার করুন • কার্ডের তথ্য গোপন রাখুন</span>
      </div>
    </div>
  </footer>

  <!-- Toast -->
  <div id="toast" class="fixed right-4 bottom-4 z-[100] hidden max-w-sm rounded-2xl bg-slate-950 text-white px-5 py-4 shadow-2xl text-sm"></div>

  <script>
    function showToast(message) {
      const toast = document.getElementById('toast');
      toast.textContent = message;
      toast.classList.remove('hidden');
      clearTimeout(window.toastTimer);
      window.toastTimer = setTimeout(() => toast.classList.add('hidden'), 4000);
    }

    function toggleMobileMenu() {
      const menu = document.getElementById('mobileMenu');
      const button = document.querySelector('[aria-controls="mobileMenu"]');
      const isOpen = !menu.classList.contains('hidden');

      menu.classList.toggle('hidden', isOpen);
      button.setAttribute('aria-expanded', String(!isOpen));
      button.setAttribute('aria-label', isOpen ? 'Open navigation menu' : 'Close navigation menu');
    }

    function closeMobileMenu() {
      const menu = document.getElementById('mobileMenu');
      const button = document.querySelector('[aria-controls="mobileMenu"]');

      menu.classList.add('hidden');
      button.setAttribute('aria-expanded', 'false');
      button.setAttribute('aria-label', 'Open navigation menu');
    }

    function toggleAccountMenu() {
      const menu = document.getElementById('accountMenu');
      const button = document.querySelector('[aria-controls="accountMenu"]');
      const isOpen = !menu.classList.contains('hidden');
      menu.classList.toggle('hidden', isOpen);
      button.setAttribute('aria-expanded', String(!isOpen));
    }

  </script>
</body>
</html>
