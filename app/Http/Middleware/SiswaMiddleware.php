<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiswaMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('siswa')) {
            return redirect('/login-siswa')->with('error', 'Silakan login terlebih dahulu');
        }

        return $next($request);
    }
}
