@extends('layouts.app')
@section('title', 'Kelas Saya')

@section('content')

<div class="container py-5">

    <h2 class="mb-4 fw-bold">
        Kelas Saya
    </h2>

    <div class="row">

        @if($kelas->isEmpty())
            <div class="col-12 text-center py-5 text-muted">
                <i class="bi bi-journal-x" style="font-size:48px; opacity:.3;"></i>
                <p class="mt-3 mb-0 fw-semibold">Belum ada kelas aktif saat ini.</p>
                <p class="text-muted" style="font-size:13px;">Silakan hubungi admin untuk informasi pendaftaran kelas.</p>
            </div>
        @else
            @foreach($kelas as $k)
                <div class="col-md-4 mb-4">
                    <div class="card shadow border-0 h-100 d-flex flex-column">
                        <div class="card-header text-white fw-bold d-flex justify-content-between align-items-center"
                             style="background:#071739; padding: 12px 20px;">
                            <span>{{ $k->materi }}</span>
                            <span class="badge bg-warning text-dark" style="font-size:10px;">{{ $k->materi }}</span>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="fw-bold mb-3" style="color:#071739; font-size:16px;">{{ $k->nama_kelas }}</h5>
                                <p class="mb-2" style="font-size:14px;">
                                    <strong>Guru:</strong><br>
                                    <span class="text-secondary">{{ $k->guru ? $k->guru->nama : '— Belum ditentukan' }}</span>
                                </p>
                                <p class="mb-3" style="font-size:14px;">
                                    <strong>Jadwal:</strong><br>
                                    <span class="text-secondary">
                                        @if($k->hari && $k->jam)
                                            {{ $k->hari }}, {{ $k->jam }}
                                        @else
                                            — Belum ada jadwal
                                        @endif
                                    </span>
                                </p>
                                @if($k->deskripsi)
                                    <p class="text-muted small mb-3" style="font-size:12px; line-height: 1.4;">
                                        {{ $k->deskripsi }}
                                    </p>
                                @endif
                            </div>
                            <div class="mt-auto pt-3">
                                @if($k->gmeet_link)
                                    <a href="{{ $k->gmeet_link }}" target="_blank" class="btn w-100 fw-bold py-2 text-white d-flex align-items-center justify-content-center gap-2" style="background:#065f46; border-radius: 8px; font-size:14px;">
                                        <i class="bi bi-camera-video-fill"></i> Masuk Kelas (GMeet)
                                    </a>
                                @else
                                    <button class="btn w-100 fw-bold py-2 d-flex align-items-center justify-content-center gap-2" style="background:#e2e8f0; color:#94a3b8; border-radius: 8px; font-size:14px; border: none;" disabled>
                                        <i class="bi bi-camera-video-off-fill"></i> Meet Belum Disiapkan
                                    </button>
                                @endif

                                @if($k->materi_pdf_path)
                                    <a href="{{ asset('storage/' . $k->materi_pdf_path) }}" target="_blank" class="btn btn-outline-warning w-100 fw-bold py-2 mt-2 d-flex align-items-center justify-content-center gap-2" style="border-radius: 8px; font-size:14px;">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger"></i> Unduh Materi PDF
                                    </a>
                                @endif

                                @if($k->link_rekaman)
                                    <a href="{{ $k->link_rekaman }}" target="_blank" class="btn btn-outline-info w-100 fw-bold py-2 mt-2 d-flex align-items-center justify-content-center gap-2" style="border-radius: 8px; font-size:14px;">
                                        <i class="bi bi-play-btn-fill"></i> Tonton Rekaman Kelas
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

</div>

@endsection
