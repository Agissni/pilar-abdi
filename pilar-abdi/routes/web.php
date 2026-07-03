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
    $sekdins = [
        'stan' => [
            'name' => 'Politeknik Keuangan Negara (PKN STAN)',
            'ministry' => 'Kementerian Keuangan',
            'location' => 'Jakarta Selatan, DKI Jakarta',
            'logo' => 'stan.png',
            'background' => 'stan.png',
            'description' => 'PKN STAN adalah sekolah kedinasan Kementerian Keuangan terbaik untuk karir di bidang perpajakan, bea cukai, dan kepabeanan.',
            'requirements' => [
                'WNI maksimal 22 tahun saat pendaftaran',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
                'Tidak buta warna',
                'Tidak pernah dinyatakan bersalah oleh hukum'
            ],
            'terms' => [
                'Nilai akademis dan administrasi lengkap',
                'Telah lulus SMA/SMK/MA',
                'Dokumen KTP, ijazah, dan pasfoto terbaru',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'Seleksi Kompetensi Dasar (SKD): TIU, TWK, TKP',
                'Wawancara dan psikotes',
                'Pengumuman dan daftar ulang'
            ]
        ],
        'ipdn' => [
            'name' => 'Institut Pemerintahan Dalam Negeri (IPDN)',
            'ministry' => 'Kementerian Dalam Negeri',
            'location' => 'Jatinangor, Kabupaten Sumedang',
            'logo' => 'ipdn.png',
            'background' => 'ipdn.png',
            'description' => 'IPDN mendidik calon pamong praja untuk menjadi birokrat daerah yang profesional dan berintegritas.',
            'requirements' => [
                'WNI maksimal 22 tahun',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
                'Tinggi badan minimal sesuai ketentuan',
            ],
            'terms' => [
                'Administrasi lengkap dan surat sehat',
                'Tidak sedang terikat kontrak kerja',
                'Tidak pernah dihukum pidana',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'Seleksi Kompetensi Dasar (SKD)',
                'Seleksi Kompetensi Bidang (SKB) dan wawasan kebangsaan',
                'Kesehatan dan kebugaran',
                'Pengumuman final'
            ]
        ],
        'stis' => [
            'name' => 'Politeknik Statistika STIS',
            'ministry' => 'Badan Pusat Statistik',
            'location' => 'Tangerang Selatan, Banten',
            'logo' => 'STIS.jpg',
            'background' => 'STIS.jpg',
            'description' => 'STIS fokus pada pendidikan statistik, data analis, dan survei nasional untuk kebutuhan BPS.',
            'requirements' => [
                'WNI maksimal 21 tahun',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
            ],
            'terms' => [
                'Mengunggah ijazah dan pasfoto',
                'Mengisi data administrasi dengan benar',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'SKD: TIU, TWK, TKP',
                'Tes akademik khusus statistik (STIS)',
                'Wawancara',
                'Pengumuman'
            ]
        ],
        'stmkg' => [
            'name' => 'Sekolah Tinggi Meteorologi, Klimatologi, dan Geofisika (STMKG)',
            'ministry' => 'Badan Meteorologi, Klimatologi, dan Geofisika',
            'location' => 'Jakarta Utara, DKI Jakarta',
            'logo' => 'STMKG.jpg',
            'background' => 'STMKG.jpg',
            'description' => 'STMKG mempersiapkan peserta untuk karir di bidang meteorologi, klimatologi, geofisika, dan kebencanaan.',
            'requirements' => [
                'WNI maksimal 21 tahun',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
            ],
            'terms' => [
                'Administrasi lengkap',
                'Surat sehat dan bebas narkoba',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'SKD',
                'Tes kemampuan khusus STMKG',
                'Wawancara',
                'Pengumuman'
            ]
        ],
        'poltek-ssn' => [
            'name' => 'Politeknik Siber dan Sandi Negara (Poltek SSN)',
            'ministry' => 'Badan Siber dan Sandi Negara',
            'location' => 'Jakarta',
            'logo' => 'SSN.png',
            'background' => 'SSN.png',
            'description' => 'Poltek SSN mendidik calon ahli keamanan siber, kriptografi, dan perlindungan data negara.',
            'requirements' => [
                'WNI maksimal 22 tahun',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
            ],
            'terms' => [
                'Administrasi lengkap',
                'Bebas narkoba dan catatan kriminal',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'SKD',
                'Tes kesehatan dan psikologi',
                'Wawancara',
                'Pengumuman'
            ]
        ],
        'stin' => [
            'name' => 'Sekolah Tinggi Intelijen Negara (STIN)',
            'ministry' => 'Badan Intelijen Negara',
            'location' => 'Bogor, Jawa Barat',
            'logo' => 'stin.png',
            'background' => 'stin.png',
            'description' => 'STIN mendidik calon intelijen dan analis keamanan untuk kebutuhan BIN dan negara.',
            'requirements' => [
                'WNI maksimal 22 tahun',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
                'Tidak pernah terlibat kasus kriminal',
            ],
            'terms' => [
                'Administrasi lengkap',
                'Surat sehat jasmani dan rohani',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'SKD',
                'Tes psikologi & wawancara',
                'Pengumuman'
            ]
        ],
        'poltekip' => [
            'name' => 'Politeknik Ilmu Pemasyarakatan (POLTEKIP)',
            'ministry' => 'Kementerian Hukum dan HAM',
            'location' => 'Klaten, Jawa Tengah',
            'logo' => 'Poltekip.jpg',
            'background' => 'Poltekip.jpg',
            'description' => 'Poltekip melatih calon petugas pemasyarakatan dan staf hukum dalam sistem pemasyarakatan nasional.',
            'requirements' => [
                'WNI maksimal 21 tahun',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
            ],
            'terms' => [
                'Administrasi lengkap',
                'Surat sehat',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'SKD',
                'Tes kesehatan',
                'Wawancara',
                'Pengumuman'
            ]
        ],
        'poltekim' => [
            'name' => 'Politeknik Imigrasi (POLTEKIM)',
            'ministry' => 'Kementerian Hukum dan HAM',
            'location' => 'Karawang, Jawa Barat',
            'logo' => 'poltekim.png',
            'background' => 'poltekim.png',
            'description' => 'Poltekim menyiapkan calon petugas keimigrasian dengan pelatihan hukum, bahasa, dan keamanan perbatasan.',
            'requirements' => [
                'WNI maksimal 21 tahun',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
            ],
            'terms' => [
                'Administrasi lengkap',
                'Surat sehat',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'SKD',
                'Tes kesehatan',
                'Wawancara',
                'Pengumuman'
            ]
        ],
        'ptdi-sttd' => [
            'name' => 'Politeknik Transportasi Darat Indonesia (PTDI-STTD)',
            'ministry' => 'Kementerian Perhubungan',
            'location' => 'Tegal, Jawa Tengah',
            'logo' => 'STTD.png',
            'background' => 'STTD.png',
            'description' => 'PTDI-STTD mempersiapkan peserta untuk karir di bidang transportasi darat, penerbangan, dan logistik.',
            'requirements' => [
                'WNI maksimal 22 tahun',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
            ],
            'terms' => [
                'Administrasi lengkap',
                'Surat sehat',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'SKD',
                'Tes kesehatan dan wawancara',
                'Pengumuman'
            ]
        ],
        'stip-jakarta' => [
            'name' => 'STIP Jakarta',
            'ministry' => 'Kementerian Perhubungan',
            'location' => 'Jakarta Utara, DKI Jakarta',
            'logo' => 'STIP WARNA.jpg',
            'background' => 'STIP WARNA.jpg',
            'description' => 'STIP Jakarta adalah sekolah penerbangan Kemenhub yang fokus pada pelayaran, navigasi, dan transportasi laut.',
            'requirements' => [
                'WNI maksimal 22 tahun',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
            ],
            'terms' => [
                'Administrasi lengkap',
                'Surat sehat',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'SKD',
                'Tes kesehatan',
                'Pengumuman'
            ]
        ],
        'pip-semarang' => [
            'name' => 'PIP Semarang',
            'ministry' => 'Kementerian Perhubungan',
            'location' => 'Semarang, Jawa Tengah',
            'logo' => 'PIP.png',
            'background' => 'PIP.png',
            'description' => 'PIP Semarang mendidik calon pelaut dan profesional maritim untuk industri pelayaran nasional.',
            'requirements' => [
                'WNI maksimal 22 tahun',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
            ],
            'terms' => [
                'Administrasi lengkap',
                'Surat sehat',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'SKD',
                'Tes kesehatan',
                'Pengumuman'
            ]
        ],
        'pip-makassar' => [
            'name' => 'Politeknik Pembangunan Pertanian (POLBANGTAN)',
            'ministry' => 'Kementerian Pertanian',
            'location' => 'Beberapa lokasi (Medan, Bogor, Yogyakarta-Magelang, Malang, Gowa, Manokwari)',
            'logo' => 'polbangtan.png',
            'background' => 'polbangtan.png',
            'description' => 'Institusi pendidikan vokasi di bawah Kementan yang fokus mencetak wirausahawan muda pertanian dan tenaga ahli profesional di bidang pertanian.',
            'requirements' => [
                'Lulusan SMA/SMK Pertanian/MA sederajat.',
                'Maksimal 21-22 tahun (tergantung ketentuan tahun berjalan).',
                'Sehat jasmani dan rohani.',
                'Tidak memiliki riwayat penyakit yang menghambat proses pendidikan di lapangan.'
            ],
            'terms' => [
                'Pendaftaran melalui portal resmi PMB Polbangtan (biasanya terpisah dari SSCASN Dikdin).',
                'Seleksi Administrasi, Tes Tulis, dan Wawancara.'
            ],
            'selection' => [
                'Seleksi Administrasi',
                'Tes Potensi Akademik',
                'Wawancara & Psikotes',
                'Pengumuman Final'
            ]
        ],
        'polbangtan' => [
            'name' => 'Politeknik Pembangunan Pertanian (POLBANGTAN)',
            'ministry' => 'Kementerian Pertanian',
            'location' => 'Beberapa lokasi (Medan, Bogor, Yogyakarta-Magelang, Malang, Gowa, Manokwari)',
            'logo' => 'polbangtan.png',
            'background' => 'polbangtan.png',
            'description' => 'Institusi pendidikan vokasi di bawah Kementan yang fokus mencetak wirausahawan muda pertanian dan tenaga ahli profesional di bidang pertanian.',
            'requirements' => [
                'Akademik' => ['Lulusan SMA/SMK Pertanian/MA sederajat.'],
                'Usia' => 'Maksimal 21-22 tahun (tergantung ketentuan tahun berjalan).',
                'Fisik' => ['Sehat jasmani dan rohani.', 'Tidak memiliki riwayat penyakit yang menghambat proses pendidikan di lapangan.']
            ],
            'terms' => [
                'Pendaftaran' => 'Melalui portal resmi PMB Polbangtan (biasanya terpisah dari SSCASN Dikdin).',
                'Seleksi' => 'Seleksi Administrasi, Tes Tulis, dan Wawancara.'
            ],
            'selection' => [
                'Seleksi Administrasi',
                'Tes Potensi Akademik',
                'Wawancara & Psikotes',
                'Pengumuman Final'
            ]
        ],
        'poltekbang' => [
            'name' => 'Politeknik Penerbangan (POLTEKBANG)',
            'ministry' => 'Kementerian Perhubungan',
            'location' => 'Berbagai lokasi (Jakarta, Makassar, Sorong, dll)',
            'logo' => 'POLTEKBANG.png',
            'background' => 'POLTEKBANG.png',
            'description' => 'Poltekbang melatih calon tenaga transportasi darat, laut, dan udara di beberapa lokasi strategis.',
            'requirements' => [
                'WNI maksimal 22 tahun',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
            ],
            'terms' => [
                'Administrasi lengkap',
                'Surat sehat',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'SKD',
                'Tes kesehatan',
                'Pengumuman'
            ]
        ],
        'poltektrans-sdp' => [
            'name' => 'Politeknik Transportasi Sungai, Danau, dan Penyeberangan (POLTEKTRANS SDP)',
            'ministry' => 'Kementerian Perhubungan',
            'location' => 'Jakarta',
            'logo' => 'POLTEKTRANS.jpg',
            'background' => 'POLTEKTRANS.jpg',
            'description' => 'Poltektrans SDP adalah sekolah kedinasan Kemenhub untuk calon ahli transportasi dan logistik darat.',
            'requirements' => [
                'WNI maksimal 22 tahun',
                'Lulus SMA/SMK/MA sederajat',
                'Sehat jasmani dan rohani',
            ],
            'terms' => [
                'Administrasi lengkap',
                'Surat sehat',
            ],
            'selection' => [
                'Seleksi Administrasi',
                'SKD',
                'Tes kesehatan',
                'Pengumuman'
            ]
        ],
    ];

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

    // Halaman statis
    Route::get('/admin/tryout', function () {
        $admin = \App\Models\User::find(session('user_id'));
        return view('admin.tryout', compact('admin'));
    });
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
        return view('siswa.tryout', compact('user'));
    });
});

// Guru routes group
Route::middleware(['guru'])->group(function () {
    Route::get('/guru/dashboard', [App\Http\Controllers\GuruController::class, 'dashboard']);
    Route::post('/guru/kelas/{id}/update', [App\Http\Controllers\GuruController::class, 'updateKelas']);
});