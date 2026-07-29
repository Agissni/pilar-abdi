<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Tryout;
use App\Models\TryoutQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GuruTryoutController extends Controller
{
    private function getGuru(Request $request)
    {
        $guruId = $request->session()->get('guru_id');
        return Guru::findOrFail($guruId);
    }

    public function index(Request $request)
    {
        $guru = $this->getGuru($request);
        $tryouts = Tryout::latest()->get();
        return view('guru.tryout', compact('guru', 'tryouts'));
    }

    public function soal(Request $request, $tryout_id)
    {
        $guru = $this->getGuru($request);
        $tryout = Tryout::findOrFail($tryout_id);
        
        $specialization = strtoupper($guru->spesialisasi);
        
        if (!in_array($specialization, ['TWK', 'TIU', 'TKP'])) {
            return redirect('/guru/dashboard')->withErrors(['access' => 'Anda tidak memiliki otorisasi untuk mengelola soal Try Out.']);
        }

        $questions = $tryout->questions()
            ->where('kategori', $specialization)
            ->orderBy('nomor_soal', 'asc')
            ->get();

        return view('guru.soal', compact('guru', 'tryout', 'questions', 'specialization'));
    }

    public function storeSoal(Request $request, $tryout_id)
    {
        $guru = $this->getGuru($request);
        $tryout = Tryout::findOrFail($tryout_id);
        $specialization = strtoupper($guru->spesialisasi);

        if (!in_array($specialization, ['TWK', 'TIU', 'TKP'])) {
            return redirect('/guru/dashboard')->withErrors(['access' => 'Akses ditolak.']);
        }

        // Cek batas maksimal jumlah soal
        $totalCount = $tryout->questions()->count();
        if ($totalCount >= $tryout->jumlah_soal) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['limit' => 'Jumlah soal keseluruhan telah mencapai batas maksimal sesuai pengaturan Try Out.']);
        }

        $data = $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'pilihan_e' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D,E',
            'pembahasan' => 'nullable|string',
        ], [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'pilihan_a.required' => 'Pilihan A wajib diisi.',
            'pilihan_b.required' => 'Pilihan B wajib diisi.',
            'pilihan_c.required' => 'Pilihan C wajib diisi.',
            'pilihan_d.required' => 'Pilihan D wajib diisi.',
            'pilihan_e.required' => 'Pilihan E wajib diisi.',
            'jawaban_benar.required' => 'Jawaban benar wajib ditentukan.',
        ]);

        $data['id_tryout'] = $tryout->id_tryout;
        $data['kategori'] = $specialization;
        $data['nomor_soal'] = $totalCount + 1; // Tambahkan ke urutan paling akhir

        TryoutQuestion::create($data);

        Log::info('Guru tryout question created', ['guru_id' => $guru->id_guru, 'tryout_id' => $tryout_id]);

        return redirect("/guru/tryout/{$tryout_id}/soal")->with('success', 'Soal berhasil ditambahkan.');
    }

    public function showSoal(Request $request, $id)
    {
        $guru = $this->getGuru($request);
        $question = TryoutQuestion::findOrFail($id);
        $specialization = strtoupper($guru->spesialisasi);

        if ($question->kategori !== $specialization) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses ditolak.'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => $question
        ]);
    }

    public function updateSoal(Request $request, $id)
    {
        $guru = $this->getGuru($request);
        $question = TryoutQuestion::findOrFail($id);
        $specialization = strtoupper($guru->spesialisasi);

        if ($question->kategori !== $specialization) {
            return redirect('/guru/dashboard')->withErrors(['access' => 'Akses ditolak.']);
        }

        $data = $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'pilihan_e' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D,E',
            'pembahasan' => 'nullable|string',
        ], [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'pilihan_a.required' => 'Pilihan A wajib diisi.',
            'pilihan_b.required' => 'Pilihan B wajib diisi.',
            'pilihan_c.required' => 'Pilihan C wajib diisi.',
            'pilihan_d.required' => 'Pilihan D wajib diisi.',
            'pilihan_e.required' => 'Pilihan E wajib diisi.',
            'jawaban_benar.required' => 'Jawaban benar wajib ditentukan.',
        ]);

        $question->update($data);

        return redirect("/guru/tryout/{$question->id_tryout}/soal")->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroySoal(Request $request, $id)
    {
        $guru = $this->getGuru($request);
        $question = TryoutQuestion::findOrFail($id);
        $specialization = strtoupper($guru->spesialisasi);

        if ($question->kategori !== $specialization) {
            return redirect('/guru/dashboard')->withErrors(['access' => 'Akses ditolak.']);
        }

        $tryoutId = $question->id_tryout;
        $deletedNum = $question->nomor_soal;

        $question->delete();

        // Urutkan kembali nomor soal untuk soal-soal yang tersisa
        $remaining = TryoutQuestion::where('id_tryout', $tryoutId)
            ->where('nomor_soal', '>', $deletedNum)
            ->orderBy('nomor_soal', 'asc')
            ->get();

        foreach ($remaining as $q) {
            $q->update(['nomor_soal' => $q->nomor_soal - 1]);
        }

        return redirect("/guru/tryout/{$tryoutId}/soal")->with('success', 'Soal berhasil dihapus.');
    }
}
