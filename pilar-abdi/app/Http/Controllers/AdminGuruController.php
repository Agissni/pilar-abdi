<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class AdminGuruController extends Controller
{
    private function getAdmin(Request $request)
    {
        return User::find($request->session()->get('user_id'));
    }

    // ───── LIST ─────
    public function index(Request $request)
    {
        $admin = $this->getAdmin($request);
        $gurus = Guru::withCount('kelas')->latest()->get();
        return view('admin.guru', compact('admin', 'gurus'));
    }

    // ───── STORE ─────
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'         => 'required|string|max:100',
            'spesialisasi' => 'required|string|max:50',
            'whatsapp'     => 'nullable|string|max:20',
            'email'        => 'required|email|max:100|unique:gurus,email',
            'password'     => 'required|string|min:6',
            'bio'          => 'nullable|string',
        ]);

        $data['password'] = bcrypt($data['password']);

        Guru::create($data);

        return redirect('/admin/guru')->with('success', 'Guru berhasil ditambahkan.');
    }

    // ───── UPDATE ─────
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $data = $request->validate([
            'nama'         => 'required|string|max:100',
            'spesialisasi' => 'required|string|max:50',
            'whatsapp'     => 'nullable|string|max:20',
            'email'        => 'required|email|max:100|unique:gurus,email,' . $id,
            'password'     => 'nullable|string|min:6',
            'bio'          => 'nullable|string',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $guru->update($data);

        return redirect('/admin/guru')->with('success', 'Data guru berhasil diperbarui.');
    }

    // ───── DESTROY ─────
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect('/admin/guru')->with('success', 'Guru berhasil dihapus.');
    }
}
