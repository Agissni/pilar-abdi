@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- ===== WELCOME HEADER ===== --}}
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h4 class="fw-bold mb-1" style="color:#071739;">
            Selamat datang, {{ $admin->name ?? 'Admin' }}! 👋
        </h4>
        <p class="text-muted mb-0" style="font-size:14px;">
            Berikut ringkasan aktivitas Pilar Abdi hari ini.
        </p>
    </div>
    <a href="/admin/pembayaran" class="btn btn-sm fw-bold px-4 py-2"
       style="background:linear-gradient(135deg,#f5b93b,#e09d1a);color:#071739;border-radius:10px;border:none;">
        <i class="bi bi-credit-card-2-front me-2"></i>Verifikasi Pembayaran
        @if($bayarPending > 0)
            <span class="badge ms-1" style="background:#071739;color:white;">{{ $bayarPending }}</span>
        @endif
    </a>
</div>

{{-- ===== STATS ROW 1: SISWA ===== --}}
<div class="row g-3 mb-3">

    <div class="col-6 col-md-3">
        <div class="stat-card navy">
            <div class="stat-icon-wrap navy">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-number">{{ $totalSiswa }}</div>
            <div class="stat-label">Total Siswa</div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card green">
            <div class="stat-icon-wrap green">
                <i class="bi bi-person-check-fill"></i>
            </div>
            <div class="stat-number">{{ $siswaAktif }}</div>
            <div class="stat-label">Siswa Aktif</div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card purple">
            <div class="stat-icon-wrap purple">
                <i class="bi bi-person-badge-fill"></i>
            </div>
            <div class="stat-number">{{ $totalGuru }}</div>
            <div class="stat-label">Total Guru</div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card blue">
            <div class="stat-icon-wrap blue">
                <i class="bi bi-journal-text"></i>
            </div>
            <div class="stat-number">{{ $totalKelas }}</div>
            <div class="stat-label">Total Kelas</div>
        </div>
    </div>

</div>

{{-- ===== STATS ROW 2: PEMBAYARAN ===== --}}
<div class="row g-3 mb-4">

    <div class="col-6 col-md-4">
        <div class="stat-card gold" style="padding:18px 20px;">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon-wrap gold" style="margin-bottom:0;width:42px;height:42px;">
                    <i class="bi bi-clock-fill"></i>
                </div>
                <div>
                    <div class="stat-number" style="font-size:26px;">{{ $bayarPending }}</div>
                    <div class="stat-label">Pembayaran Pending</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4">
        <div class="stat-card green" style="padding:18px 20px;">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon-wrap green" style="margin-bottom:0;width:42px;height:42px;">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <div class="stat-number" style="font-size:26px;">{{ $bayarLunas }}</div>
                    <div class="stat-label">Pembayaran Lunas</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4">
        <div class="stat-card red" style="padding:18px 20px;">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon-wrap red" style="margin-bottom:0;width:42px;height:42px;">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
                <div>
                    <div class="stat-number" style="font-size:26px;">{{ $bayarDitolak }}</div>
                    <div class="stat-label">Pembayaran Ditolak</div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ===== MAIN CONTENT ===== --}}
<div class="row g-4">

    {{-- ===== TABEL PEMBAYARAN TERBARU ===== --}}
    <div class="col-12 col-xl-7">
        <div class="content-card h-100">
            <div class="content-card-header">
                <div class="content-card-title">
                    <i class="bi bi-credit-card-2-front-fill"></i>
                    Pembayaran Terbaru
                </div>
                <a href="/admin/pembayaran" class="btn btn-sm"
                   style="background:#f0f4f8;color:#071739;font-size:12px;font-weight:600;border-radius:8px;border:none;">
                    Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="content-card-body">
                @if($recentPayments->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox" style="font-size:40px;opacity:.3;"></i>
                        <p class="mt-2 mb-0" style="font-size:14px;">Belum ada data pembayaran</p>
                    </div>
                @else
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Bank</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPayments as $pay)
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-sm">
                                            {{ strtoupper(substr(optional($pay->user)->name ?? '?', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="user-name">{{ optional($pay->user)->name ?? '—' }}</div>
                                            <div class="user-email">{{ optional($pay->user)->email ?? '—' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-size:13px;">{{ $pay->bank ?? '—' }}</td>
                                <td style="font-size:13px;font-weight:600;">
                                    @if($pay->amount)
                                        Rp {{ number_format($pay->amount, 0, ',', '.') }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>
                                    @if($pay->status === 'pending')
                                        <span class="status-badge pending">
                                            <i class="bi bi-clock"></i> Pending
                                        </span>
                                    @elseif($pay->status === 'lunas')
                                        <span class="status-badge lunas">
                                            <i class="bi bi-check-circle"></i> Lunas
                                        </span>
                                    @else
                                        <span class="status-badge ditolak">
                                            <i class="bi bi-x-circle"></i> Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/pembayaran" class="btn btn-sm"
                                       style="background:#f0f4f8;color:#071739;font-size:11px;border-radius:6px;border:none;padding:4px 10px;">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    {{-- ===== KOLOM KANAN ===== --}}
    <div class="col-12 col-xl-5 d-flex flex-column gap-4">

        {{-- CHART STATUS PEMBAYARAN --}}
        <div class="content-card">
            <div class="content-card-header">
                <div class="content-card-title">
                    <i class="bi bi-pie-chart-fill"></i>
                    Status Pembayaran
                </div>
            </div>
            <div class="p-4">
                @php
                    $total = max($totalPembayaran, 1);
                    $pPending  = round(($bayarPending  / $total) * 100);
                    $pLunas    = round(($bayarLunas    / $total) * 100);
                    $pDitolak  = round(($bayarDitolak  / $total) * 100);
                @endphp
                <div class="d-flex align-items-center gap-4">
                    <div class="donut-container flex-shrink-0">
                        <svg class="donut-svg" width="100" height="100" viewBox="0 0 36 36">
                            @php
                                $c = 2 * 3.14159 * 15.9155;
                                $dLunas    = $totalPembayaran > 0 ? ($bayarLunas    / $total) * $c : 0;
                                $dPending  = $totalPembayaran > 0 ? ($bayarPending  / $total) * $c : 0;
                                $dDitolak  = $totalPembayaran > 0 ? ($bayarDitolak  / $total) * $c : 0;
                                $offLunas   = 0;
                                $offPending = $dLunas;
                                $offDitolak = $dLunas + $dPending;
                            @endphp
                            <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#e2e8f0" stroke-width="3.5"/>
                            @if($dLunas > 0)
                            <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#38a169" stroke-width="3.5"
                                    stroke-dasharray="{{ $dLunas }} {{ $c - $dLunas }}"
                                    stroke-dashoffset="{{ -$offLunas }}"/>
                            @endif
                            @if($dPending > 0)
                            <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#f5b93b" stroke-width="3.5"
                                    stroke-dasharray="{{ $dPending }} {{ $c - $dPending }}"
                                    stroke-dashoffset="{{ -$offPending }}"/>
                            @endif
                            @if($dDitolak > 0)
                            <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#e53e3e" stroke-width="3.5"
                                    stroke-dasharray="{{ $dDitolak }} {{ $c - $dDitolak }}"
                                    stroke-dashoffset="{{ -$offDitolak }}"/>
                            @endif
                        </svg>
                        <div class="donut-text">
                            <span>{{ $totalPembayaran }}</span>
                            <small>Total</small>
                        </div>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div style="width:10px;height:10px;border-radius:50%;background:#38a169;flex-shrink:0;"></div>
                            <div style="font-size:13px;">Lunas</div>
                            <div class="ms-auto fw-bold" style="font-size:14px;">{{ $bayarLunas }}</div>
                            <div style="font-size:11px;color:#94a3b8;min-width:32px;text-align:right;">{{ $pLunas }}%</div>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div style="width:10px;height:10px;border-radius:50%;background:#f5b93b;flex-shrink:0;"></div>
                            <div style="font-size:13px;">Pending</div>
                            <div class="ms-auto fw-bold" style="font-size:14px;">{{ $bayarPending }}</div>
                            <div style="font-size:11px;color:#94a3b8;min-width:32px;text-align:right;">{{ $pPending }}%</div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:10px;height:10px;border-radius:50%;background:#e53e3e;flex-shrink:0;"></div>
                            <div style="font-size:13px;">Ditolak</div>
                            <div class="ms-auto fw-bold" style="font-size:14px;">{{ $bayarDitolak }}</div>
                            <div style="font-size:11px;color:#94a3b8;min-width:32px;text-align:right;">{{ $pDitolak }}%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SISWA TERBARU --}}
        <div class="content-card">
            <div class="content-card-header">
                <div class="content-card-title">
                    <i class="bi bi-person-plus-fill"></i>
                    Siswa Terbaru
                </div>
                <a href="/admin/siswa" class="btn btn-sm"
                   style="background:#f0f4f8;color:#071739;font-size:12px;font-weight:600;border-radius:8px;border:none;">
                    Semua <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="content-card-body">
                @if($recentSiswa->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-people" style="font-size:34px;opacity:.3;"></i>
                        <p class="mt-2 mb-0" style="font-size:13px;">Belum ada siswa terdaftar</p>
                    </div>
                @else
                    <table class="table admin-table">
                        <tbody>
                            @foreach($recentSiswa as $s)
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-sm">
                                            {{ strtoupper(substr($s->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="user-name">{{ $s->name }}</div>
                                            <div class="user-email">{{ $s->sekdin ?? 'Belum dipilih' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $s->status }}">
                                        {{ $s->status === 'active' ? 'Aktif' : 'Pending' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </div>
</div>

{{-- ===== QUICK ACCESS ===== --}}
<div class="mt-4">
    <h6 class="fw-bold mb-3" style="color:#071739;font-size:14px;letter-spacing:.3px;">
        <i class="bi bi-lightning-charge-fill text-warning me-2"></i>Akses Cepat
    </h6>
    <div class="row g-3">
        <div class="col-6 col-md-3">
            <a href="/admin/pembayaran" class="quick-card qc-gold">
                <div class="qc-icon gold"><i class="bi bi-credit-card-fill"></i></div>
                <div>
                    <div class="qc-label">Verifikasi Bayar</div>
                    <div class="qc-sub">{{ $bayarPending }} menunggu</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="/admin/siswa" class="quick-card qc-navy">
                <div class="qc-icon navy"><i class="bi bi-people-fill"></i></div>
                <div>
                    <div class="qc-label">Kelola Siswa</div>
                    <div class="qc-sub">{{ $totalSiswa }} siswa terdaftar</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="/admin/guru" class="quick-card qc-green">
                <div class="qc-icon green"><i class="bi bi-person-badge-fill"></i></div>
                <div>
                    <div class="qc-label">Kelola Guru</div>
                    <div class="qc-sub">Manajemen pengajar</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="/admin/kelas" class="quick-card qc-blue">
                <div class="qc-icon blue"><i class="bi bi-journal-text"></i></div>
                <div>
                    <div class="qc-label">Kelola Kelas</div>
                    <div class="qc-sub">Jadwal & materi</div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection