<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function dashboard(Request $request)
    {
        $guruId = $request->session()->get('guru_id');
        $guru = Guru::findOrFail($guruId);

        // Ambil data kelas-kelas yang diajar oleh guru ini
        $kelas = Kelas::where('id_guru', $guruId)->latest()->get();

        // Ambil pengumuman aktif untuk guru (maksimal 3, terbaru dahulu)
        $announcements = \App\Models\Pengumuman::where('status', 'aktif')
            ->whereIn('target_role', ['semua', 'guru'])
            ->orderBy('tanggal_publikasi', 'desc')
            ->take(3)
            ->get();

        return view('guru.dashboard', compact('guru', 'kelas', 'announcements'));
    }

    public function updateKelas(Request $request, $id)
    {
        $guruId = $request->session()->get('guru_id');
        $kelas = Kelas::where('id_guru', $guruId)->findOrFail($id);

        $data = $request->validate([
            'hari'       => 'required|string|max:20',
            'jam'        => 'required|string|max:20',
            'gmeet_link' => 'nullable|url|max:255',
            'link_rekaman' => 'nullable|url|max:255',
            'materi_pdf' => 'nullable|file|mimes:pdf|max:10240', // Maksimal ukuran file 10MB
        ]);

        $updateData = [
            'hari'       => $data['hari'],
            'jam'        => $data['jam'],
            'gmeet_link' => $data['gmeet_link'],
            'link_rekaman' => $data['link_rekaman'],
        ];

        if ($request->hasFile('materi_pdf')) {
            $file = $request->file('materi_pdf');
            $originalName = $file->getClientOriginalName();
            $path = $file->store('materi', 'public');
            
            $updateData['materi_pdf_path'] = $path;
            $updateData['materi_pdf_name'] = $originalName;
        }

        $kelas->update($updateData);

        return redirect('/guru/dashboard')->with('success', 'Jadwal dan materi kelas ' . $kelas->nama_kelas . ' berhasil diperbarui.');
    }

    public function siswa(Request $request)
    {
        $guruId = $request->session()->get('guru_id');
        $guru = Guru::findOrFail($guruId);

        $keyword = $request->query('q');
        $siswaQuery = \App\Models\User::where('role', 'siswa')->where('status', 'active');
        
        if ($keyword) {
            $siswaQuery->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%")
                  ->orWhere('email', 'like', "%$keyword%")
                  ->orWhere('sekdin', 'like', "%$keyword%");
            });
        }
        
        $siswa = $siswaQuery->latest()->paginate(15);

        return view('guru.siswa', compact('guru', 'siswa', 'keyword'));
    }

    public function konsultasi(Request $request)
    {
        $guruId = $request->session()->get('guru_id');
        $guru = Guru::findOrFail($guruId);

        // Ambil riwayat bimbingan privat yang ditujukan ke guru ini
        $bimbingan = \App\Models\BimbinganPrivat::with('siswa')
            ->where('id_guru', $guruId)
            ->orderBy('tgl_konsultasi', 'desc')
            ->orderBy('jam_konsultasi', 'desc')
            ->get();

        return view('guru.konsultasi', compact('guru', 'bimbingan'));
    }

    public function approveKonsultasi(Request $request, $id)
    {
        $guruId = $request->session()->get('guru_id');
        $bimbingan = \App\Models\BimbinganPrivat::where('id_guru', $guruId)->findOrFail($id);

        $bimbingan->update([
            'status' => 'disetujui'
        ]);

        return redirect('/guru/konsultasi')->with('success', 'Jadwal bimbingan privat berhasil disetujui.');
    }

    public function rejectKonsultasi(Request $request, $id)
    {
        $guruId = $request->session()->get('guru_id');
        $bimbingan = \App\Models\BimbinganPrivat::where('id_guru', $guruId)->findOrFail($id);

        $bimbingan->update([
            'status' => 'dibatalkan'
        ]);

        return redirect('/guru/konsultasi')->with('success', 'Jadwal bimbingan privat berhasil ditolak/dibatalkan.');
    }
}
