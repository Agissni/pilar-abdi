<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Guru;
use Symfony\Component\HttpFoundation\Response;

class GuruMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guruId = $request->session()->get('guru_id');
        $role = $request->session()->get('user_role');

        if (!$guruId || $role !== 'guru') {
            return redirect('/login')->withErrors(['account' => 'Akses ditolak. Silakan login sebagai guru.']);
        }

        $guru = Guru::find($guruId);
        if (!$guru) {
            $request->session()->forget(['guru_id', 'user_role']);
            return redirect('/login')->withErrors(['account' => 'Akun guru tidak ditemukan.']);
        }

        return $next($request);
    }
}
