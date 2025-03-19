<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotPelanggan
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('pelanggan')->check()) {
            return redirect()->route('pelanggan.login'); // Redirect ke login jika bukan pelanggan
        }

        return $next($request);
    }
}
