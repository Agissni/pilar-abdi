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

        $sekdinKey = strtolower($user->sekdin);
        $sekdins = config('sekdins');
        
        $sekdinInfo = null;
        if (isset($sekdins[$sekdinKey])) {
            $sekdinInfo = $sekdins[$sekdinKey];
        } else {
            // fallback: search by name
            foreach ($sekdins as $key => $info) {
                if (strtolower($info['name']) === $sekdinKey) {
                    $sekdinInfo = $info;
                    break;
                }
            }
        }
        
        if (!$sekdinInfo) {
            $sekdinInfo = $sekdins['lainnya'];
        }

        // Fetch active announcements from database (max 3, newest first)
        $announcements = \App\Models\Pengumuman::where('status', 'aktif')
            ->orderBy('tanggal_publikasi', 'desc')
            ->take(3)
            ->get();

        return view('siswa.dashboard', [
            'user' => $user,
            'sekdin' => $sekdinInfo,
            'announcements' => $announcements
        ]);
    }
}
