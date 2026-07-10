<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show()
    {
        return view('public.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // 1. Cek di tabel users (Siswa / Admin)
        $user = User::where('email', $data['email'])->first();

        if ($user) {
            if (!Hash::check($data['password'], $user->password)) {
                return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
            }

            if ($user->role === 'siswa') {
                if ($user->status === 'pending') {
                    return back()->withErrors(['account' => 'Akun Anda masih menunggu verifikasi admin.'])->withInput();
                }

                if ($user->status !== 'active') {
                    return back()->withErrors(['account' => 'Status akun tidak valid. Silakan hubungi admin.'])->withInput();
                }
            }

            // Simpan user_id ke session
            session([
                'user_id'   => $user->id_user,
                'user_role' => $user->role
            ]);

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect('/dashboard');
        }

        // 2. Cek di tabel gurus (Guru)
        $guru = \App\Models\Guru::where('email', $data['email'])->first();

        if ($guru && $guru->password) {
            if (!Hash::check($data['password'], $guru->password)) {
                return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
            }

            // Simpan guru_id ke session
            session([
                'guru_id'   => $guru->id_guru,
                'user_role' => 'guru'
            ]);

            return redirect('/guru/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['user_id', 'guru_id', 'user_role']);
        return redirect('/login');
    }
}
