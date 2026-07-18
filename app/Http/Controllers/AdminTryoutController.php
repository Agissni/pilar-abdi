<?php

namespace App\Http\Controllers;

use App\Models\Tryout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminTryoutController extends Controller
{
    public function index()
    {
        $tryouts = Tryout::latest()->get();
        return view('admin.tryout', compact('tryouts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_tryout' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'jumlah_soal' => 'required|integer|min:1',
            'durasi' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:aktif,belum_dimulai,selesai',
        ], [
            'nama_tryout.required' => 'Nama Try Out wajib diisi.',
            'jumlah_soal.required' => 'Jumlah Soal wajib diisi.',
            'durasi.required' => 'Durasi wajib diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_berakhir.required' => 'Tanggal berakhir wajib diisi.',
            'tanggal_berakhir.after_or_equal' => 'Tanggal berakhir tidak boleh mendahului tanggal mulai.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        Tryout::create($data);

        Log::info('Tryout created by admin', ['nama' => $data['nama_tryout']]);

        return redirect('/admin/tryout')->with('success', 'Paket Try Out berhasil ditambahkan.');
    }

    public function show($id)
    {
        $tryout = Tryout::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $tryout
        ]);
    }

    public function update(Request $request, $id)
    {
        $tryout = Tryout::findOrFail($id);

        $data = $request->validate([
            'nama_tryout' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'jumlah_soal' => 'required|integer|min:1',
            'durasi' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:aktif,belum_dimulai,selesai',
        ], [
            'nama_tryout.required' => 'Nama Try Out wajib diisi.',
            'jumlah_soal.required' => 'Jumlah Soal wajib diisi.',
            'durasi.required' => 'Durasi wajib diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_berakhir.required' => 'Tanggal berakhir wajib diisi.',
            'tanggal_berakhir.after_or_equal' => 'Tanggal berakhir tidak boleh mendahului tanggal mulai.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        $tryout->update($data);

        Log::info('Tryout updated by admin', ['id' => $id, 'nama' => $data['nama_tryout']]);

        return redirect('/admin/tryout')->with('success', 'Paket Try Out berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tryout = Tryout::findOrFail($id);
        $tryout->delete();

        Log::info('Tryout deleted by admin', ['id' => $id]);

        return redirect('/admin/tryout')->with('success', 'Paket Try Out berhasil dihapus.');
    }
}
