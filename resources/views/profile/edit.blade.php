@extends('layouts.master')

@section('content')
<div class="max-w-lg mx-auto mt-10">
@extends('layouts.master')

@section('content')
<main class="min-h-screen bg-slate-950 py-12">
    <div class="mx-auto grid max-w-6xl gap-8 px-4 lg:grid-cols-[.8fr_1.2fr] lg:items-start">
        <section class="relative overflow-hidden rounded-[2rem] bg-[#21130f] p-7 text-white shadow-2xl sm:p-9">
            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full border-[26px] border-orange-400/20"></div>
            <div class="absolute -bottom-20 -left-16 h-48 w-48 rounded-full bg-orange-500/20 blur-3xl"></div>
            <div class="relative">
                <p class="text-xs font-black uppercase tracking-[.22em] text-orange-200">Profile verification</p>
                <h1 class="mt-3 text-3xl font-black leading-tight">আপনার তথ্য সম্পূর্ণ করুন</h1>
                <p class="mt-3 text-sm leading-6 text-orange-100/70">সঠিক পরিচয় ও delivery তথ্য থাকলে আপনার virtual card order দ্রুত যাচাই করা যাবে।</p>
                <div class="mt-12 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-300 p-5 text-slate-950 shadow-xl">
                    <div class="flex items-start justify-between"><span class="text-2xl font-black tracking-[-.08em]">dollarX</span><span class="grid h-10 w-10 place-items-center rounded-full bg-white/30 text-xl font-black">$</span></div>
                    <div class="mt-10 h-9 w-12 rounded-lg bg-gradient-to-br from-yellow-100 to-orange-200"></div>
                    <p class="mt-7 font-mono text-lg tracking-[.2em]">•••• 4821</p>
                    <div class="mt-5 flex justify-between text-[10px] font-bold uppercase tracking-widest text-slate-900/60"><span>Virtual Card</span><span>Secure</span></div>
                </div>
                <div class="mt-6 grid grid-cols-3 gap-2 text-center text-[10px] font-bold uppercase tracking-wider text-orange-100/70"><span class="rounded-xl border border-white/10 px-2 py-3">Identity</span><span class="rounded-xl border border-white/10 px-2 py-3">Delivery</span><span class="rounded-xl border border-white/10 px-2 py-3">Security</span></div>
            </div>
        </section>

        <section class="rounded-[2rem] bg-white p-6 shadow-2xl sm:p-9">
            @if(session('success'))<div class="mb-6 rounded-2xl bg-emerald-50 p-4 text-sm font-semibold text-emerald-700">{{ session('success') }}</div>@endif
            @if ($errors->any())<div class="mb-6 rounded-2xl bg-red-50 p-4 text-sm text-red-700"><ul class="list-disc space-y-1 pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <div class="mb-7"><p class="text-xs font-black uppercase tracking-[.2em] text-emerald-600">Account setup</p><h2 class="mt-2 text-3xl font-black text-slate-950">Profile details</h2><p class="mt-2 text-sm leading-6 text-slate-500">এই তথ্যগুলো আপনার order ও verification-এর জন্য ব্যবহার করা হবে।</p></div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div class="grid gap-5 sm:grid-cols-2">
                    <div><label class="block text-sm font-bold text-slate-700">Name *</label><input type="text" name="name" value="{{ old('name', $user->name) }}" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100"></div>
                    <div><label class="block text-sm font-bold text-slate-700">Email *</label><input type="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100"></div>
                    <div><label class="block text-sm font-bold text-slate-700">Phone *</label><input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100"></div>
                    <div><label class="block text-sm font-bold text-slate-700">NID Number *</label><input type="text" name="nid_number" value="{{ old('nid_number', $merchant->nid_number) }}" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100"></div>
                    <div><label class="block text-sm font-bold text-slate-700">Country *</label><select name="country" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100"><option value="">Select country</option>@foreach(config('locations.countries') as $country)<option value="{{ $country }}" {{ old('country', $user->country) === $country ? 'selected' : '' }}>{{ $country }}</option>@endforeach</select></div>
                    <div><label class="block text-sm font-bold text-slate-700">District *</label><select name="district" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100"><option value="">Select district</option>@foreach(config('locations.districts') as $district)<option value="{{ $district }}" {{ old('district', $user->district) === $district ? 'selected' : '' }}>{{ $district }}</option>@endforeach</select></div>
                </div>
                <div><label class="block text-sm font-bold text-slate-700">Delivery Address *</label><textarea name="delivery_address" rows="3" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100">{{ old('delivery_address', $user->delivery_address) }}</textarea></div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div><label class="block text-sm font-bold text-slate-700">NID Front Image *</label><input type="file" name="nid_front" accept="image/jpeg,image/png,image/webp" {{ $merchant->nid_front ? '' : 'required' }} class="mt-2 w-full rounded-xl border border-slate-200 px-3 py-3 text-sm"><p class="mt-1 text-xs text-slate-500">JPG, PNG বা WEBP, সর্বোচ্চ ৪MB</p>@if($merchant->nid_front)<img src="{{ asset('uploads/merchants/'.$merchant->nid_front) }}" alt="NID front" class="mt-3 h-24 w-full rounded-xl object-cover">@endif</div>
                    <div><label class="block text-sm font-bold text-slate-700">NID Back Image *</label><input type="file" name="nid_back" accept="image/jpeg,image/png,image/webp" {{ $merchant->nid_back ? '' : 'required' }} class="mt-2 w-full rounded-xl border border-slate-200 px-3 py-3 text-sm"><p class="mt-1 text-xs text-slate-500">JPG, PNG বা WEBP, সর্বোচ্চ ৪MB</p>@if($merchant->nid_back)<img src="{{ asset('uploads/merchants/'.$merchant->nid_back) }}" alt="NID back" class="mt-3 h-24 w-full rounded-xl object-cover">@endif</div>
                </div>
                <div class="border-t border-slate-100 pt-5"><p class="mb-3 text-sm font-bold text-slate-700">Change Password <span class="font-normal text-slate-400">(optional)</span></p><div class="grid gap-5 sm:grid-cols-2"><input type="password" name="password" placeholder="New password" class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100"><input type="password" name="password_confirmation" placeholder="Confirm password" class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100"></div></div>
                <button type="submit" class="w-full rounded-xl bg-slate-950 px-5 py-4 font-black text-white shadow-xl transition hover:bg-orange-600">Save profile and verification details</button>
            </form>
        </section>
    </div>
</main>
@endsection

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border px-3 py-2 rounded">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border px-3 py-2 rounded">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border px-3 py-2 rounded">
            @error('phone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Country</label>
            <select name="country" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select country</option>
                @foreach(config('locations.countries') as $country)
                    <option value="{{ $country }}" {{ old('country', $user->country) === $country ? 'selected' : '' }}>{{ $country }}</option>
                @endforeach
            </select>
            @error('country') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">District</label>
            <select name="district" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select district</option>
                @foreach(config('locations.districts') as $district)
                    <option value="{{ $district }}" {{ old('district', $user->district) === $district ? 'selected' : '' }}>{{ $district }}</option>
                @endforeach
            </select>
            @error('district') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Delivery Address</label>
            <textarea name="delivery_address" rows="3" class="w-full border px-3 py-2 rounded" required>{{ old('delivery_address', $user->delivery_address) }}</textarea>
            @error('delivery_address') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Password (Leave blank to keep current)</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Profile</button>
    </form>
</div>
@endsection
