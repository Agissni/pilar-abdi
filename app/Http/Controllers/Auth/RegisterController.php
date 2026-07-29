<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function show()
    {
        return view('public.pendaftaran');
    }

    public function register(Request $request)
    {
        Log::info('Register request received', [
            'input' => $request->except(['password', 'password_confirmation'])
        ]);

        // Validasi input
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'whatsapp' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'package' => 'required|string|max:100',
            'sekdin' => 'required|string|max:100',
            'address' => 'required|string',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'package.required' => 'Pilihan paket wajib dipilih.',
            'sekdin.required' => 'Sekolah kedinasan tujuan wajib dipilih.',
            'address.required' => 'Alamat lengkap wajib diisi.',
        ]);

        // Simpan password asli hanya untuk ditampilkan sekali
        $rawPassword = $data['password'];

        // Simpan user ke database
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'whatsapp' => $data['whatsapp'],
            'password' => Hash::make($rawPassword),
            'status' => 'pending',
            'package' => $data['package'],
            'sekdin' => $data['sekdin'],
            'address' => $data['address'],
            'role' => 'siswa',
        ]);

        Log::info('User created', [
            'user_id' => $user->id_user,
            'email' => $user->email,
        ]);

        // Simpan id user ke session
        session([
            'user_id' => $user->id_user
        ]);

        return redirect('/pendaftaran')
            ->with('success', 'Pendaftaran berhasil. Silakan lanjut ke pembayaran.')
            ->with('registered_data', [
                'name' => $data['name'],
                'email' => $data['email'],
                'password_raw' => $rawPassword,
                'package' => $data['package'],
                'sekdin' => $data['sekdin'],
            ]);
    }
}