@extends('layouts.app')
@section('title', 'Program & Paket')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary">Program Bimbingan Pilar Abdi</h1>
        <p class="lead text-muted">Pilih paket yang paling cocok untuk persiapan Sekolah Kedinasan kamu</p>
    </div>

    <div class="row g-4 justify-content-center">

        <!-- Paket 1: Dasar (3 Bulan) -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <p class="mb-0 small text-white-50">3 Bulan</p>
                    <h5 class="mb-0">Paket Dasar</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="text-primary fw-bold">Rp 890.000</h2>
                    <p class="text-muted small">≈ Rp 297.000 / bulan</p>
                    <span class="badge bg-success-subtle text-success mb-3">Terjangkau</span>

                    <ul class="list-unstyled mt-3 text-start">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> TIU + TWK + TKP — materi lengkap + latihan soal</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 8x Pertemuan Live (2x/bulan), rekaman tersedia</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 3x Try Out simulasi SKD</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Grup diskusi Telegram aktif</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Rekap materi PDF mingguan</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Akses materi selama 6 bulan</li>
                    </ul>
                </div>
                <div class="card-footer bg-light border-0 pt-4">
                    <a href="#" class="btn btn-outline-primary w-100 py-3">Pilih Paket Dasar</a>
                </div>
            </div>
        </div>

        <!-- Paket 2: Intensif 6 Bulan (Paling Dipilih) -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow border-primary position-relative" style="transform: scale(1.03);">
                <div class="badge bg-primary text-white position-absolute top-0 start-50 translate-middle px-4 py-2 fs-6 fw-bold">
                    ⭐ Paling Dipilih
                </div>

                <div class="card-header bg-primary text-white text-center py-3">
                    <p class="mb-0 small text-white-50">6 Bulan</p>
                    <h5 class="mb-0">Paket Intensif</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="text-primary fw-bold">Rp 1.650.000</h2>
                    <p class="text-muted small">≈ Rp 275.000 / bulan</p>
                    <span class="badge bg-success-subtle text-success mb-3">Nilai terbaik per bulan</span>

                    <ul class="list-unstyled mt-3 text-start">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Semua materi Dasar + video rekaman HD</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 16x Pertemuan Live (2x/bulan + 4x sesi bonus)</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 6x Try Out — setiap bulan sekali</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 2x Konsultasi Pribadi (1-on-1, 30 mnt)</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Grup WhatsApp eksklusif + mentor aktif</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Simulasi SKD + SKB dasar 2x</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Akses materi selama 9 bulan</li>
                    </ul>
                </div>
                <div class="card-footer bg-light border-0 pt-4">
                    <a href="#" class="btn btn-primary w-100 py-3">Pilih Paket Intensif</a>
                </div>
            </div>
        </div>

        <!-- Paket 3: Pro (12 Bulan) -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <p class="mb-0 small text-white-50">12 Bulan</p>
                    <h5 class="mb-0">Paket Pro</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="text-primary fw-bold">Rp 2.750.000</h2>
                    <p class="text-muted small">≈ Rp 229.000 / bulan</p>
                    <span class="badge bg-success-subtle text-success mb-3">Paling hemat per bulan</span>

                    <ul class="list-unstyled mt-3 text-start">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Semua fitur Intensif</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 36x Pertemuan Live (3x/bulan)</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Try Out setiap 3 minggu (~17x setahun)</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 5x Konsultasi Pribadi + prioritas jadwal</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Analisis hasil TO + laporan progres bulanan</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Sertifikat kelulusan + surat rekomendasi</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Akses materi selama 18 bulan</li>
                    </ul>
                </div>
                <div class="card-footer bg-light border-0 pt-4">
                    <a href="#" class="btn btn-outline-primary w-100 py-3">Pilih Paket Pro</a>
                </div>
            </div>
        </div>

    </div>

    <div class="text-center mt-5">
        <p class="text-muted small">
            <i class="bi bi-shield-check"></i> Harga sudah termasuk semua materi & fasilitas.
        </p>
    </div>
</div>
@endsection