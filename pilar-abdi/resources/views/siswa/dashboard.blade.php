@extends('layouts.app')
@section('title', 'Dashboard Siswa')

@section('content')

<div class="container py-5">

    <!-- WELCOME BANNER -->
    <div class="card border-0 shadow-sm mb-4 p-4 text-white position-relative overflow-hidden" 
         style="background: linear-gradient(135deg, #071739 0%, #1e293b 100%); border-radius: 20px;">
        <div class="position-absolute top-0 end-0 p-3 opacity-10">
            <i class="bi bi-mortarboard-fill" style="font-size: 150px; transform: rotate(15deg); display: block;"></i>
        </div>
        <div class="row align-items-center position-relative">
            <div class="col-md-8">
                <span class="badge bg-warning text-dark mb-2 fw-semibold px-3 py-2" style="border-radius: 30px;">
                    <i class="bi bi-person-fill-check me-1"></i> Akun Aktif
                </span>
                <h2 class="fw-bold mb-1">Selamat Datang, {{ $user->name }}!</h2>
                <p class="text-white-50 mb-0">Persiapkan diri Anda untuk menembus sekolah kedinasan impian bersama Pilar Abdi.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <span class="text-white-50 d-block small">Target Anda</span>
                <h4 class="fw-bold text-warning mb-0">{{ $sekdin['name'] }}</h4>
            </div>
        </div>
    </div>

    <!-- QUICK MENUS (NAVIGASI) -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <a href="/kelas" class="text-decoration-none">
                <div class="card border-0 shadow-sm text-center p-3 h-100 btn-hover" style="border-radius: 16px; transition: transform 0.2s;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary mb-3" style="width: 50px; height: 50px; border-radius: 50%; margin: 0 auto;">
                        <i class="bi bi-camera-video-fill fs-4"></i>
                    </div>
                    <h6 class="fw-bold mb-1 text-dark">Kelas Saya</h6>
                    <small class="text-muted">Akses link belajar & PDF</small>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="/tryout" class="text-decoration-none">
                <div class="card border-0 shadow-sm text-center p-3 h-100 btn-hover" style="border-radius: 16px; transition: transform 0.2s;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success mb-3" style="width: 50px; height: 50px; border-radius: 50%; margin: 0 auto;">
                        <i class="bi bi-file-earmark-ruled-fill fs-4"></i>
                    </div>
                    <h6 class="fw-bold mb-1 text-dark">Tryout Online</h6>
                    <small class="text-muted">Simulasi CAT SKD</small>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="/dashboard" class="text-decoration-none">
                <div class="card border-0 shadow-sm text-center p-3 h-100 btn-hover" style="border-radius: 16px; transition: transform 0.2s;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-info bg-opacity-10 text-info mb-3" style="width: 50px; height: 50px; border-radius: 50%; margin: 0 auto;">
                        <i class="bi bi-award-fill fs-4"></i>
                    </div>
                    <h6 class="fw-bold mb-1 text-dark">Hasil Tryout</h6>
                    <small class="text-muted">Statistik & perkembangan</small>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center p-3 h-100 btn-hover" 
                 style="border-radius: 16px; transition: transform 0.2s; cursor: pointer;"
                 data-bs-toggle="modal" data-bs-target="#modalProfilSaya">
                <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning mb-3" style="width: 50px; height: 50px; border-radius: 50%; margin: 0 auto;">
                    <i class="bi bi-person-bounding-box fs-4"></i>
                </div>
                <h6 class="fw-bold mb-1 text-dark">Profil Saya</h6>
                <small class="text-muted">Detail data registrasi</small>
            </div>
        </div>
    </div>

    <!-- MAIN DASHBOARD CONTENT -->
    <div class="row g-4">
        
        <!-- LEFT COLUMN (INFO SEKOLAH & ROADMAP) -->
        <div class="col-lg-8">
            
            <!-- TARGET SEKOLAH KEDINASAN & RINGKASAN -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-warning bg-opacity-10 text-warning p-2" style="border-radius: 12px;">
                            <i class="bi bi-bank2 fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Target Sekolah Kedinasan</h5>
                            <span class="small text-muted">{{ $sekdin['ministry'] }} &bull; {{ $sekdin['location'] }}</span>
                        </div>
                    </div>
                    <h4 class="fw-bold text-primary mb-2">{{ $sekdin['name'] }}</h4>
                    <p class="text-secondary mb-0" style="line-height: 1.6;">{{ $sekdin['description'] }}</p>
                </div>
            </div>

            <!-- MATERI YANG DIPELAJARI -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-book-half text-primary"></i> Materi yang Dipelajari
                    </h5>
                    <p class="text-muted small mb-4">Berikut adalah cakupan materi seleksi wajib berdasarkan ketentuan tahun ini:</p>
                    
                    <div class="row g-3">
                        @foreach($sekdin['materi'] as $index => $materiItem)
                            <div class="col-md-6">
                                <div class="d-flex align-items-start gap-2 p-2 bg-light rounded" style="min-height: 70px;">
                                    <div class="text-success mt-1">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="small text-secondary fw-medium">
                                        {{ $materiItem }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- ROADMAP BELAJAR -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-signpost-split-fill text-primary"></i> Roadmap Belajar
                    </h5>
                    
                    <div class="position-relative ps-4" style="border-left: 2px dashed #e2e8f0; margin-left: 10px;">
                        @foreach($sekdin['roadmap'] as $index => $step)
                            <div class="position-relative mb-4">
                                <!-- Marker -->
                                <div class="position-absolute" style="left: -32px; top: 2px;">
                                    @if($step['status'] === 'Selesai')
                                        <span class="badge bg-success rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 22px; height: 22px;">
                                            <i class="bi bi-check-lg" style="font-size: 10px;"></i>
                                        </span>
                                    @elseif($step['status'] === 'Sedang Berjalan')
                                        <span class="badge bg-warning rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; border: 3px solid #fff;">
                                            <span class="spinner-grow spinner-grow-sm text-dark" style="width: 8px; height: 8px; border-width: 0px;" role="status"></span>
                                        </span>
                                    @else
                                        <span class="badge bg-secondary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; border: 3px solid #fff;">
                                            <i class="bi bi-circle" style="font-size: 8px; color: transparent;"></i>
                                        </span>
                                    @endif
                                </div>

                                <div class="card border shadow-none" style="border-radius: 12px; background: #fff;">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-center mb-1 flex-wrap gap-2">
                                            <h6 class="fw-bold mb-0 text-dark">{{ $step['tahap'] }}</h6>
                                            <span class="badge {{ $step['status'] === 'Selesai' ? 'bg-success bg-opacity-10 text-success' : ($step['status'] === 'Sedang Berjalan' ? 'bg-warning bg-opacity-10 text-warning-emphasis' : 'bg-secondary bg-opacity-10 text-secondary') }} px-2 py-1" style="font-size: 11px;">
                                                {{ $step['status'] }}
                                            </span>
                                        </div>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar {{ $step['status'] === 'Selesai' ? 'bg-success' : ($step['status'] === 'Sedang Berjalan' ? 'bg-warning' : 'bg-secondary') }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $step['progress'] }}%" 
                                                 aria-valuenow="{{ $step['progress'] }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                            </div>
                                        </div>
                                        @if($step['status'] === 'Sedang Berjalan')
                                            <small class="text-muted d-block mt-2">Menyelesaikan materi ini akan meningkatkan kesiapan Anda sebesar 15%.</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN (PROGRESS & PENGUMUMAN) -->
        <div class="col-lg-4">
            
            <!-- PROGRESS BELAJAR -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-speedometer2 text-primary"></i> Progress Belajar
                    </h5>
                    
                    <!-- Overall Progress Circular / Text representation -->
                    <div class="text-center py-3">
                        <h1 class="fw-extrabold text-primary mb-1" style="font-size: 48px;">45%</h1>
                        <span class="text-muted small fw-semibold uppercase tracking-wider">Kesiapan Kelulusan</span>
                    </div>

                    <div class="progress mb-4" style="height: 12px; border-radius: 30px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                             role="progressbar" 
                             style="width: 45%" 
                             aria-valuenow="45" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                        </div>
                    </div>

                    <hr>

                    <!-- Breakdown Progress -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-secondary fw-medium">Pemahaman Teori SKD</span>
                            <span class="fw-bold">80%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-secondary fw-medium">Latihan Soal & CAT</span>
                            <span class="fw-bold">40%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-secondary fw-medium">Tryout Nasional</span>
                            <span class="fw-bold">20%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"></div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- PENGUMUMAN -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-bell-fill text-primary"></i> Pengumuman Terbaru
                    </h5>
                    
                    <div class="d-flex flex-column gap-3">
                        @if($announcements->isEmpty())
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-bell-slash text-secondary mb-2" style="font-size: 32px; opacity: 0.5;"></i>
                                <p class="mb-0 small fw-semibold">Belum ada pengumuman terbaru.</p>
                            </div>
                        @else
                            @foreach($announcements as $ann)
                                <div class="p-3 rounded border" style="background-color: #fafbfc;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="badge bg-warning bg-opacity-10 text-dark-emphasis small" style="font-size: 10px;">
                                            {{ $ann->tanggal_publikasi->format('d M Y, H:i') }}
                                        </span>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1" style="font-size: 13px;">{{ $ann->judul }}</h6>
                                    <p class="text-secondary mb-0 small" style="line-height: 1.4; white-space: pre-line;">{{ $ann->isi }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Hover effect style -->
<style>
    .btn-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>

@endsection
