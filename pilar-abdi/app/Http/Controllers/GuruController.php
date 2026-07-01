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

        // Fetch classes taught by this teacher
        $kelas = Kelas::where('guru_id', $guruId)->latest()->get();

        return view('guru.dashboard', compact('guru', 'kelas'));
    }

    public function updateKelas(Request $request, $id)
    {
        $guruId = $request->session()->get('guru_id');
        $kelas = Kelas::where('guru_id', $guruId)->findOrFail($id);

        $data = $request->validate([
            'hari'       => 'required|string|max:20',
            'jam'        => 'required|string|max:20',
            'gmeet_link' => 'nullable|url|max:255',
            'materi_pdf' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB
        ]);

        $updateData = [
            'hari'       => $data['hari'],
            'jam'        => $data['jam'],
            'gmeet_link' => $data['gmeet_link'],
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
}
