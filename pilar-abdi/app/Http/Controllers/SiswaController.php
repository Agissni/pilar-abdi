<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function dashboard(Request $request)
    {
        $userId = $request->session()->get('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $user = User::find($userId);
        if (!$user) {
            $request->session()->forget('user_id');
            return redirect('/login');
        }

        if ($user->status === 'pending') {
            $request->session()->forget('user_id');
            return redirect('/login')->withErrors(['account' => 'Akun Anda masih menunggu verifikasi admin.']);
        }

        if ($user->status !== 'active') {
            $request->session()->forget('user_id');
            return redirect('/login')->withErrors(['account' => 'Status akun tidak valid. Silakan hubungi admin.']);
        }

        return view('siswa.dashboard', ['user' => $user]);
    }
}
