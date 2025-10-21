<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRedirect
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'Você precisa fazer login primeiro.');
        }

        return $next($request);
    }
}
