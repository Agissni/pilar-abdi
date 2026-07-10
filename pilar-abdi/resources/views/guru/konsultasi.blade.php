@extends('layouts.guru')
@section('title', 'Kelola Konsultasi 1-on-1')

@section('content')

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h4 class="header-title">Konsultasi 1-on-1 Siswa</h4>
            <p class="header-subtitle mb-0">Kelola dan konfirmasi pengajuan jadwal konsultasi privat dari siswa bimbingan Anda.</p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert border-0 mt-4 d-flex align-items-center gap-2"
             style="background:#d1fae5;color:#065f46;border-radius:12px;padding:14px 18px;">
             <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Statistics Row --}}
    <div class="row g-3 mt-3">
        <div class="col-6 col-md-4">
            <div class="stat-card-custom teal">
                <div class="stat-icon teal">
                    <i class="bi bi-chat-left-dots-fill"></i>
                </div>
                <div class="stat-num">{{ $bimbingan->count() }}</div>
                <div class="stat-text">Total Pengajuan</div>
            </div>
        </div>

        <div class="col-6 col-md-4">
            <div class="stat-card-custom gold">
                <div class="stat-icon gold">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div class="stat-num">{{ $bimbingan->where('status', 'pending')->count() }}</div>
                <div class="stat-text">Menunggu Konfirmasi</div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card-custom dark">
                <div class="stat-icon dark">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="stat-num">{{ $bimbingan->where('status', 'disetujui')->count() }}</div>
                <div class="stat-text">Jadwal Disetujui</div>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="content-card-custom mt-4">
        <div class="card-header-custom">
            <i class="bi bi-clock-history text-primary"></i>
            <h6 class="card-title-custom">Daftar Pengajuan Bimbingan</h6>
        </div>
        <div>
            @if($bimbingan->isEmpty())
                <div class="text-center py-5 text-muted bg-white">
                    <i class="bi bi-chat-left-x" style="font-size: 48px; opacity: 0.3;"></i>
                    <p class="mt-3 mb-1 fw-bold">Belum ada pengajuan bimbingan</p>
                    <p class="mb-0 text-muted" style="font-size: 13px;">Siswa Anda belum mengajukan jadwal bimbingan privat 1-on-1.</p>
                </div>
            @else
                <div class="table-responsive bg-white">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 25%">Nama Siswa</th>
                                <th style="width: 20%">Jadwal Diajukan</th>
                                <th style="width: 25%">Topik Pembahasan</th>
                                <th style="width: 10%" class="text-center">Status</th>
                                <th style="width: 15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bimbingan as $idx => $item)
                                <tr>
                                    <td style="color:#94a3b8;font-size:13px;">{{ $idx + 1 }}</td>
                                    <td>
                                        <div class="fw-bold" style="color: var(--teal-dark);">{{ $item->siswa->name ?? '—' }}</div>
                                        <small class="text-muted" style="font-size: 11px;">
                                            <i class="bi bi-bank me-1"></i>Target: {{ strtoupper($item->siswa->sekdin ?? 'Lainnya') }}
                                        </small>
                                    </td>
                                    <td class="fw-semibold" style="font-size: 13px;">
                                        <i class="bi bi-calendar-event me-1 text-primary"></i>{{ $item->tgl_konsultasi ? $item->tgl_konsultasi->format('d M Y') : '—' }}
                                        <br>
                                        <small class="text-muted"><i class="bi bi-clock me-1 text-warning"></i>{{ $item->jam_konsultasi ? substr($item->jam_konsultasi, 0, 5) . ' WIB' : '—' }}</small>
                                    </td>
                                    <td>
                                        <div style="font-size: 13px; line-height: 1.4; max-width: 300px; word-wrap: break-word; white-space: normal;">
                                            {{ $item->topik }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($item->status === 'pending')
                                            <span class="badge bg-warning text-dark px-3 py-2" style="border-radius: 12px; font-size: 11px;">Pending</span>
                                        @elseif($item->status === 'disetujui')
                                            <span class="badge bg-success text-white px-3 py-2" style="border-radius: 12px; font-size: 11px;">Disetujui</span>
                                        @elseif($item->status === 'selesai')
                                            <span class="badge bg-secondary text-white px-3 py-2" style="border-radius: 12px; font-size: 11px;">Selesai</span>
                                        @else
                                            <span class="badge bg-danger text-white px-3 py-2" style="border-radius: 12px; font-size: 11px;">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->status === 'pending')
                                            <div class="d-flex justify-content-center gap-2">
                                                <form action="/guru/konsultasi/{{ $item->id_bimbingan_privat }}/approve" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success fw-bold d-inline-flex align-items-center gap-1" style="border-radius:8px; padding: 6px 12px; font-size: 12px;"
                                                            data-confirm="Apakah Anda yakin ingin menyetujui jadwal konsultasi privat ini?"
                                                            data-confirm-title="Setujui Konsultasi"
                                                            data-confirm-button="Ya, Setuju"
                                                            data-confirm-color="#10b981"
                                                            data-confirm-type="question">
                                                        <i class="bi bi-check-lg"></i> Setuju
                                                    </button>
                                                </form>
                                                <form action="/guru/konsultasi/{{ $item->id_bimbingan_privat }}/reject" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger fw-bold d-inline-flex align-items-center gap-1" style="border-radius:8px; padding: 6px 12px; font-size: 12px;"
                                                            data-confirm="Apakah Anda yakin ingin menolak/membatalkan jadwal konsultasi privat ini?"
                                                            data-confirm-title="Tolak Konsultasi"
                                                            data-confirm-button="Ya, Tolak"
                                                            data-confirm-color="#ef4444"
                                                            data-confirm-type="warning">
                                                        <i class="bi bi-x-lg"></i> Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif($item->status === 'disetujui' && $item->siswa && $item->siswa->whatsapp)
                                            @php
                                                $waPhone = $item->siswa->whatsapp;
                                                if (str_starts_with($waPhone, '0')) {
                                                    $waPhone = '62' . substr($waPhone, 1);
                                                }
                                                $waText = rawurlencode("Halo " . ($item->siswa->name) . ", saya Mentor " . ($guru->nama) . " ingin mengonfirmasi jadwal bimbingan privat 1-on-1 kita pada tanggal " . ($item->tgl_konsultasi ? $item->tgl_konsultasi->format('d M Y') : '') . " jam " . (substr($item->jam_konsultasi, 0, 5)) . " WIB.");
                                            @endphp
                                            <a href="https://wa.me/{{ $waPhone }}?text={{ $waText }}" target="_blank" class="btn btn-sm btn-success fw-bold d-inline-flex align-items-center gap-1" style="border-radius:8px; padding: 6px 12px; font-size: 12px; background-color: #25d366; border-color: #25d366;">
                                                <i class="bi bi-whatsapp"></i> Hubungi Siswa
                                            </a>
                                        @else
                                            <span class="text-muted small">Tidak ada aksi</span>
                                        @endif
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
