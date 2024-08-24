<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckJabatan
{
    public function handle($request, Closure $next, ...$allowedJabatanIds)
    {
        // Periksa ID jabatan pengguna
        if (Auth::check() && in_array(Auth::user()->id_jabatan, $allowedJabatanIds)) {
            return $next($request);
        }

        // Jika tidak sesuai, redirect atau response error
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
