<?php
 
namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
 
class ForgotPasswordController extends Controller
{
    public function show()
    {
        return view('public.forgot-password');
    }
 
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);
 
        $email = $request->email;
 
        // 1. Cek di tabel users (Siswa / Admin)
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
 
            Log::info("Password reset successfully for user: {$email}");
 
            return redirect('/login')->with('success', 'Password berhasil diubah. Silakan login menggunakan password baru Anda.');
        }
 
        // 2. Cek di tabel gurus (Guru)
        $guru = Guru::where('email', $email)->first();
        if ($guru) {
            $guru->password = Hash::make($request->password);
            $guru->save();
 
            Log::info("Password reset successfully for guru: {$email}");
 
            return redirect('/login')->with('success', 'Password berhasil diubah. Silakan login menggunakan password baru Anda.');
        }
 
        // Jika tidak ditemukan di kedua tabel
        return back()->withErrors(['email' => 'Alamat email tidak terdaftar di sistem.'])->withInput();
    }
}
