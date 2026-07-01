<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
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
        if (!$user || $user->role !== 'admin') {
            return redirect('/login')->withErrors(['account' => 'Akses ditolak. Hanya admin yang dapat masuk.']);
        }

        return $next($request);
    }
}
