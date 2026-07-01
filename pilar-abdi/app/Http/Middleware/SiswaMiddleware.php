<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class SiswaMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->session()->get('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $user = User::find($userId);
        if (!$user || $user->role !== 'siswa') {
            return redirect('/login')->withErrors(['account' => 'Akses ditolak. Silakan login sebagai siswa.']);
        }

        if ($user->status === 'pending') {
            $request->session()->forget('user_id');
            return redirect('/login')->withErrors(['account' => 'Akun Anda masih menunggu verifikasi admin.']);
        }

        if ($user->status !== 'active') {
            $request->session()->forget('user_id');
            return redirect('/login')->withErrors(['account' => 'Status akun tidak valid. Silakan hubungi admin.']);
        }

        return $next($request);
    }
}
