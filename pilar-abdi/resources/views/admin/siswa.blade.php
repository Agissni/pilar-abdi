@extends('layouts.admin')

@section('title', 'Kelola Siswa')
@section('page-title', 'Kelola Siswa')

@section('content')

{{-- Header --}}
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1" style="color:#071739;">Daftar Siswa</h5>
        <p class="text-muted mb-0" style="font-size:13px;">
            Total {{ $siswa->total() }} siswa terdaftar
        </p>
    </div>
</div>

{{-- Alerts --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius:12px;">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius:12px;">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Search --}}
<div class="content-card mb-3">
    <div class="p-3">
        <form method="GET" action="/admin/siswa" class="d-flex gap-2">
            <input type="text" name="q" value="{{ $keyword ?? '' }}"
                   class="form-control" style="border-radius:10px;font-size:14px;border-color:#e2e8f0;"
                   placeholder="Cari nama, email, atau sekdin...">
            <button type="submit" class="btn px-4"
                    style="background:linear-gradient(135deg,#071739,#0e2554);color:white;border-radius:10px;border:none;font-weight:600;white-space:nowrap;">
                <i class="bi bi-search me-1"></i> Cari
            </button>
            @if($keyword)
                <a href="/admin/siswa" class="btn" style="border-radius:10px;border-color:#e2e8f0;color:#64748b;">
                    Reset
                </a>
            @endif
        </form>
    </div>
</div>

{{-- Tabel Siswa --}}
<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <i class="bi bi-people-fill"></i>
            Data Siswa
        </div>
    </div>
    <div class="content-card-body">
        @if($siswa->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-people" style="font-size:48px;opacity:.2;"></i>
                <p class="mt-3 mb-0">Tidak ada siswa ditemukan</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Siswa</th>
                            <th>WhatsApp</th>
                            <th>Sekdin Tujuan</th>
                            <th>Paket</th>
                            <th>Status</th>
                            <th>Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $idx => $s)
                        <tr>
                            <td style="color:#94a3b8;font-size:13px;">{{ $siswa->firstItem() + $idx }}</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        {{ strtoupper(substr($s->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="user-name">{{ $s->name }}</div>
                                        <div class="user-email">{{ $s->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:13px;">{{ $s->whatsapp ?? '—' }}</td>
                            <td style="font-size:13px;">{{ $s->sekdin ?? '—' }}</td>
                            <td style="font-size:13px;">{{ $s->package ?? '—' }}</td>
                            <td>
                                @if($s->status === 'active')
                                    <span class="status-badge active">
                                        <i class="bi bi-check-circle"></i> Aktif
                                    </span>
                                @elseif($s->status === 'pending')
                                    <span class="status-badge pending">
                                        <i class="bi bi-clock"></i> Pending
                                    </span>
                                @else
                                    <span class="status-badge ditolak">
                                        <i class="bi bi-dash-circle"></i> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td style="font-size:12px;color:#94a3b8;">
                                {{ $s->created_at ? $s->created_at->format('d/m/Y') : '—' }}
                            </td>
                            <td>
                                @if($s->status === 'active')
                                    <form action="/admin/siswa/{{ $s->id_user }}/toggle-status" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger fw-semibold"
                                                style="border-radius:8px; padding:5px 12px; font-size:12px; border:none;"
                                                data-confirm="Siswa tidak akan bisa mengakses kelas, materi, dan tryout."
                                                data-confirm-title="Nonaktifkan Siswa?"
                                                data-confirm-button="Ya, Nonaktifkan"
                                                data-confirm-color="#dc3545"
                                                data-confirm-type="warning">
                                            Nonaktifkan
                                        </button>
                                    </form>
                                @else
                                    <form action="/admin/siswa/{{ $s->id_user }}/toggle-status" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success fw-semibold"
                                                style="border-radius:8px; padding:5px 12px; font-size:12px; border:none;"
                                                data-confirm="Siswa akan mendapatkan akses penuh kembali ke semua materi dan tryout."
                                                data-confirm-title="Aktifkan Siswa?"
                                                data-confirm-button="Ya, Aktifkan"
                                                data-confirm-color="#198754"
                                                data-confirm-type="question">
                                            Aktifkan
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($siswa->hasPages())
                <div class="px-4 py-3 border-top d-flex justify-content-between align-items-center">
                    <div style="font-size:13px;color:#94a3b8;">
                        Menampilkan {{ $siswa->firstItem() }}–{{ $siswa->lastItem() }} dari {{ $siswa->total() }}
                    </div>
                    {{ $siswa->links('pagination::bootstrap-5') }}
                </div>
            @endif
        @endif
    </div>
</div>

@endsection