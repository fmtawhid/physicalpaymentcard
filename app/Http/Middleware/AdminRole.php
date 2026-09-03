<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            Auth::logout();
            return redirect('/login')->with('error', 'You do not have access to this page.');
        }

        return $next($request);
    }
}
