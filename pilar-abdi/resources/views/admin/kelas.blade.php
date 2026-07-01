@extends('layouts.admin')
@section('title', 'Kelola Kelas')
@section('page-title', 'Kelola Kelas')

@section('content')

{{-- Alert --}}
@if(session('success'))
<div class="alert border-0 mb-4 d-flex align-items-center gap-2"
     style="background:#d1fae5;color:#065f46;border-radius:12px;padding:14px 18px;">
    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
</div>
@endif

{{-- Header --}}
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1" style="color:#071739;">Data Kelas Bimbel</h5>
        <p class="text-muted mb-0" style="font-size:13px;">Total {{ $kelas->count() }} kelas aktif</p>
    </div>
    <button class="btn fw-bold px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalTambahKelas"
            style="background:linear-gradient(135deg,#071739,#0e2554);color:white;border-radius:10px;border:none;">
        <i class="bi bi-plus-lg me-2"></i>Tambah Kelas
    </button>
</div>

{{-- Tabel --}}
<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <i class="bi bi-journal-text"></i> Daftar Kelas
        </div>
    </div>
    <div class="content-card-body">
        @if($kelas->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-journal-x" style="font-size:48px;opacity:.2;"></i>
                <p class="mt-3 mb-1 fw-semibold">Belum ada kelas</p>
                <p class="mb-0" style="font-size:13px;">Klik "Tambah Kelas" untuk membuat kelas baru.</p>
            </div>
        @else
        <div class="table-responsive">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kelas</th>
                        <th>Materi</th>
                        <th>Guru Pengajar</th>
                        <th>Jadwal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kelas as $i => $k)
                    <tr>
                        <td style="color:#94a3b8;font-size:13px;">{{ $i + 1 }}</td>
                        <td>
                            <div class="user-name">{{ $k->nama_kelas }}</div>
                            @if($k->deskripsi)
                            <div class="user-email">{{ Str::limit($k->deskripsi, 40) }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge" style="background:#e0e7ff;color:#3730a3;">
                                {{ $k->materi }}
                            </span>
                        </td>
                        <td>
                            @if($k->guru)
                                <div class="user-cell">
                                    <div class="user-avatar-sm" style="background:linear-gradient(135deg,#38a169,#2f855a);width:28px;height:28px;font-size:11px;">
                                        {{ strtoupper(substr($k->guru->nama, 0, 1)) }}
                                    </div>
                                    <span style="font-size:13px;font-weight:600;">{{ $k->guru->nama }}</span>
                                </div>
                            @else
                                <span style="font-size:13px;color:#94a3b8;">— Belum ada</span>
                            @endif
                        </td>
                        <td style="font-size:13px;">
                            @if($k->hari && $k->jam)
                                <i class="bi bi-clock me-1" style="color:#f5b93b;"></i>{{ $k->hari }}, {{ $k->jam }}
                            @else
                                <span style="color:#94a3b8;">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm fw-semibold"
                                        style="background:#fef3c7;color:#92400e;border:none;border-radius:8px;padding:5px 12px;"
                                        onclick="editKelas({{ $k->id }}, '{{ addslashes($k->nama_kelas) }}', '{{ addslashes($k->materi) }}', '{{ $k->guru_id ?? '' }}', '{{ addslashes($k->hari ?? '') }}', '{{ addslashes($k->jam ?? '') }}', '{{ addslashes($k->deskripsi ?? '') }}')">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit
                                </button>
                                <button class="btn btn-sm fw-semibold"
                                        style="background:#fee2e2;color:#991b1b;border:none;border-radius:8px;padding:5px 12px;"
                                        onclick="hapusKelas({{ $k->id }}, '{{ addslashes($k->nama_kelas) }}')">
                                    <i class="bi bi-trash-fill me-1"></i>Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

{{-- ===== MODAL TAMBAH ===== --}}
<div class="modal fade" id="modalTambahKelas" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-journal-plus me-2" style="color:#f5b93b;"></i>Tambah Kelas Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/admin/kelas" method="POST">
                @csrf
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kelas" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="Contoh: Kelas TIU Intensif A" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Materi <span class="text-danger">*</span></label>
                            <select name="materi" class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                                <option value="">-- Pilih --</option>
                                <option value="TIU">TIU</option>
                                <option value="TWK">TWK</option>
                                <option value="TKP">TKP</option>
                                <option value="SKD">SKD (Paket)</option>
                                <option value="SKB">SKB</option>
                                <option value="Matematika">Matematika</option>
                                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                <option value="Psikotes">Psikotes</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Guru Pengajar</label>
                            <select name="guru_id" class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;">
                                <option value="">-- Pilih Guru --</option>
                                @foreach($gurus as $g)
                                <option value="{{ $g->id }}">{{ $g->nama }} ({{ $g->spesialisasi }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Hari</label>
                            <select name="hari" class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;">
                                <option value="">-- Pilih Hari --</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Jam</label>
                            <input type="text" name="jam" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="19.00 WIB">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="2" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="Keterangan tambahan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                            style="border-radius:10px;border-color:#e2e8f0;color:#64748b;font-size:14px;">Batal</button>
                    <button type="submit" class="btn fw-bold px-4"
                            style="background:linear-gradient(135deg,#071739,#0e2554);color:white;border-radius:10px;border:none;font-size:14px;">
                        <i class="bi bi-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL EDIT ===== --}}
<div class="modal fade" id="modalEditKelas" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-pencil-fill me-2" style="color:#f5b93b;"></i>Edit Data Kelas
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditKelas" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kelas" id="edit_nama_kelas" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Materi <span class="text-danger">*</span></label>
                            <select name="materi" id="edit_materi" class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                                <option value="TIU">TIU</option>
                                <option value="TWK">TWK</option>
                                <option value="TKP">TKP</option>
                                <option value="SKD">SKD (Paket)</option>
                                <option value="SKB">SKB</option>
                                <option value="Matematika">Matematika</option>
                                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                <option value="Psikotes">Psikotes</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Guru Pengajar</label>
                            <select name="guru_id" id="edit_guru_id" class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;">
                                <option value="">-- Pilih Guru --</option>
                                @foreach($gurus as $g)
                                <option value="{{ $g->id }}">{{ $g->nama }} ({{ $g->spesialisasi }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Hari</label>
                            <select name="hari" id="edit_hari" class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;">
                                <option value="">-- Pilih Hari --</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Jam</label>
                            <input type="text" name="jam" id="edit_jam" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Deskripsi</label>
                        <textarea name="deskripsi" id="edit_deskripsi" class="form-control" rows="2" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                            style="border-radius:10px;border-color:#e2e8f0;color:#64748b;font-size:14px;">Batal</button>
                    <button type="submit" class="btn fw-bold px-4"
                            style="background:linear-gradient(135deg,#f5b93b,#e09d1a);color:#071739;border-radius:10px;border:none;font-size:14px;">
                        <i class="bi bi-save me-2"></i>Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL HAPUS ===== --}}
<div class="modal fade" id="modalHapusKelas" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content" style="border-radius:16px;border:none;">
            <div class="modal-body text-center p-4">
                <div style="width:60px;height:60px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="bi bi-trash-fill" style="font-size:24px;color:#e53e3e;"></i>
                </div>
                <h6 class="fw-bold mb-2" style="color:#071739;">Hapus Kelas?</h6>
                <p class="text-muted mb-0" style="font-size:13px;">
                    Yakin ingin menghapus kelas <strong id="hapus_nama_kelas"></strong>?
                </p>
            </div>
            <div class="modal-footer border-0 px-4 pb-4 justify-content-center gap-2">
                <button type="button" class="btn px-4" data-bs-dismiss="modal"
                        style="border-radius:10px;border-color:#e2e8f0;color:#64748b;font-size:14px;">Batal</button>
                <form id="formHapusKelas" action="" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn px-4 fw-bold"
                            style="background:#e53e3e;color:white;border-radius:10px;border:none;font-size:14px;">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function editKelas(id, nama, materi, guruId, hari, jam, deskripsi) {
    document.getElementById('formEditKelas').action = '/admin/kelas/' + id;
    document.getElementById('edit_nama_kelas').value = nama;
    document.getElementById('edit_jam').value = jam;
    document.getElementById('edit_deskripsi').value = deskripsi;

    // Set materi
    const selMateri = document.getElementById('edit_materi');
    for (let opt of selMateri.options) { opt.selected = (opt.value === materi); }

    // Set guru
    const selGuru = document.getElementById('edit_guru_id');
    for (let opt of selGuru.options) { opt.selected = (opt.value == guruId); }

    // Set hari
    const selHari = document.getElementById('edit_hari');
    for (let opt of selHari.options) { opt.selected = (opt.value === hari); }

    new bootstrap.Modal(document.getElementById('modalEditKelas')).show();
}

function hapusKelas(id, nama) {
    document.getElementById('formHapusKelas').action = '/admin/kelas/' + id;
    document.getElementById('hapus_nama_kelas').textContent = nama;
    new bootstrap.Modal(document.getElementById('modalHapusKelas')).show();
}
</script>
@endsection