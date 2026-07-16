<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function dashboard(Request $request)
    {
        $userId = $request->session()->get('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $user = User::find($userId);
        if (!$user) {
            $request->session()->forget('user_id');
            return redirect('/login');
        }

        if ($user->status === 'pending') {
            $request->session()->forget('user_id');
            return redirect('/login')->withErrors(['account' => 'Akun Anda masih menunggu verifikasi admin.']);
        }

        if ($user->status !== 'active') {
            $request->session()->forget('user_id');
            return redirect('/login')->withErrors(['account' => 'Status akun tidak valid. Silakan hubungi admin.']);
        }

        $sekdinKey = strtolower($user->sekdin);
        $sekdins = config('sekdins');
        
        $sekdinInfo = null;
        if (isset($sekdins[$sekdinKey])) {
            $sekdinInfo = $sekdins[$sekdinKey];
        } else {
            // fallback: search by name
            foreach ($sekdins as $key => $info) {
                if (strtolower($info['name']) === $sekdinKey) {
                    $sekdinInfo = $info;
                    break;
                }
            }
        }
        
        if (!$sekdinInfo) {
            $sekdinInfo = $sekdins['lainnya'];
        }

        // Fetch active announcements from database (max 3, newest first)
        $announcements = \App\Models\Pengumuman::where('status', 'aktif')
            ->whereIn('target_role', ['semua', 'siswa'])
            ->orderBy('tanggal_publikasi', 'desc')
            ->take(3)
            ->get();

        // Bimbingan Privat 1-on-1 calculations
        $gurus = \App\Models\Guru::orderBy('nama', 'asc')->get();
        $riwayatBimbingan = \App\Models\BimbinganPrivat::with('guru')
            ->where('id_user', $user->id_user)
            ->orderBy('created_at', 'desc')
            ->get();

        $package = strtolower($user->package ?? '');
        if (str_contains($package, 'pro') || str_contains($package, 'tahunan')) {
            $totalKuota = 5;
        } elseif (str_contains($package, 'intensif')) {
            $totalKuota = 2;
        } else {
            $totalKuota = 0;
        }

        $usedSesi = \App\Models\BimbinganPrivat::where('id_user', $user->id_user)
            ->where('status', '!=', 'dibatalkan')
            ->count();

        $sisaKuota = max(0, $totalKuota - $usedSesi);

        return view('siswa.dashboard', [
            'user' => $user,
            'sekdin' => $sekdinInfo,
            'announcements' => $announcements,
            'gurus' => $gurus,
            'riwayatBimbingan' => $riwayatBimbingan,
            'totalKuota' => $totalKuota,
            'sisaKuota' => $sisaKuota,
        ]);
    }

    public function bookingBimbingan(Request $request)
    {
        $userId = $request->session()->get('user_id');
        $user = User::findOrFail($userId);

        $package = strtolower($user->package ?? '');
        if (str_contains($package, 'pro') || str_contains($package, 'tahunan')) {
            $totalKuota = 5;
        } elseif (str_contains($package, 'intensif')) {
            $totalKuota = 2;
        } else {
            $totalKuota = 0;
        }

        $usedSesi = \App\Models\BimbinganPrivat::where('id_user', $user->id_user)
            ->where('status', '!=', 'dibatalkan')
            ->count();

        $sisaKuota = max(0, $totalKuota - $usedSesi);

        if ($sisaKuota <= 0) {
            return back()->with('error', 'Kuota konsultasi Anda sudah habis atau paket Anda tidak mendukung bimbingan privat.');
        }

        $data = $request->validate([
            'id_guru' => 'required|exists:guru,id_guru',
            'tgl_konsultasi' => 'required|date|after_or_equal:today',
            'jam_konsultasi' => 'required',
            'topik' => 'required|string',
        ], [
            'id_guru.required' => 'Mentor/Guru harus dipilih.',
            'tgl_konsultasi.required' => 'Tanggal bimbingan harus diisi.',
            'tgl_konsultasi.after_or_equal' => 'Tanggal bimbingan tidak boleh hari kemarin.',
            'jam_konsultasi.required' => 'Jam bimbingan harus diisi.',
            'topik.required' => 'Topik bimbingan harus diisi.',
        ]);

        $data['id_user'] = $user->id_user;
        $data['status'] = 'pending';

        \App\Models\BimbinganPrivat::create($data);

        return back()->with('success', 'Jadwal konsultasi 1-on-1 berhasil diajukan. Menunggu persetujuan mentor.');
    }

    public function submitTryout(Request $request, $id)
    {
        $userId = $request->session()->get('user_id');
        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $user = User::find($userId);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }

        $tryout = \App\Models\Tryout::findOrFail($id);

        // Server-side check of remaining attempts quota
        $attemptsCount = \App\Models\TryoutAttempt::where('id_user', $user->id_user)->count();
        $package = strtolower($user->package ?? '');
        if (str_contains($package, 'pro') || str_contains($package, 'tahunan')) {
            $limit = 17;
        } elseif (str_contains($package, 'intensif')) {
            $limit = 6;
        } else {
            $limit = 3; // Paket Dasar / Reguler
        }

        if ($limit !== -1 && $attemptsCount >= $limit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kuota pengerjaan Tryout Anda untuk paket ini telah habis.'
            ], 403);
        }

        $data = $request->validate([
            'score_twk' => 'required|integer',
            'score_tiu' => 'required|integer',
            'score_tkp' => 'required|integer',
            'score_total' => 'required|integer',
            'status' => 'required|in:lulus,tidak_lulus',
        ]);

        $attempt = \App\Models\TryoutAttempt::create([
            'id_user' => $user->id_user,
            'id_tryout' => $tryout->id_tryout,
            'score_twk' => $data['score_twk'],
            'score_tiu' => $data['score_tiu'],
            'score_tkp' => $data['score_tkp'],
            'score_total' => $data['score_total'],
            'status' => $data['status'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Hasil tryout berhasil disimpan.',
            'data' => $attempt
        ]);
    }

    public function hasilTryout(Request $request)
    {
        $userId = $request->session()->get('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $user = User::findOrFail($userId);
        $attempts = \App\Models\TryoutAttempt::with('tryout')
            ->where('id_user', $user->id_user)
            ->latest()
            ->get();

        $stats = [
            'total' => $attempts->count(),
            'lulus' => $attempts->where('status', 'lulus')->count(),
            'tidak_lulus' => $attempts->where('status', 'tidak_lulus')->count(),
        ];

        return view('siswa.hasil', compact('user', 'attempts', 'stats'));
    }

    public function printRapor(Request $request, $id)
    {
        $userId = $request->session()->get('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $attempt = \App\Models\TryoutAttempt::with(['user', 'tryout'])
            ->where('id_user', $userId)
            ->findOrFail($id);

        return view('siswa.print_rapor', compact('attempt'));
    }

    public function printSertifikat(Request $request, $id)
    {
        $userId = $request->session()->get('user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $attempt = \App\Models\TryoutAttempt::with(['user', 'tryout'])
            ->where('id_user', $userId)
            ->findOrFail($id);

        $questions = \App\Models\TryoutQuestion::where('id_tryout', $attempt->id_tryout)
            ->orderBy('nomor_soal', 'asc')
            ->get();

        return view('siswa.print_sertifikat', compact('attempt', 'questions'));
    }

    public function getTryoutQuestions(Request $request, $id)
    {
        $userId = $request->session()->get('user_id');
        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $tryout = \App\Models\Tryout::findOrFail($id);
        $dbQuestions = \App\Models\TryoutQuestion::where('id_tryout', $id)
            ->orderBy('nomor_soal', 'asc')
            ->get();

        $questions = $dbQuestions->map(function ($q) {
            $correct = strtoupper($q->jawaban_benar);
            $optionsList = ['A', 'B', 'C', 'D', 'E'];
            $points = [];
            
            if ($q->kategori === 'TKP') {
                $correctIndex = array_search($correct, $optionsList);
                if ($correctIndex === false) $correctIndex = 0;
                
                foreach ($optionsList as $index => $opt) {
                    $distance = abs($index - $correctIndex);
                    $score = 5 - $distance;
                    if ($score < 1) $score = 1;
                    $points[$opt] = $score;
                }
            }

            return [
                'id' => $q->nomor_soal,
                'db_id' => $q->id_tryout_question,
                'category' => $q->kategori,
                'categoryFull' => $q->kategori === 'TWK' ? 'Tes Wawasan Kebangsaan (TWK)' : ($q->kategori === 'TIU' ? 'Tes Inteligensia Umum (TIU)' : 'Tes Karakteristik Pribadi (TKP)'),
                'question' => $q->pertanyaan,
                'options' => [
                    'A' => 'A. ' . $q->pilihan_a,
                    'B' => 'B. ' . $q->pilihan_b,
                    'C' => 'C. ' . $q->pilihan_c,
                    'D' => 'D. ' . $q->pilihan_d,
                    'E' => 'E. ' . $q->pilihan_e,
                ],
                'correct' => $correct,
                'points' => $points
            ];
        });

        return response()->json([
            'status' => 'success',
            'questions' => $questions
        ]);
    }
}
