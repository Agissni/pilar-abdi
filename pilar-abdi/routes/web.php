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

    // Admin routes — menggunakan AdminController dengan data real
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard']);
    Route::get('/admin/siswa',     [App\Http\Controllers\AdminController::class, 'siswa']);

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

// Student routes group (only for active students)
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
        return view('siswa.tryout', compact('user', 'tryouts'));
    });
});

// Guru routes group
Route::middleware(['guru'])->group(function () {
    Route::get('/guru/dashboard', [App\Http\Controllers\GuruController::class, 'dashboard']);
    Route::post('/guru/kelas/{id}/update', [App\Http\Controllers\GuruController::class, 'updateKelas']);
});