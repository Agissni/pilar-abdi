<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.welcome');
});

Route::get('/program', function () {
    return view('public.program');
});

Route::get('/pendaftaran', function () {
    return view('public.pendaftaran');
});

// registration routes
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'show']);
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/sekdin/{slug}', function ($slug) {
    $sekdins = config('sekdins');

    if (!isset($sekdins[$slug])) {
        abort(404);
    }

    $sekdin = $sekdins[$slug];
    $sekdin['logo'] = asset('assets/' . $sekdin['logo']);
    $sekdin['background'] = asset('assets/' . ($sekdin['background'] ?? $sekdin['logo'] ?? 'logoo.png'));

    return view('public.sekdin', ['sekdin' => $sekdin]);
});

Route::get('/pembayaran', [App\Http\Controllers\PaymentController::class, 'show']);
Route::post('/pembayaran/upload', [App\Http\Controllers\PaymentController::class, 'upload']);
Route::get('/pembayaran/berhasil', [App\Http\Controllers\PaymentController::class, 'success']);

// admin payment verification
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/pembayaran', [App\Http\Controllers\PaymentController::class, 'indexAdmin']);
    Route::post('/admin/pembayaran/{id}/verify', [App\Http\Controllers\PaymentController::class, 'verify']);

    // Admin routes 
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard']);
    Route::get('/admin/siswa',     [App\Http\Controllers\AdminController::class, 'siswa']);
    Route::post('/admin/siswa/{id}/toggle-status', [App\Http\Controllers\AdminController::class, 'toggleStatus']);

    // Guru CRUD
    Route::get('/admin/guru',          [App\Http\Controllers\AdminGuruController::class, 'index']);
    Route::post('/admin/guru',         [App\Http\Controllers\AdminGuruController::class, 'store']);
    Route::put('/admin/guru/{id}',     [App\Http\Controllers\AdminGuruController::class, 'update']);
    Route::delete('/admin/guru/{id}',  [App\Http\Controllers\AdminGuruController::class, 'destroy']);

    // Kelas CRUD
    Route::get('/admin/kelas',          [App\Http\Controllers\AdminKelasController::class, 'index']);
    Route::post('/admin/kelas',         [App\Http\Controllers\AdminKelasController::class, 'store']);
    Route::put('/admin/kelas/{id}',     [App\Http\Controllers\AdminKelasController::class, 'update']);
    Route::delete('/admin/kelas/{id}',  [App\Http\Controllers\AdminKelasController::class, 'destroy']);

    // Tryout CRUD
    Route::get('/admin/tryout',          [App\Http\Controllers\AdminTryoutController::class, 'index']);
    Route::post('/admin/tryout',         [App\Http\Controllers\AdminTryoutController::class, 'store']);
    Route::get('/admin/tryout/{id}',     [App\Http\Controllers\AdminTryoutController::class, 'show']);
    Route::put('/admin/tryout/{id}',     [App\Http\Controllers\AdminTryoutController::class, 'update']);
    Route::delete('/admin/tryout/{id}',  [App\Http\Controllers\AdminTryoutController::class, 'destroy']);

    // Tryout Questions CRUD
    Route::get('/admin/tryout/{tryout_id}/soal',          [App\Http\Controllers\AdminTryoutQuestionController::class, 'index']);
    Route::post('/admin/tryout/{tryout_id}/soal',         [App\Http\Controllers\AdminTryoutQuestionController::class, 'store']);
    Route::get('/admin/tryout/soal/{id}',                 [App\Http\Controllers\AdminTryoutQuestionController::class, 'show']);
    Route::put('/admin/tryout/soal/{id}',                 [App\Http\Controllers\AdminTryoutQuestionController::class, 'update']);
    Route::delete('/admin/tryout/soal/{id}',              [App\Http\Controllers\AdminTryoutQuestionController::class, 'destroy']);
    Route::post('/admin/tryout/{tryout_id}/soal/sync',    [App\Http\Controllers\AdminTryoutQuestionController::class, 'sync']);

    // Pengumuman CRUD
    Route::get('/admin/pengumuman',          [App\Http\Controllers\AdminPengumumanController::class, 'index']);
    Route::post('/admin/pengumuman',         [App\Http\Controllers\AdminPengumumanController::class, 'store']);
    Route::get('/admin/pengumuman/{id}',     [App\Http\Controllers\AdminPengumumanController::class, 'show']);
    Route::put('/admin/pengumuman/{id}',     [App\Http\Controllers\AdminPengumumanController::class, 'update']);
    Route::delete('/admin/pengumuman/{id}',  [App\Http\Controllers\AdminPengumumanController::class, 'destroy']);
});

Route::get('/testimoni', function () {
    return view('public.testimoni');
});

Route::get('/keunggulan', function () {
    return view('public.keunggulan');
});

Route::get('/kontak', function () {
    return view('public.kontak');
});

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'show']);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'show']);
Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'reset']);

// Student routes group 
Route::middleware(['siswa'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\SiswaController::class, 'dashboard']);

    Route::get('/kelas', function () {
        $user = \App\Models\User::find(session('user_id'));
        $kelas = \App\Models\Kelas::with('guru')->latest()->get();
        return view('siswa.kelas', compact('user', 'kelas'));
    });

    Route::get('/tryout', function () {
        $user = \App\Models\User::find(session('user_id'));
        $tryouts = \App\Models\Tryout::latest()->get();
        
        $attemptsCount = \App\Models\TryoutAttempt::where('id_user', $user->id_user)->count();
        $package = strtolower($user->package ?? '');
        
        if (str_contains($package, 'pro') || str_contains($package, 'tahunan')) {
            $limit = 17;
        } elseif (str_contains($package, 'intensif')) {
            $limit = 6;
        } else {
            $limit = 3; // Paket Dasar / Reguler
        }
        
        $remainingAttempts = ($limit === -1) ? 999 : max(0, $limit - $attemptsCount);
        
        return view('siswa.tryout', compact('user', 'tryouts', 'attemptsCount', 'limit', 'remainingAttempts'));
    });

    Route::post('/tryout/{id}/submit', [App\Http\Controllers\SiswaController::class, 'submitTryout']);
    Route::get('/tryout/{id}/questions', [App\Http\Controllers\SiswaController::class, 'getTryoutQuestions']);
    Route::get('/hasil-tryout', [App\Http\Controllers\SiswaController::class, 'hasilTryout']);
    Route::get('/hasil-tryout/{id}/print', [App\Http\Controllers\SiswaController::class, 'printRapor']);
    Route::get('/hasil-tryout/{id}/certificate', [App\Http\Controllers\SiswaController::class, 'printSertifikat']);
    Route::get('/strategi-lolos', function () { return view('siswa.strategi'); });
    Route::post('/siswa/bimbingan/booking', [App\Http\Controllers\SiswaController::class, 'bookingBimbingan']);
});

// Guru routes group
Route::middleware(['guru'])->group(function () {
    Route::get('/guru/dashboard', [App\Http\Controllers\GuruController::class, 'dashboard']);
    Route::post('/guru/kelas/{id}/update', [App\Http\Controllers\GuruController::class, 'updateKelas']);
    Route::get('/guru/siswa', [App\Http\Controllers\GuruController::class, 'siswa']);

    // Guru Tryout & Questions CRUD 
    Route::get('/guru/tryout',                      [App\Http\Controllers\GuruTryoutController::class, 'index']);
    Route::get('/guru/tryout/{tryout_id}/soal',     [App\Http\Controllers\GuruTryoutController::class, 'soal']);
    Route::post('/guru/tryout/{tryout_id}/soal',    [App\Http\Controllers\GuruTryoutController::class, 'storeSoal']);
    Route::get('/guru/tryout/soal/{id}',            [App\Http\Controllers\GuruTryoutController::class, 'showSoal']);
    Route::put('/guru/tryout/soal/{id}',            [App\Http\Controllers\GuruTryoutController::class, 'updateSoal']);
    Route::delete('/guru/tryout/soal/{id}',         [App\Http\Controllers\GuruTryoutController::class, 'destroySoal']);

    // Guru Bimbingan/Konsultasi 1-on-1
    Route::get('/guru/konsultasi',                  [App\Http\Controllers\GuruController::class, 'konsultasi']);
    Route::post('/guru/konsultasi/{id}/approve',    [App\Http\Controllers\GuruController::class, 'approveKonsultasi']);
    Route::post('/guru/konsultasi/{id}/reject',     [App\Http\Controllers\GuruController::class, 'rejectKonsultasi']);
});