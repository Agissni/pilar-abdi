<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    public function show(Request $request)
    {
        $userId = session('user_id') ?? $request->query('user_id');
        $user = $userId ? User::with('payments')->find($userId) : null;
        $payment = $user ? $user->payments()->latest()->first() : null;
        return view('public.pembayaran', ['user' => $user, 'payment' => $payment]);
    }

    public function upload(Request $request)
    {
        // Log incoming request (without file contents)
        Log::info('Payment upload attempt', ['input' => $request->except('proof') , 'hasFile' => $request->hasFile('proof')]);

        try {
            $data = $request->validate([
                'user_id' => 'required|exists:users,id',
                'package' => 'required|string',
                'bank' => 'required|string',
                'account_name' => 'required|string|max:255',
                'account_number' => 'required|string|max:50',
                'transfer_date' => 'required|date',
                'transfer_time' => 'required',
                'amount' => 'required|numeric|min:1000',
                'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'note' => 'nullable|string|max:1000',
            ]);
        } catch (ValidationException $e) {
            Log::warning('Payment validation failed', [
                'errors' => $e->validator->errors()->all(),
                'input' => $request->except('proof')
            ]);
            return back()->withErrors($e->validator)->withInput();
        }

        // proceed with storing file and creating payment record
        try {
            $file = $request->file('proof');
            $path = $file->store('payments', 'public');
            Log::info('Payment proof stored', ['path' => $path, 'user_id' => $data['user_id']]);

            $payment = Payment::create([
                'user_id' => $data['user_id'],
                'package' => $data['package'],
                'bank' => $data['bank'],
                'account_number' => $data['account_number'],
                'sender_name' => $data['account_name'],
                'transfer_date' => $data['transfer_date'],
                'transfer_time' => $data['transfer_time'],
                'amount' => $data['amount'],
                'note' => $data['note'] ?? null,
                'proof_path' => $path,
                'status' => 'pending',
            ]);

            if ($payment && $payment->id) {
                Log::info('Payment record created', ['payment_id' => $payment->id, 'user_id' => $payment->user_id]);
            } else {
                Log::error('Payment::create returned falsy value', ['input' => $data]);
            }

            // redirect to a dedicated success page with the payment id
            return redirect('/pembayaran/berhasil?payment_id=' . $payment->id)
                ->with('success', 'Bukti pembayaran berhasil dikirim. Silakan tunggu verifikasi admin.');

        } catch (\Exception $ex) {
            Log::error('Exception during payment upload', ['message' => $ex->getMessage(), 'trace' => $ex->getTraceAsString(), 'input' => $request->except('proof')]);
            return back()->withErrors(['exception' => 'Terjadi kesalahan saat menyimpan bukti pembayaran: ' . $ex->getMessage()])->withInput();
        }
    }

    public function success(Request $request)
    {
        $paymentId = $request->query('payment_id');
        $payment = $paymentId ? Payment::with('user')->find($paymentId) : null;
        if (!$payment) {
            return redirect('/pembayaran')->withErrors(['payment' => 'Data pembayaran tidak ditemukan.']);
        }

        return view('public.pembayaran_berhasil', ['payment' => $payment, 'user' => $payment->user]);
    }

    // admin actions
    public function indexAdmin()
    {
        $payments = Payment::with('user')->orderBy('created_at','desc')->get();
        return view('admin.pembayaran', ['payments' => $payments]);
    }

    public function verify(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $action = $request->input('action');
        if ($action === 'accept') {
            $payment->status = 'lunas';
            $payment->save();
            $user = $payment->user;
            $user->status = 'active';
            $user->save();
        } elseif ($action === 'reject') {
            $payment->status = 'ditolak';
            $payment->save();
        }
        return back();
    }
}
