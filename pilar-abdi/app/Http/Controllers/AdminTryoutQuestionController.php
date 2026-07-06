<?php

namespace App\Http\Controllers;

use App\Models\Tryout;
use App\Models\TryoutQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminTryoutQuestionController extends Controller
{
    public function index($tryout_id)
    {
        $tryout = Tryout::findOrFail($tryout_id);
        $questions = $tryout->questions()->orderBy('nomor_soal', 'asc')->get();
        return view('admin.soal', compact('tryout', 'questions'));
    }

    public function store(Request $request, $tryout_id)
    {
        $tryout = Tryout::findOrFail($tryout_id);

        // Validation rule: limit of questions
        $existingCount = $tryout->questions()->count();
        if ($existingCount >= $tryout->jumlah_soal) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['limit' => 'Jumlah soal telah mencapai batas maksimal sesuai pengaturan Try Out.']);
        }

        $data = $request->validate([
            'kategori' => 'required|in:TIU,TWK,TKP',
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'pilihan_e' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D,E',
            'pembahasan' => 'nullable|string',
        ], [
            'kategori.required' => 'Kategori wajib dipilih.',
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'pilihan_a.required' => 'Pilihan A wajib diisi.',
            'pilihan_b.required' => 'Pilihan B wajib diisi.',
            'pilihan_c.required' => 'Pilihan C wajib diisi.',
            'pilihan_d.required' => 'Pilihan D wajib diisi.',
            'pilihan_e.required' => 'Pilihan E wajib diisi.',
            'jawaban_benar.required' => 'Jawaban benar wajib ditentukan.',
        ]);

        $data['tryout_id'] = $tryout->id;
        $data['nomor_soal'] = $existingCount + 1;

        TryoutQuestion::create($data);

        Log::info('Tryout question created', ['tryout_id' => $tryout_id, 'nomor_soal' => $data['nomor_soal']]);

        return redirect("/admin/tryout/{$tryout_id}/soal")->with('success', 'Soal berhasil ditambahkan.');
    }

    public function show($id)
    {
        $question = TryoutQuestion::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $question
        ]);
    }

    public function update(Request $request, $id)
    {
        $question = TryoutQuestion::findOrFail($id);

        $data = $request->validate([
            'kategori' => 'required|in:TIU,TWK,TKP',
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'pilihan_e' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D,E',
            'pembahasan' => 'nullable|string',
        ], [
            'kategori.required' => 'Kategori wajib dipilih.',
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'pilihan_a.required' => 'Pilihan A wajib diisi.',
            'pilihan_b.required' => 'Pilihan B wajib diisi.',
            'pilihan_c.required' => 'Pilihan C wajib diisi.',
            'pilihan_d.required' => 'Pilihan D wajib diisi.',
            'pilihan_e.required' => 'Pilihan E wajib diisi.',
            'jawaban_benar.required' => 'Jawaban benar wajib ditentukan.',
        ]);

        $question->update($data);

        Log::info('Tryout question updated', ['id' => $id, 'nomor_soal' => $question->nomor_soal]);

        return redirect("/admin/tryout/{$question->tryout_id}/soal")->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $question = TryoutQuestion::findOrFail($id);
        $tryoutId = $question->tryout_id;
        $deletedNum = $question->nomor_soal;
        
        $question->delete();

        // Re-sequence remaining questions
        $remaining = TryoutQuestion::where('tryout_id', $tryoutId)
            ->where('nomor_soal', '>', $deletedNum)
            ->orderBy('nomor_soal', 'asc')
            ->get();

        foreach ($remaining as $q) {
            $q->update(['nomor_soal' => $q->nomor_soal - 1]);
        }

        Log::info('Tryout question deleted and re-sequenced', ['tryout_id' => $tryoutId, 'deleted_num' => $deletedNum]);

        return redirect("/admin/tryout/{$tryoutId}/soal")->with('success', 'Soal berhasil dihapus.');
    }
}
