@extends('layouts.app')
@section('title', 'Program & Paket')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary">Program Bimbingan Pilar Abdi</h1>
        <p class="lead text-muted">Pilih paket yang paling cocok untuk persiapan Sekolah Kedinasan kamu</p>
    </div>

    <div class="row g-4 justify-content-center">
        
        <!-- Paket 1: Reguler (3 Bulan) -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h5 class="mb-0">Paket Reguler</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="text-primary fw-bold">Rp 1.250.000</h2>
                    <p class="text-muted fs-5">3 Bulan</p>
                    
                    <ul class="list-unstyled mt-4 text-start">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> TIU + TWK + TKP</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 12x Pertemuan Live</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Materi lengkap + Bank Soal</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 4x Try Out</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Grup diskusi</li>
                    </ul>
                </div>
                <div class="card-footer bg-light border-0 pt-4">
                    <a href="#" class="btn btn-outline-primary w-100 py-3">Pilih Paket Reguler</a>
                </div>
            </div>
        </div>

        <!-- Paket 2: Intensif 6 Bulan (Rekomendasi) -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow border-primary position-relative" style="transform: scale(1.03);">
                <div class="badge bg-warning text-dark position-absolute top-0 start-50 translate-middle px-4 py-2 fs-6 fw-bold">
                    ⭐ REKOMENDASI
                </div>
                
                <div class="card-header bg-primary text-white text-center py-3">
                    <h5 class="mb-0">Paket Intensif</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="text-primary fw-bold">Rp 2.150.000</h2>
                    <p class="text-muted fs-5">6 Bulan</p>
                    
                    <ul class="list-unstyled mt-4 text-start">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Semua materi + Video rekaman</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 24x Pertemuan Live</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Try Out setiap 2 minggu</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 2x Sesi Konsultasi Pribadi (1-on-1)</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Grup eksklusif WhatsApp</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Simulasi SKD 2 kali</li>
                    </ul>
                </div>
                <div class="card-footer bg-light border-0 pt-4">
                    <a href="#" class="btn btn-primary w-100 py-3">Pilih Paket Intensif</a>
                </div>
            </div>
        </div>

        <!-- Paket 3: Tahunan (12 Bulan) -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h5 class="mb-0">Paket Tahunan</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="text-primary fw-bold">Rp 3.750.000</h2>
                    <p class="text-muted fs-5">12 Bulan</p>
                    
                    <ul class="list-unstyled mt-4 text-start">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Semua fitur Intensif</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Akses materi sampai lulus</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 48x Pertemuan Live</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Try Out setiap minggu</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> 4x Sesi Konsultasi Pribadi (1-on-1)</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Sertifikat & Rekomendasi</li>
                    </ul>
                </div>
                <div class="card-footer bg-light border-0 pt-4">
                    <a href="#" class="btn btn-outline-primary w-100 py-3">Pilih Paket Tahunan</a>
                </div>
            </div>
        </div>

    </div>

    <div class="text-center mt-5">
        <p class="text-muted small">
            <i class="bi bi-shield-check"></i> Harga sudah termasuk materi & fasilitas • Bisa dicicil untuk paket Intensif & Tahunan
        </p>
    </div>
</div>
@endsection