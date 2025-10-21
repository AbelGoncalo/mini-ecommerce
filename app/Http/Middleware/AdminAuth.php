<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Se não estiver logado
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'Você precisa fazer login primeiro.');
        }

        // Opcional: verificar se é administrador
        if (Auth::user()->role !== 'administrador') {
            return redirect()->route('auth.login')->with('error', 'Acesso negado!');
        }

        return $next($request);
    }
}
