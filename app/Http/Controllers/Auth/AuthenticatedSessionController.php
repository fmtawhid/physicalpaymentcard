<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Validation\Rule;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     // Validate input
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //     ]);

    //     // Find user by email
    //     $user = User::where('email', $request->email)->first();

    //     // Check if user exists and password is correct
    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return back()->withErrors([
    //             'email' => 'The provided credentials do not match our records.',
    //         ]);
    //     }

    //     // Log in the user
    //     Auth::login($user);

    //     // Regenerate session
    //     $request->session()->regenerate();

    //     // Role-based redirect
    //     if ($user->role === 'admin') {
    //         return redirect()->route('admin.index'); // admin panel route
    //     } elseif ($user->role === 'merchant') {
    //         return redirect()->route('merchant.index'); // merchant panel route
    //     }

    //     // Default fallback
    //     return redirect('/');
    // }
    // AuthenticatedSessionController
public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    Auth::login($user);
    $request->session()->regenerate();

    // Role-based redirect
    if ($user->role === 'admin') {
        return redirect()->route('admin.index');
    } elseif ($user->role === 'merchant') {
        return redirect()->intended(route('merchant.index'));
    }

    Auth::logout();
    return redirect('/login')->with('error', 'Unauthorized access.');
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function editProfile()
    {
        $user = Auth::user();
        $merchant = $user->merchant()->firstOrCreate([], [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?: '',
        ]);

        return view('profile.edit', compact('user', 'merchant'));
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $merchant = $user->merchant()->firstOrCreate([], [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?: '',
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:30',
            'country' => ['required', Rule::in(config('locations.countries'))],
            'district' => ['required', Rule::in(config('locations.districts'))],
            'delivery_address' => 'required|string|max:1000',
            'nid_number' => 'required|string|max:50',
            'nid_front' => [$merchant->nid_front ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'nid_back' => [$merchant->nid_back ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'password' => 'nullable|string|min:8|confirmed', // password optional
        ]);

        $directory = public_path('uploads/merchants');
        File::ensureDirectoryExists($directory);
        $nidFrontName = $merchant->nid_front;
        $nidBackName = $merchant->nid_back;

        foreach (['nid_front' => &$nidFrontName, 'nid_back' => &$nidBackName] as $field => &$fileName) {
            if (!$request->hasFile($field)) {
                continue;
            }

            if ($fileName && File::exists($directory.'/'.$fileName)) {
                File::delete($directory.'/'.$fileName);
            }

            $file = $request->file($field);
            $fileName = $user->id.'_'.$field.'_'.time().'.'.$file->extension();
            $file->move($directory, $fileName);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->district = $request->district;
        $user->delivery_address = $request->delivery_address;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $merchant->update([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'nid_number' => $request->nid_number,
            'nid_front' => $nidFrontName,
            'nid_back' => $nidBackName,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}
