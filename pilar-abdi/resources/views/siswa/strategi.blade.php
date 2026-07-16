@extends('layouts.app')
@section('title', 'Strategi Lolos CAT SKD')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-dark mb-2">
            <i class="bi bi-rocket-takeoff-fill text-warning me-2"></i>Strategi Lolos CAT SKD Kedinasan
        </h1>
        <p class="text-muted lead">Panduan taktis & tips manajemen waktu untuk menembus ambang batas nilai (Passing Grade)</p>
    </div>

    <div class="row g-4">
        <!-- 1. MANAJEMEN WAKTU -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 16px; border-left: 5px solid #0d6efd !important;">
                <div class="d-flex align-items-center mb-3">
                    <span class="fs-2 me-3">⏱️</span>
                    <h4 class="fw-bold mb-0" style="color: #071739;">Manajemen Waktu CAT</h4>
                </div>
                <p class="text-secondary small">Ujian CAT SKD terdiri dari <strong>110 Soal</strong> dengan durasi hanya <strong>100 Menit</strong>. Artinya, Anda memiliki rata-rata kurang dari 50 detik per soal!</p>
                <ul class="list-unstyled text-secondary" style="font-size: 14px;">
                    <li class="mb-2"><i class="bi bi-arrow-right-short text-primary"></i> <strong>Aturan 30 Detik:</strong> Jika dalam 30 detik Anda bingung mencari cara/jawaban soal hitungan, segera lewati (ragu-ragu) dan lanjut ke soal berikutnya. Jangan terpaku pada satu soal sulit.</li>
                    <li class="mb-2"><i class="bi bi-arrow-right-short text-primary"></i> <strong>Gunakan Fitur Penanda:</strong> Tandai soal yang ragu-ragu di sistem CAT agar bisa langsung diklik kembali di akhir ujian jika masih ada sisa waktu.</li>
                </ul>
            </div>
        </div>

        <!-- 2. URUTAN PENGERJAAN -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 16px; border-left: 5px solid #20c997 !important;">
                <div class="d-flex align-items-center mb-3">
                    <span class="fs-2 me-3">🎯</span>
                    <h4 class="fw-bold mb-0" style="color: #071739;">Strategi Urutan Pengerjaan</h4>
                </div>
                <p class="text-secondary small">Urutan pengerjaan soal sangat mempengaruhi kondisi psikologis dan fokus Anda selama ujian berlangsung:</p>
                <ol class="text-secondary" style="font-size: 14px; padding-left: 20px;">
                    <li class="mb-2"><strong>Mulai dengan TKP (Tes Karakteristik Pribadi):</strong> Kerjakan soal TKP di awal (menit 1-35). Soal TKP tidak memiliki nilai minus (skor 1-5), jawablah dengan tenang menggunakan logika kepribadian aparatur negara terbaik.</li>
                    <li class="mb-2"><strong>Lanjutkan dengan TWK (Tes Wawasan Kebangsaan):</strong> Kerjakan TWK di menit 36-55. Soal TWK berupa hapalan dan analisis wawasan kebangsaan, jawab dengan cepat soal-soal yang Anda yakini.</li>
                    <li class="mb-2"><strong>Selesaikan dengan TIU (Tes Inteligensia Umum):</strong> Kerjakan TIU di menit 56-90. Bagian ini membutuhkan perhitungan dan penalaran analitis tinggi yang menguras tenaga, kerjakan di akhir saat target soal kategori lain aman.</li>
                </ol>
            </div>
        </div>

        <!-- 3. STRATEGI PASSING GRADE -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 16px; border-left: 5px solid #ffc107 !important;">
                <div class="d-flex align-items-center mb-3">
                    <span class="fs-2 me-3">📊</span>
                    <h4 class="fw-bold mb-0" style="color: #071739;">Aturan Nilai Ambang Batas</h4>
                </div>
                <p class="text-secondary small">Syarat mutlak lolos SKD adalah memenuhi nilai minimum untuk **setiap kategori** (bukan hanya nilai total yang tinggi):</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center small mb-3">
                        <thead class="table-light">
                            <tr>
                                <th>Kategori</th>
                                <th>Passing Grade</th>
                                <th>Nilai Maksimal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>TWK</td>
                                <td class="fw-bold text-success">65</td>
                                <td>150</td>
                            </tr>
                            <tr>
                                <td>TIU</td>
                                <td class="fw-bold text-success">80</td>
                                <td>175</td>
                            </tr>
                            <tr>
                                <td>TKP</td>
                                <td class="fw-bold text-success">156</td>
                                <td>225</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="text-muted small mb-0"><i class="bi bi-info-circle-fill text-warning me-1"></i> <strong>Penting:</strong> Mendapatkan skor total 400 tidak ada gunanya jika nilai TIU Anda hanya 75. Fokuslah melompati garis Passing Grade di masing-masing kategori terlebih dahulu!</p>
            </div>
        </div>

        <!-- 4. TIPS MENTAL & FISIK -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 16px; border-left: 5px solid #dc3545 !important;">
                <div class="d-flex align-items-center mb-3">
                    <span class="fs-2 me-3">💪</span>
                    <h4 class="fw-bold mb-0" style="color: #071739;">Kesiapan Mental & Fisik</h4>
                </div>
                <p class="text-secondary small">Banyak siswa pintar gagal bukan karena kurang belajar, melainkan karena demam panggung saat ujian:</p>
                <ul class="list-unstyled text-secondary" style="font-size: 14px;">
                    <li class="mb-2"><i class="bi bi-check2-circle text-danger me-1"></i> <strong>H-1 Istirahat Total:</strong> Hentikan semua latihan soal H-1 ujian. Tidurlah minimal 7-8 jam agar otak Anda segar saat berpikir esok hari.</li>
                    <li class="mb-2"><i class="bi bi-check2-circle text-danger me-1"></i> <strong>Sarapan Secukupnya:</strong> Jangan masuk ruang ujian dengan perut kosong atau terlalu kenyang yang memicu kantuk.</li>
                    <li class="mb-2"><i class="bi bi-check2-circle text-danger me-1"></i> <strong>Latihan Nafas Dalam:</strong> Jika merasa cemas di depan layar komputer CAT, pejamkan mata sejenak dan tarik napas dalam-dalam 3 kali untuk menurunkan adrenalin.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- CALL TO ACTION -->
    <div class="card border-0 bg-primary bg-opacity-10 mt-5 p-4 text-center" style="border-radius: 16px;">
        <h5 class="fw-bold text-primary mb-2">Siap Menguji Strategi Anda?</h5>
        <p class="text-secondary small mb-3">Terapkan urutan pengerjaan dan manajemen waktu di atas langsung dalam simulasi ujian CAT kami.</p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="/tryout" class="btn btn-primary fw-bold px-4 py-2" style="border-radius: 10px;">
                Mulai Ujian Sekarang
            </a>
            <a href="/hasil-tryout" class="btn btn-outline-dark fw-bold px-4 py-2" style="border-radius: 10px;">
                Lihat Evaluasi Nilai
            </a>
        </div>
    </div>
</div>
@endsection
