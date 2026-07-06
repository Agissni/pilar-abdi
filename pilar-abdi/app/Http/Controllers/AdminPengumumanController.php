<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminPengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest('tanggal_publikasi')->get();
        return view('admin.pengumuman', compact('pengumuman'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:200',
            'isi' => 'required|string',
            'tanggal_publikasi' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'judul.required' => 'Judul pengumuman wajib diisi.',
            'isi.required' => 'Isi pengumuman wajib diisi.',
            'tanggal_publikasi.required' => 'Tanggal publikasi wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        Pengumuman::create($data);

        Log::info('Announcement created by admin', ['judul' => $data['judul']]);

        return redirect('/admin/pengumuman')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function show($id)
    {
        $item = Pengumuman::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = Pengumuman::findOrFail($id);

        $data = $request->validate([
            'judul' => 'required|string|max:200',
            'isi' => 'required|string',
            'tanggal_publikasi' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'judul.required' => 'Judul pengumuman wajib diisi.',
            'isi.required' => 'Isi pengumuman wajib diisi.',
            'tanggal_publikasi.required' => 'Tanggal publikasi wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        $item->update($data);

        Log::info('Announcement updated by admin', ['id' => $id, 'judul' => $data['judul']]);

        return redirect('/admin/pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = Pengumuman::findOrFail($id);
        $item->delete();

        Log::info('Announcement deleted by admin', ['id' => $id]);

        return redirect('/admin/pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
