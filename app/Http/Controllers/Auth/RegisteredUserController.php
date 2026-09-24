<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Merchant;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:30'],
            'country' => ['required', Rule::in(config('locations.countries'))],
            'district' => ['required', Rule::in(config('locations.districts'))],
            'delivery_address' => ['required', 'string', 'max:1000'],
            'nid_number' => ['required', 'string', 'max:50'],
            'nid_front' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'nid_back' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $directory = public_path('uploads/merchants');
        File::ensureDirectoryExists($directory);
        $nidFrontName = time().'_'.$request->file('nid_front')->hashName();
        $nidBackName = time().'_'.$request->file('nid_back')->hashName();
        $request->file('nid_front')->move($directory, $nidFrontName);
        $request->file('nid_back')->move($directory, $nidBackName);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'district' => $request->district,
            'delivery_address' => $request->delivery_address,
            'password' => Hash::make($request->password),
            'role' => 'merchant',
        ]);

        Merchant::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->delivery_address,
            'nid_number' => $request->nid_number,
            'nid_front' => $nidFrontName,
            'nid_back' => $nidBackName,
            'status' => 'active',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('merchant.index'))->with('success', 'রেজিস্ট্রেশন সম্পন্ন হয়েছে।');
    }
}
