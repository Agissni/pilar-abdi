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
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();
        if ($user && Hash::check($data['password'], $user->password)) {
            if ($user->status === 'pending') {
                return back()->withErrors(['account' => 'Akun Anda masih menunggu verifikasi admin.'])->withInput();
            }

            if ($user->status === 'active') {
                session(['user_id' => $user->id_user]);
                return redirect('/dashboard');
            }

            return back()->withErrors(['account' => 'Status akun tidak valid. Silakan hubungi admin.'])->withInput();
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        return redirect('/login');
    }
}
