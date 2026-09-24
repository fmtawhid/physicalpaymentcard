<x-guest-layout>
    <h2>Welcome back</h2>
    <p class="intro">Sign in to manage your virtual cards and track every order.</p>

    @if (session('status'))<div class="session-status">{{ session('status') }}</div>@endif
    @if ($errors->any())
        <div class="error-list"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form class="auth-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field"><label for="email">Email address</label><input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"></div>
        <div class="field"><label for="password">Password</label><input id="password" type="password" name="password" required autocomplete="current-password"></div>
        <label class="remember" for="remember_me"><input id="remember_me" type="checkbox" name="remember"> Remember me</label>
        <button class="auth-submit" type="submit">Sign in securely</button>
    </form>
    <div class="auth-footer"><a href="{{ route('register') }}">Create a new account</a>@if (Route::has('password.request'))<a href="{{ route('password.request') }}">Forgot password?</a>@endif</div>
</x-guest-layout>
