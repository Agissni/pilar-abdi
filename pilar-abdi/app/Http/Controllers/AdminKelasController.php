<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class AdminKelasController extends Controller
{
    private function getAdmin(Request $request)
    {
        return User::find($request->session()->get('user_id'));
    }

    // ───── LIST ─────
    public function index(Request $request)
    {
        $admin = $this->getAdmin($request);
        $kelas = Kelas::with('guru')->latest()->get();
        $gurus = Guru::orderBy('nama')->get();
        return view('admin.kelas', compact('admin', 'kelas', 'gurus'));
    }

    // ───── STORE ─────
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kelas'  => 'required|string|max:100',
            'materi'      => 'required|string|max:50',
            'id_guru'     => 'nullable|exists:guru,id_guru',
            'hari'        => 'nullable|string|max:20',
            'jam'         => 'nullable|string|max:20',
            'deskripsi'   => 'nullable|string',
        ]);

        Kelas::create($data);

        return redirect('/admin/kelas')->with('success', 'Kelas berhasil ditambahkan.');
    }

    // ───── UPDATE ─────
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $data = $request->validate([
            'nama_kelas'  => 'required|string|max:100',
            'materi'      => 'required|string|max:50',
            'id_guru'     => 'nullable|exists:guru,id_guru',
            'hari'        => 'nullable|string|max:20',
            'jam'         => 'nullable|string|max:20',
            'deskripsi'   => 'nullable|string',
        ]);

        $kelas->update($data);

        return redirect('/admin/kelas')->with('success', 'Data kelas berhasil diperbarui.');
    }

    // ───── DESTROY ─────
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect('/admin/kelas')->with('success', 'Kelas berhasil dihapus.');
    }
}
