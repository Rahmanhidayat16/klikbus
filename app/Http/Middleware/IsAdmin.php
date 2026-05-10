<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah yang mau masuk ini udah login DAN role-nya 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Silakan masuk, Bos!
        }

        // 2. Kalau dia user biasa (misal Ledi), tendang balik ke halaman dashboard!
        return redirect('/dashboard')->with('error', 'Hayo mau ngapain? Kamu bukan Admin!');
    }
}