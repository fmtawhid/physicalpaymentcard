<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckMerchant
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->role === 'merchant') {
            return $next($request);
        }

        Auth::logout();
        return redirect('/login')->with('error', 'You do not have access to this page.');
    }
}
