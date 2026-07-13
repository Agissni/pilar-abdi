@extends('layouts.app')
@section('title', 'Program & Paket')

@section('content')
<style>
    .text-brand-dark {
        color: #071739 !important;
    }
    .bg-brand-dark {
        background-color: #071739 !important;
        color: white !important;
    }
    .text-brand-gold {
        color: #f5b93b !important;
    }
    .bg-brand-gold {
        background-color: #f5b93b !important;
        color: #071739 !important;
    }
    .border-brand-dark {
        border-color: #071739 !important;
    }
    .border-brand-gold {
        border-color: #f5b93b !important;
    }
    .btn-brand-outline {
        color: #071739 !important;
        border: 2px solid #071739 !important;
        font-weight: 700;
        border-radius: 12px;
        transition: all 0.2s ease-in-out;
        background: transparent;
    }
    .btn-brand-outline:hover {
        background-color: #071739 !important;
        color: white !important;
    }
    .btn-brand-solid {
        background-color: #f5b93b !important;
        color: #071739 !important;
        border: none !important;
        font-weight: 800;
        border-radius: 12px;
        transition: all 0.2s ease-in-out;
    }
    .btn-brand-solid:hover {
        background-color: #e0a320 !important;
        color: #071739 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(245, 185, 59, 0.3);
    }
    .card-hover-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(7, 23, 57, 0.1) !important;
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-brand-dark">Program Bimbingan Pilar Abdi</h1>
        <p class="lead text-muted">Pilih paket yang paling cocok untuk persiapan Sekolah Kedinasan kamu</p>
    </div>

    <div class="row g-4 justify-content-center align-items-stretch">

        <!-- Paket 1: Dasar (3 Bulan) -->
        <div class="col-lg-4 col-md-6 d-flex">
            <div class="card w-100 shadow-sm border-0 card-hover-effect" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header bg-brand-dark text-center py-4">
                    <p class="mb-0 small text-white-50 text-uppercase fw-bold" style="letter-spacing: 1px;">3 Bulan</p>
                    <h5 class="mb-0 fw-bold">Paket Dasar</h5>
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-between p-4">
                    <div>
                        <h2 class="text-brand-dark fw-bold mb-1">Rp 890.000</h2>
                        <p class="text-muted small">≈ Rp 297.000 / bulan</p>
                        <span class="badge bg-success bg-opacity-10 text-success mb-4 px-3 py-2" style="border-radius: 20px;">Terjangkau</span>

                        <ul class="list-unstyled text-start">
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> TIU + TWK + TKP — materi lengkap + latihan soal</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 8x Pertemuan Live (2x/bulan), rekaman tersedia</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 3x Try Out simulasi SKD</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Rekap materi PDF mingguan</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Akses materi selama 3 bulan</li>
                        </ul>
                    </div>
                    <div class="pt-4 mt-auto">
                        <a href="{{ url('/pendaftaran') }}?paket=reguler" class="btn btn-brand-outline w-100 py-3">Pilih Paket Dasar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paket 2: Intensif 6 Bulan (Paling Dipilih) -->
        <div class="col-lg-4 col-md-6 d-flex">
            <div class="card w-100 shadow border-brand-gold card-hover-effect" style="border-radius: 16px; overflow: hidden; border-width: 2.5px; z-index: 10;">
                <div class="card-header bg-brand-dark text-center py-4">
                    <p class="mb-0 small text-white-50 text-uppercase fw-bold" style="letter-spacing: 1px;">6 Bulan</p>
                    <h5 class="mb-0 fw-bold">Paket Intensif</h5>
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-between p-4">
                    <div>
                        <h2 class="text-brand-dark fw-bold mb-1">Rp 1.650.000</h2>
                        <p class="text-muted small">≈ Rp 275.000 / bulan</p>
                        <span class="badge bg-warning bg-opacity-10 text-warning-emphasis mb-4 px-3 py-2" style="border-radius: 20px;">Nilai terbaik per bulan</span>

                        <ul class="list-unstyled text-start">
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Semua materi Dasar + video rekaman HD</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 16x Pertemuan Live (2x/bulan + 4x sesi bonus)</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 6x Try Out — setiap bulan sekali</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 2x Konsultasi Pribadi (1-on-1, 30 mnt)</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Simulasi Ujian CAT SKD Nasional</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Akses materi selama 6 bulan</li>
                        </ul>
                    </div>
                    <div class="pt-4 mt-auto">
                        <a href="{{ url('/pendaftaran') }}?paket=intensif" class="btn btn-brand-solid w-100 py-3">Pilih Paket Intensif</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paket 3: Pro (12 Bulan) -->
        <div class="col-lg-4 col-md-6 d-flex">
            <div class="card w-100 shadow-sm border-0 card-hover-effect" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header bg-brand-dark text-center py-4">
                    <p class="mb-0 small text-white-50 text-uppercase fw-bold" style="letter-spacing: 1px;">12 Bulan</p>
                    <h5 class="mb-0 fw-bold">Paket Pro</h5>
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-between p-4">
                    <div>
                        <h2 class="text-brand-dark fw-bold mb-1">Rp 2.750.000</h2>
                        <p class="text-muted small">≈ Rp 229.000 / bulan</p>
                        <span class="badge bg-success bg-opacity-10 text-success mb-4 px-3 py-2" style="border-radius: 20px;">Paling hemat per bulan</span>

                        <ul class="list-unstyled text-start">
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Semua fitur Intensif</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 36x Pertemuan Live (3x/bulan)</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Try Out setiap 3 minggu (~17x setahun)</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 5x Konsultasi Pribadi + prioritas jadwal</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Analisis hasil TO + laporan progres bulanan</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Sertifikat Kelulusan Resmi (CAT SKD)</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Akses materi selama 12 bulan</li>
                        </ul>
                    </div>
                    <div class="pt-4 mt-auto">
                        <a href="{{ url('/pendaftaran') }}?paket=tahunan" class="btn btn-brand-outline w-100 py-3">Pilih Paket Pro</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="text-center mt-5">
        <p class="text-muted small">
            <i class="bi bi-shield-check text-brand-gold"></i> Harga sudah termasuk semua materi & fasilitas resmi Pilar Abdi.
        </p>
    </div>
</div>
@endsection
