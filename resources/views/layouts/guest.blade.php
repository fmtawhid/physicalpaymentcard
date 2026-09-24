<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DollarXcard') }}</title>
    <style>
        :root { --ink: #17100d; --muted: #756a66; --orange: #f26b2b; --gold: #ffc875; --line: #eadfda; --paper: #fff; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: #f5f7fb; color: var(--ink); font-family: Inter, ui-sans-serif, system-ui, sans-serif; }
        a { color: inherit; }
        .auth-shell { display: grid; min-height: 100vh; grid-template-columns: minmax(320px, .9fr) minmax(420px, 1.1fr); }
        .auth-art { position: relative; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden; padding: 56px; background: #21130f; color: #fff; }
        .auth-art::before, .auth-art::after { position: absolute; content: ''; border-radius: 50%; pointer-events: none; }
        .auth-art::before { width: 300px; height: 300px; top: -120px; right: -100px; border: 44px solid rgba(255, 182, 74, .18); }
        .auth-art::after { width: 300px; height: 300px; bottom: -140px; left: -90px; background: rgba(242, 107, 43, .2); filter: blur(48px); }
        .auth-brand, .auth-copy, .auth-card { position: relative; z-index: 1; }
        .auth-brand { display: inline-flex; align-items: center; gap: 12px; text-decoration: none; font-size: 20px; font-weight: 850; }
        .auth-brand small { display: block; margin-top: 3px; color: rgba(255,255,255,.56); font-size: 10px; font-weight: 700; letter-spacing: .18em; text-transform: uppercase; }
        .brand-mark { display: grid; width: 44px; height: 44px; place-items: center; overflow: hidden; border-radius: 14px; background: var(--orange); color: var(--ink); font-size: 22px; font-weight: 900; box-shadow: 0 12px 30px rgba(242, 107, 43, .25); }
        .brand-mark img { width: 100%; height: 100%; object-fit: cover; }
        .auth-copy { max-width: 470px; margin-top: auto; margin-bottom: auto; }
        .auth-copy h1 { margin: 90px 0 18px; font-size: clamp(38px, 4vw, 66px); line-height: .98; letter-spacing: -.05em; }
        .auth-copy p { max-width: 390px; margin: 0; color: rgba(255, 232, 218, .7); line-height: 1.7; }
        .auth-card { width: min(100%, 430px); margin-top: 36px; padding: 25px; border-radius: 26px; color: var(--ink); background: linear-gradient(135deg, #f26b2b, #ffd27e); box-shadow: 0 28px 60px rgba(0, 0, 0, .25); }
        .card-top, .card-bottom { display: flex; align-items: center; justify-content: space-between; }
        .card-name { font-size: 26px; font-weight: 900; letter-spacing: -.08em; }
        .card-dollar { display: grid; width: 42px; height: 42px; place-items: center; border-radius: 50%; background: rgba(255,255,255,.3); font-size: 23px; font-weight: 900; }
        .card-chip { width: 54px; height: 40px; margin-top: 55px; border-radius: 9px; background: linear-gradient(135deg, #fff1ba, #f4a261); }
        .card-number { margin: 26px 0 22px; font-family: ui-monospace, monospace; font-size: 20px; letter-spacing: .2em; }
        .card-bottom { color: rgba(23, 16, 13, .62); font-size: 10px; font-weight: 800; letter-spacing: .13em; text-transform: uppercase; }
        .auth-panel { display: flex; align-items: center; justify-content: center; padding: 32px; }
        .auth-box { width: min(100%, 660px); padding: 42px; border-radius: 30px; background: var(--paper); box-shadow: 0 24px 70px rgba(34, 22, 18, .1); }
        .auth-box h2 { margin: 0; font-size: 34px; letter-spacing: -.04em; }
        .auth-box .intro { margin: 9px 0 30px; color: var(--muted); line-height: 1.6; }
        .auth-form { display: grid; gap: 18px; }
        .field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .field { display: grid; gap: 8px; }
        .field label { color: #3d302b; font-size: 13px; font-weight: 800; }
        .field input, .field select, .field textarea { width: 100%; border: 1px solid var(--line); border-radius: 12px; padding: 13px 14px; color: var(--ink); background: #fff; font: inherit; outline: none; transition: border-color .2s, box-shadow .2s; }
        .field input:focus, .field select:focus, .field textarea:focus { border-color: var(--orange); box-shadow: 0 0 0 4px rgba(242, 107, 43, .12); }
        .field small { color: var(--muted); font-size: 11px; }
        .file-field input { padding: 10px; }
        .error-list { margin-bottom: 20px; padding: 13px 16px; border-radius: 12px; color: #a32828; background: #fff0f0; font-size: 13px; }
        .error-list ul { margin: 0; padding-left: 18px; }
        .auth-submit { width: 100%; border: 0; border-radius: 13px; padding: 15px 20px; color: #fff; background: var(--ink); cursor: pointer; font: inherit; font-weight: 850; transition: background .2s, transform .2s; }
        .auth-submit:hover { background: var(--orange); transform: translateY(-1px); }
        .auth-footer { display: flex; align-items: center; justify-content: space-between; gap: 14px; margin-top: 22px; color: var(--muted); font-size: 13px; }
        .auth-footer a { color: var(--ink); font-weight: 800; text-decoration: none; }
        .auth-footer a:hover { color: var(--orange); }
        .remember { display: flex; align-items: center; gap: 8px; color: var(--muted); font-size: 13px; }
        .session-status { margin-bottom: 18px; color: #08744b; font-size: 13px; }
        .auth-mobile-brand { display: none; align-items: center; gap: 10px; margin-bottom: 26px; text-decoration: none; font-size: 17px; font-weight: 850; }
        .auth-mobile-brand small { display: block; margin-top: 2px; color: var(--muted); font-size: 9px; letter-spacing: .15em; text-transform: uppercase; }
        @media (max-width: 900px) { .auth-shell { display: block; } .auth-art { min-height: 270px; padding: 28px; } .auth-copy h1 { margin: 45px 0 0; font-size: 42px; } .auth-copy p, .auth-card { display: none; } .auth-panel { padding: 22px 14px; } .auth-box { padding: 28px 22px; border-radius: 22px; } .auth-mobile-brand { display: inline-flex; } }
        @media (max-width: 560px) { .field-grid { grid-template-columns: 1fr; gap: 18px; } .auth-box h2 { font-size: 29px; } .auth-footer { align-items: flex-start; flex-direction: column; } }
    </style>
</head>
<body>
    @php($brandName = isset($siteSettings) && $siteSettings->site_name ? $siteSettings->site_name : config('app.name', 'DollarXcard'))
    <main class="auth-shell">
        <aside class="auth-art">
            <a href="{{ route('home') }}" class="auth-brand">
                <span class="brand-mark"><img src="{{ asset('assets/img/logo.jpg') }}" alt="{{ $brandName }}"></span>
                <span><strong>{{ $brandName }}</strong><small>Virtual Mastercard</small></span>
            </a>
            <div class="auth-copy"><h1>Payments with a point of view.</h1><p>One secure account for your virtual card, international payments and a smoother checkout.</p></div>
            <div class="auth-card"><div class="card-top"><span class="card-name">dollarX</span><span class="card-dollar">$</span></div><div class="card-chip"></div><div class="card-number">•••• 4821</div><div class="card-bottom"><span>Virtual Mastercard</span><span>12/30</span></div></div>
        </aside>
        <section class="auth-panel"><div class="auth-box"><a href="{{ route('home') }}" class="auth-mobile-brand"><span class="brand-mark"><img src="{{ asset('assets/img/logo.jpg') }}" alt="{{ $brandName }}"></span><span><strong>{{ $brandName }}</strong><small>Virtual Mastercard</small></span></a>{{ $slot }}</div></section>
    </main>
</body>
</html>
