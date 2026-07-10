@extends('layouts.guru')
@section('title', 'Kelola Soal Try Out')

@section('content')
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <h4 class="header-title">Kelola Soal Try Out</h4>
            <p class="header-subtitle mb-0">Pilih paket Try Out untuk mengelola soal berdasarkan spesialisasi Anda ({{ $guru->spesialisasi }}).</p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert border-0 mb-4 d-flex align-items-center gap-2"
             style="background:#d1fae5;color:#065f46;border-radius:12px;padding:14px 18px;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert border-0 mb-4 d-flex align-items-center gap-2"
             style="background:#fee2e2;color:#991b1b;border-radius:12px;padding:14px 18px;">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ $errors->first() }}
        </div>
    @endif

    {{-- Table Card --}}
    <div class="content-card-custom">
        <div class="card-header-custom">
            <i class="bi bi-journal-text text-primary"></i>
            <h6 class="card-title-custom">Daftar Paket Try Out</h6>
        </div>
        <div>
            @if($tryouts->isEmpty())
                <div class="text-center py-5 text-muted bg-white">
                    <i class="bi bi-journal-x" style="font-size: 48px; opacity: 0.3;"></i>
                    <p class="mt-3 mb-1 fw-bold">Belum ada paket Try Out</p>
                    <p class="mb-0 text-muted" style="font-size: 13px;">Silakan hubungi administrator untuk merilis paket Try Out baru.</p>
                </div>
            @else
                <div class="table-responsive bg-white">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 35%">Nama Paket</th>
                                <th style="width: 15%">Total Soal Ujian</th>
                                <th style="width: 15%">Durasi</th>
                                <th style="width: 15%">Status Paket</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tryouts as $idx => $to)
                                <tr>
                                    <td style="color:#94a3b8;font-size:13px;">{{ $idx + 1 }}</td>
                                    <td>
                                        <div class="fw-bold" style="color: var(--teal-dark);">{{ $to->nama_tryout }}</div>
                                        @if($to->deskripsi)
                                            <small class="text-muted" style="font-size: 11px;">{{ Str::limit($to->deskripsi, 60) }}</small>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $to->jumlah_soal }} Soal</td>
                                    <td>
                                        <i class="bi bi-clock me-1 text-warning"></i>{{ $to->durasi }} Menit
                                    </td>
                                    <td>
                                        @if($to->status === 'aktif')
                                            <span class="status-badge active"><i class="bi bi-check-circle-fill me-1"></i> Aktif</span>
                                        @elseif($to->status === 'belum_dimulai')
                                            <span class="status-badge pending"><i class="bi bi-hourglass-split me-1"></i> Belum Mulai</span>
                                        @else
                                            <span class="status-badge completed"><i class="bi bi-dash-circle-fill me-1"></i> Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/guru/tryout/{{ $to->id_tryout }}/soal" class="btn btn-sm btn-primary fw-semibold d-inline-flex align-items-center gap-1"
                                           style="border-radius:8px; padding:6px 12px; font-size:12px; background:var(--teal-light); border:none;">
                                            <i class="bi bi-patch-question-fill"></i> Kelola Soal ({{ $guru->spesialisasi }})
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
