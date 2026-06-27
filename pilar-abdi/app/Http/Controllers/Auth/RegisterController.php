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
        Log::info('Register request received', ['input' => $request->except(['password','password_confirmation'])]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'whatsapp' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'package' => 'required|string',
            'sekdin' => 'required|string',
            'address' => 'required|string',
        ]);

        // keep raw password in session for one-time display only
        $rawPassword = $data['password'];

        // store hashed password in database
        Log::info('Register validation succeeded', ['input' => $request->except(['password','password_confirmation'])]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'whatsapp' => $data['whatsapp'],
            'password' => Hash::make($rawPassword),
            'status' => 'pending',
            'package' => $data['package'],
            'sekdin' => $data['sekdin'],
            'address' => $data['address'],
        ]);

        if ($user && $user->id) {
            Log::info('User record created', ['user_id' => $user->id, 'email' => $user->email]);
        } else {
            Log::error('User::create returned falsy value', ['input' => $request->except(['password','password_confirmation'])]);
        }

        session(['user_id' => $user->id]);

        Log::info('Register redirecting to pendaftaran', ['user_id' => $user->id]);

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
