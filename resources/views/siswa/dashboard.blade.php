@extends('layouts.app')
@section('title', 'Dashboard Siswa')

@section('content')

<div class="container py-5">

    <!-- WELCOME BANNER -->
    <div class="card border-0 shadow-sm mb-4 p-4 text-white position-relative overflow-hidden" 
         style="background: linear-gradient(135deg, #071739 0%, #1e293b 100%); border-radius: 20px;">
        <div class="position-absolute top-0 end-0 p-3" style="opacity: 0.12; pointer-events: none;">
            <img src="{{ asset('assets/' . $sekdin['logo']) }}" alt="{{ $sekdin['name'] }}" style="width: 150px; height: 150px; object-fit: contain; transform: rotate(15deg); display: block;">
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
            <a href="/hasil-tryout" class="text-decoration-none">
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

            <!-- BIMBINGAN PRIVAT 1-ON-1 -->
            <div class="card border-0 shadow-sm mt-4" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-person-workspace text-primary"></i> Konsultasi Pribadi 1-on-1
                    </h5>
                    
                    {{-- Sisa Kuota Sesi --}}
                    <div class="card border-0 mb-4 p-3 d-flex flex-row align-items-center justify-content-between" 
                         style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-2 bg-success bg-opacity-10 text-success rounded-3">
                                <i class="bi bi-journal-check fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-success mb-1">Sisa Kuota Konsultasi Anda</h6>
                                <p class="text-secondary mb-0 small">Paket Anda: <strong class="text-dark">{{ $user->package ?? 'Regular' }}</strong></p>
                            </div>
                        </div>
                        <div class="text-end">
                            <h3 class="fw-bold text-success mb-0">{{ $sisaKuota }} <span class="fs-6 text-secondary fw-semibold">Sesi lagi</span></h3>
                        </div>
                    </div>

                    {{-- Form Booking Bimbingan --}}
                    @if($sisaKuota > 0)
                        <form action="/siswa/bimbingan/booking" method="POST" class="mb-4">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Pilih Mentor / Guru <span class="text-danger">*</span></label>
                                    <select name="id_guru" class="form-select" style="border-radius: 10px;" required>
                                        <option value="" disabled selected>— Pilih Mentor Anda —</option>
                                        @foreach($gurus as $g)
                                            <option value="{{ $g->id_guru }}">{{ $g->nama }} ({{ $g->spesialisasi }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-secondary small">Tanggal Konsultasi <span class="text-danger">*</span></label>
                                    <input type="date" name="tgl_konsultasi" class="form-control" style="border-radius: 10px;" min="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-secondary small">Jam Konsultasi <span class="text-danger">*</span></label>
                                    <input type="time" name="jam_konsultasi" class="form-control" style="border-radius: 10px;" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold text-secondary small">Topik / Materi yang Ingin Ditanyakan <span class="text-danger">*</span></label>
                                    <textarea name="topik" class="form-control" rows="3" style="border-radius: 10px;" placeholder="Tuliskan topik pembahasan atau pertanyaan spesifik yang ingin didiskusikan..." required></textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn text-white fw-bold px-4 py-2" 
                                            style="background: linear-gradient(135deg, #071739 0%, #0e2554 100%); border-radius: 10px; border: none;">
                                        <i class="bi bi-calendar-plus me-1"></i> Ajukan Jadwal Konsultasi
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="alert border-0 text-center py-4 mb-4" style="background: #fff5f5; color: #c53030; border-radius: 12px;">
                            <i class="bi bi-exclamation-octagon fs-2 mb-2"></i>
                            <h6 class="fw-bold mb-1">Pengajuan Bimbingan Dinonaktifkan</h6>
                            <p class="mb-0 small">Kuota sesi konsultasi privat Anda sudah habis atau tipe paket Anda saat ini tidak mendukung konsultasi privat 1-on-1.</p>
                        </div>
                    @endif

                    <hr class="my-4">

                    {{-- Riwayat Konsultasi --}}
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-clock-history me-1"></i> Riwayat Konsultasi Bimbingan</h6>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle" style="font-size: 13px;">
                            <thead class="table-light">
                                <tr>
                                    <th>Mentor / Guru</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Topik</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($riwayatBimbingan->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted fw-semibold">
                                            Belum ada pengajuan bimbingan privat yang terdaftar.
                                        </td>
                                    </tr>
                                @else
                                    @foreach($riwayatBimbingan as $rb)
                                        <tr>
                                            <td>
                                                <div class="fw-bold">{{ $rb->guru->nama ?? '—' }}</div>
                                                <small class="text-muted">{{ $rb->guru->spesialisasi ?? 'Mentor' }}</small>
                                            </td>
                                            <td>
                                                {{ $rb->tgl_konsultasi ? $rb->tgl_konsultasi->format('d M Y') : '—' }}
                                            </td>
                                            <td>
                                                {{ $rb->jam_konsultasi ? substr($rb->jam_konsultasi, 0, 5) . ' WIB' : '—' }}
                                            </td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 250px;" title="{{ $rb->topik }}">
                                                    {{ $rb->topik }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if($rb->status === 'pending')
                                                    <span class="badge bg-warning text-dark px-3 py-2" style="border-radius: 12px;">Pending</span>
                                                @elseif($rb->status === 'disetujui')
                                                    <span class="badge bg-success text-white px-3 py-2" style="border-radius: 12px;">Disetujui</span>
                                                    @if($rb->guru && $rb->guru->whatsapp)
                                                        @php
                                                            $waPhone = $rb->guru->whatsapp;
                                                            if (str_starts_with($waPhone, '0')) {
                                                                $waPhone = '62' . substr($waPhone, 1);
                                                            }
                                                            $waText = rawurlencode("Halo Kak " . ($rb->guru->nama) . ", saya " . ($user->name) . " ingin konfirmasi bimbingan privat 1-on-1 pada tanggal " . ($rb->tgl_konsultasi ? $rb->tgl_konsultasi->format('d M Y') : '') . " jam " . (substr($rb->jam_konsultasi, 0, 5)) . " WIB dengan topik: " . ($rb->topik));
                                                        @endphp
                                                        <div class="mt-1">
                                                            <a href="https://wa.me/{{ $waPhone }}?text={{ $waText }}" target="_blank" class="btn btn-sm btn-success fw-bold py-1 px-2 d-inline-flex align-items-center gap-1" style="font-size: 11px; background-color:#25d366; border-color:#25d366; border-radius: 8px;">
                                                                <i class="bi bi-whatsapp"></i> Chat Mentor
                                                            </a>
                                                        </div>
                                                    @endif
                                                @elseif($rb->status === 'selesai')
                                                    <span class="badge bg-secondary text-white px-3 py-2" style="border-radius: 12px;">Selesai</span>
                                                @else
                                                    <span class="badge bg-danger text-white px-3 py-2" style="border-radius: 12px;">Dibatalkan</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
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
