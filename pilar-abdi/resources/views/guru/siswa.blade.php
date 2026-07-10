@extends('layouts.guru')
@section('title', 'Daftar Siswa')

@section('content')
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <h4 class="header-title">Daftar Siswa Bimbel</h4>
            <p class="header-subtitle mb-0">Lihat dan hubungi siswa-siswa aktif bimbingan belajar Pilar Abdi.</p>
        </div>
    </div>

    {{-- Search --}}
    <div class="content-card-custom mb-3">
        <div class="p-3 bg-white rounded-3">
            <form method="GET" action="/guru/siswa" class="d-flex gap-2">
                <input type="text" name="q" value="{{ $keyword ?? '' }}"
                       class="form-control" style="border-radius:10px;font-size:14px;border-color:#e2e8f0;"
                       placeholder="Cari nama, email, atau target sekolah...">
                <button type="submit" class="btn px-4 text-white"
                        style="background:var(--teal-dark);border-radius:10px;border:none;font-weight:600;white-space:nowrap;">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
                @if($keyword)
                    <a href="/guru/siswa" class="btn" style="border-radius:10px;border-color:#e2e8f0;color:#64748b; background:#f1f5f9;">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- Tabel Siswa --}}
    <div class="content-card-custom">
        <div class="card-header-custom">
            <i class="bi bi-people-fill text-primary"></i>
            <h6 class="card-title-custom">Data Siswa Aktif</h6>
        </div>
        <div>
            @if($siswa->isEmpty())
                <div class="text-center py-5 text-muted bg-white">
                    <i class="bi bi-people" style="font-size:48px;opacity:.2;"></i>
                    <p class="mt-3 mb-0 fw-bold">Tidak ada siswa ditemukan</p>
                </div>
            @else
                <div class="table-responsive bg-white">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 35%">Siswa</th>
                                <th style="width: 15%">WhatsApp</th>
                                <th style="width: 20%">Target Sekolah</th>
                                <th style="width: 15%">Paket</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa as $idx => $s)
                            <tr>
                                <td style="color:#94a3b8;font-size:13px;">{{ $siswa->firstItem() + $idx }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar" style="width:36px; height:36px; background:#e0f2fe; color:#0369a1; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700;">
                                            {{ strtoupper(substr($s->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold" style="color: var(--teal-dark); font-size:14px;">{{ $s->name }}</div>
                                            <div class="text-muted" style="font-size:11px;">{{ $s->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-size:13px;">{{ $s->whatsapp ?? '—' }}</td>
                                <td class="fw-semibold" style="font-size:13px; color:#0369a1;">
                                    <i class="bi bi-bank2 me-1 text-primary"></i>{{ $s->sekdin ?? '—' }}
                                </td>
                                <td>
                                    <span class="materi-badge" style="background:#fef3c7; color:#92400e;">{{ $s->package ?? '—' }}</span>
                                </td>
                                <td>
                                    @if($s->whatsapp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $s->whatsapp) }}" target="_blank" 
                                           class="btn btn-sm btn-success fw-bold d-inline-flex align-items-center gap-1"
                                           style="border-radius:8px; font-size:12px; padding:6px 12px;">
                                            <i class="bi bi-whatsapp"></i> Chat WA
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-light text-muted border-0" style="border-radius:8px; font-size:12px; padding:6px 12px;" disabled>
                                            No WA
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($siswa->hasPages())
                    <div class="px-4 py-3 border-top d-flex justify-content-between align-items-center bg-white rounded-bottom-4">
                        <div style="font-size:13px;color:#94a3b8;">
                            Menampilkan {{ $siswa->firstItem() }}–{{ $siswa->lastItem() }} dari {{ $siswa->total() }} siswa
                        </div>
                        {{ $siswa->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
