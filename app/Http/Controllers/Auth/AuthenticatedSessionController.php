<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;

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
        return redirect()->route('merchant.index');
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
        return view('profile.edit', compact('user'));
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // password optional
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}
