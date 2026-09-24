<x-guest-layout>
    <h2>Create your account</h2>
    <p class="intro">Complete your profile once and your virtual card orders stay ready.</p>

    @if ($errors->any())
        <div class="error-list"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form class="auth-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <div class="field-grid">
            <div class="field"><label for="name">Full name *</label><input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"></div>
            <div class="field"><label for="email">Email address *</label><input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"></div>
            <div class="field"><label for="phone">Phone number *</label><input id="phone" type="text" name="phone" value="{{ old('phone') }}" required autocomplete="tel"></div>
            <div class="field"><label for="nid_number">NID number *</label><input id="nid_number" type="text" name="nid_number" value="{{ old('nid_number') }}" required></div>
            <div class="field"><label for="country">Country *</label><select id="country" name="country" required><option value="">Select country</option>@foreach(config('locations.countries') as $country)<option value="{{ $country }}" {{ old('country') === $country ? 'selected' : '' }}>{{ $country }}</option>@endforeach</select></div>
            <div class="field"><label for="district">District *</label><select id="district" name="district" required><option value="">Select district</option>@foreach(config('locations.districts') as $district)<option value="{{ $district }}" {{ old('district') === $district ? 'selected' : '' }}>{{ $district }}</option>@endforeach</select></div>
        </div>
        <div class="field"><label for="delivery_address">Delivery address *</label><textarea id="delivery_address" name="delivery_address" rows="3" required>{{ old('delivery_address') }}</textarea></div>
        <div class="field-grid">
            <div class="field file-field"><label for="nid_front">NID front image *</label><input id="nid_front" type="file" name="nid_front" accept="image/jpeg,image/png,image/webp" required><small>JPG, PNG or WEBP, max 4MB.</small></div>
            <div class="field file-field"><label for="nid_back">NID back image *</label><input id="nid_back" type="file" name="nid_back" accept="image/jpeg,image/png,image/webp" required><small>JPG, PNG or WEBP, max 4MB.</small></div>
            <div class="field"><label for="password">Password *</label><input id="password" type="password" name="password" required autocomplete="new-password"></div>
            <div class="field"><label for="password_confirmation">Confirm password *</label><input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"></div>
        </div>
        <button class="auth-submit" type="submit">Create payoneercard account</button>
    </form>
    <div class="auth-footer"><span>Already registered?</span><a href="{{ route('login') }}">Sign in to your account</a></div>
</x-guest-layout>
