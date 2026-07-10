<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    public function show(Request $request)
    {
        $userId = session('user_id') ?? $request->query('id_user');

        $user = $userId
            ? User::with('payments')->find($userId)
            : null;

        $payment = $user
            ? $user->payments()->latest()->first()
            : null;

        return view('public.pembayaran', [
            'user' => $user,
            'payment' => $payment
        ]);
    }

    public function upload(Request $request)
    {
        Log::info('Payment upload attempt', [
            'input' => $request->except('proof'),
            'hasFile' => $request->hasFile('proof')
        ]);

        try {

            $data = $request->validate([
               'id_user' => 'required|exists:users,id_user',
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
                'errors' => $e->validator->errors()->all()
            ]);

            return back()
                ->withErrors($e->validator)
                ->withInput();
        }

        try {

            $path = $request->file('proof')->store('payments', 'public');

            Log::info('Payment proof stored', [
            'path' => $path,
            'id_user' => $data['id_user']
            ]);

            $payment = Payment::create([
                'id_user' => $data['id_user'],
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

            Log::info('Payment created', [
                'payment_id' => $payment->id_pembayaran,
                'id_user' => $payment->id_user,
            ]);

            return redirect('/pembayaran/berhasil?payment_id=' . $payment->id_pembayaran)
                ->with('success', 'Bukti pembayaran berhasil dikirim.');

        } catch (\Exception $e) {

            Log::error('Payment upload failed', [
                'message' => $e->getMessage()
            ]);

            return back()
                ->withErrors([
                    'error' => $e->getMessage()
                ])
                ->withInput();
        }
    }

    public function success(Request $request)
    {
        $payment = Payment::with('user')->find($request->payment_id);

        if (!$payment) {
            return redirect('/pembayaran')
                ->withErrors([
                    'payment' => 'Data pembayaran tidak ditemukan.'
                ]);
        }

        return view('public.pembayaran_berhasil', [
            'payment' => $payment,
            'user' => $payment->user,
        ]);
    }

    public function indexAdmin(Request $request)
    {
        $status = $request->query('status', 'pending');

        $query = Payment::with('user')->latest();

        if ($status !== 'all' && in_array($status, ['pending', 'lunas', 'ditolak'])) {
            $query->where('status', $status);
        }

        $payments = $query->get();
        $admin = User::find(session('user_id'));

        return view('admin.pembayaran', compact('payments', 'admin', 'status'));
    }

    public function verify(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        if ($request->action == 'accept') {

            $payment->status = 'lunas';
            $payment->save();

            $user = $payment->user;
            $user->status = 'active';
            $user->save();

            return back()->with('success', 'Pembayaran berhasil diverifikasi. Status akun siswa menjadi aktif.');

        } elseif ($request->action == 'reject') {

            $payment->status = 'ditolak';
            $payment->save();

            return back()->with('success', 'Pembayaran ditolak. Siswa dapat mengunggah bukti pembayaran ulang.');
        }

        return back()->with('error', 'Aksi verifikasi tidak valid.');
    }
}