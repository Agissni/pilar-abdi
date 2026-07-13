@extends('layouts.app')
@section('title', 'Hasil & Statistik Tryout')

@section('content')

<div class="container py-5">
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold text-dark mb-1">Hasil & Statistik Tryout</h2>
            <p class="text-secondary mb-0">Pantau riwayat hasil simulasi CAT SKD dan perkembangan nilai Anda disini</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="/dashboard" class="btn btn-outline-dark fw-semibold px-4 py-2" style="border-radius:10px;">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    {{-- ===== STATISTIK OVERVIEW ===== --}}
    <div class="row g-3 mb-5">
        <div class="col-6 col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center h-100" style="border-radius: 18px; background: white;">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary mb-3 rounded-circle" style="width: 50px; height: 50px;">
                    <i class="bi bi-file-earmark-ruled-fill fs-4"></i>
                </div>
                <h4 class="fw-bold mb-1 text-dark">{{ $stats['total'] }}</h4>
                <small class="text-muted fw-medium">Total Ujian Diikuti</small>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center h-100" style="border-radius: 18px; background: white;">
                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success mb-3 rounded-circle" style="width: 50px; height: 50px;">
                    <i class="bi bi-patch-check-fill fs-4"></i>
                </div>
                <h4 class="fw-bold mb-1 text-success">{{ $stats['lulus'] }}</h4>
                <small class="text-muted fw-medium">Lulus Passing Grade</small>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center h-100" style="border-radius: 18px; background: white;">
                <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger mb-3 rounded-circle" style="width: 50px; height: 50px;">
                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                </div>
                <h4 class="fw-bold mb-1 text-danger">{{ $stats['tidak_lulus'] }}</h4>
                <small class="text-muted fw-medium">Belum Lulus Passing Grade</small>
            </div>
        </div>
    </div>

    {{-- ===== RIWAYAT TABEL ===== --}}
    <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
        <div class="card-header bg-white py-4 px-4 border-bottom-0 d-flex align-items-center gap-2">
            <i class="bi bi-clock-history text-primary fs-5"></i>
            <h5 class="fw-bold mb-0 text-dark">Riwayat Nilai Simulasi</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 14px;">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 50px;">No</th>
                            <th class="py-3">Nama Paket Ujian</th>
                            <th class="py-3 text-center" style="width: 90px;">Skor TWK</th>
                            <th class="py-3 text-center" style="width: 90px;">Skor TIU</th>
                            <th class="py-3 text-center" style="width: 90px;">Skor TKP</th>
                            <th class="py-3 text-center" style="width: 100px;">Total Skor</th>
                            <th class="py-3 text-center" style="width: 130px;">Status</th>
                            <th class="py-3 text-center" style="width: 150px;">Tanggal</th>
                            <th class="py-3 text-center" style="width: 220px;">Laporan & Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($attempts->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <div class="mb-3">
                                        <i class="bi bi-award" style="font-size: 48px; opacity: 0.3;"></i>
                                    </div>
                                    <h6 class="fw-bold text-secondary mb-1">Belum ada riwayat tryout.</h6>
                                    <p class="text-muted small mb-0">Kerjakan Tryout pertama Anda untuk melihat statistik nilai di halaman ini.</p>
                                    <a href="/tryout" class="btn btn-warning text-dark fw-bold px-4 py-2 mt-3" style="border-radius: 10px;">
                                        Mulai Tryout Sekarang
                                    </a>
                                </td>
                            </tr>
                        @else
                            @foreach($attempts as $index => $item)
                                <tr>
                                    <td class="text-center fw-semibold text-secondary py-3 px-4">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $item->tryout->nama_tryout ?? 'Try Out' }}</div>
                                        <small class="text-muted">{{ $item->tryout->deskripsi_singkat ?? 'Simulasi CAT' }}</small>
                                    </td>
                                    <td class="text-center fw-bold text-secondary">{{ $item->score_twk }}</td>
                                    <td class="text-center fw-bold text-secondary">{{ $item->score_tiu }}</td>
                                    <td class="text-center fw-bold text-secondary">{{ $item->score_tkp }}</td>
                                    <td class="text-center py-3">
                                        <span class="badge bg-dark px-3 py-2 fw-bold text-warning" style="font-size:13px; border-radius: 8px;">
                                            {{ $item->score_total }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($item->status === 'lulus')
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 fw-bold" style="border-radius: 20px; font-size:12px;">
                                                <i class="bi bi-patch-check-fill me-1"></i> LULUS PG
                                            </span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 fw-bold" style="border-radius: 20px; font-size:12px;">
                                                <i class="bi bi-exclamation-triangle-fill me-1"></i> TIDAK LULUS PG
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center text-muted fw-semibold">
                                        {{ $item->created_at->format('d M Y') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="/hasil-tryout/{{ $item->id_tryout_attempt }}/print" target="_blank" class="btn btn-sm btn-outline-dark fw-bold py-1 px-2 d-inline-flex align-items-center gap-1" style="border-radius: 8px; font-size: 11px;">
                                                <i class="bi bi-printer-fill"></i> Rapor
                                            </a>
                                            @if($item->status === 'lulus')
                                                <a href="/hasil-tryout/{{ $item->id_tryout_attempt }}/certificate" target="_blank" class="btn btn-sm btn-warning text-dark fw-bold py-1 px-2 d-inline-flex align-items-center gap-1" style="border-radius: 8px; font-size: 11px; background-color: #f5b93b; border-color: #f5b93b;">
                                                    <i class="bi bi-award-fill"></i> Sertifikat
                                                </a>
                                            @else
                                                <button class="btn btn-sm btn-light text-muted fw-bold py-1 px-2 d-inline-flex align-items-center gap-1" style="border-radius: 8px; font-size: 11px; border: 1px dashed #ccc; cursor: not-allowed;" disabled>
                                                    <i class="bi bi-lock-fill"></i> Sertifikat
                                                </button>
                                            @endif
                                        </div>
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

@endsection
