@extends('layouts.admin')
@section('title', 'Kelola Guru')
@section('page-title', 'Kelola Guru')

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
        <h5 class="fw-bold mb-1" style="color:#071739;">Data Guru Pengajar</h5>
        <p class="text-muted mb-0" style="font-size:13px;">Total {{ $gurus->count() }} guru terdaftar</p>
    </div>
    <button class="btn fw-bold px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalTambahGuru"
            style="background:linear-gradient(135deg,#071739,#0e2554);color:white;border-radius:10px;border:none;">
        <i class="bi bi-plus-lg me-2"></i>Tambah Guru
    </button>
</div>

{{-- Tabel --}}
<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <i class="bi bi-person-badge-fill"></i> Daftar Guru
        </div>
    </div>
    <div class="content-card-body">
        @if($gurus->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-person-badge" style="font-size:48px;opacity:.2;"></i>
                <p class="mt-3 mb-1 fw-semibold">Belum ada guru</p>
                <p class="mb-0" style="font-size:13px;">Klik "Tambah Guru" untuk menambahkan pengajar baru.</p>
            </div>
        @else
        <div class="table-responsive">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Guru</th>
                        <th>Spesialisasi</th>
                        <th>Kontak</th>
                        <th>Jumlah Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gurus as $i => $guru)
                    <tr>
                        <td style="color:#94a3b8;font-size:13px;">{{ $i + 1 }}</td>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar-sm" style="background:linear-gradient(135deg,#38a169,#2f855a);">
                                    {{ strtoupper(substr($guru->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $guru->nama }}</div>
                                    @if($guru->email)
                                    <div class="user-email">{{ $guru->email }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge" style="background:#e0e7ff;color:#3730a3;">
                                {{ $guru->spesialisasi }}
                            </span>
                        </td>
                        <td style="font-size:13px;">{{ $guru->whatsapp ?? '—' }}</td>
                        <td>
                            <span class="fw-bold" style="color:#071739;">{{ $guru->kelas_count }}</span>
                            <span style="font-size:12px;color:#94a3b8;"> kelas</span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                {{-- Tombol Edit --}}
                                <button class="btn btn-sm fw-semibold"
                                        style="background:#fef3c7;color:#92400e;border:none;border-radius:8px;padding:5px 12px;"
                                        onclick="editGuru({{ $guru->id }}, '{{ addslashes($guru->nama) }}', '{{ addslashes($guru->spesialisasi) }}', '{{ addslashes($guru->whatsapp ?? '') }}', '{{ addslashes($guru->email ?? '') }}', '{{ addslashes($guru->bio ?? '') }}')">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit
                                </button>
                                {{-- Tombol Hapus --}}
                                <button class="btn btn-sm fw-semibold"
                                        style="background:#fee2e2;color:#991b1b;border:none;border-radius:8px;padding:5px 12px;"
                                        onclick="hapusGuru({{ $guru->id }}, '{{ addslashes($guru->nama) }}')">
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
<div class="modal fade" id="modalTambahGuru" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-person-plus-fill me-2" style="color:#f5b93b;"></i>Tambah Guru Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/admin/guru" method="POST">
                @csrf
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="Contoh: Andi Saputra, S.Pd" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Spesialisasi / Mata Pelajaran <span class="text-danger">*</span></label>
                        <select name="spesialisasi" class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                            <option value="">-- Pilih Spesialisasi --</option>
                            <option value="TIU">TIU (Tes Intelegensia Umum)</option>
                            <option value="TWK">TWK (Tes Wawasan Kebangsaan)</option>
                            <option value="TKP">TKP (Tes Karakteristik Pribadi)</option>
                            <option value="SKD">SKD (Seleksi Kompetensi Dasar)</option>
                            <option value="SKB">SKB (Seleksi Kompetensi Bidang)</option>
                            <option value="Matematika">Matematika</option>
                            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                            <option value="Bahasa Inggris">Bahasa Inggris</option>
                            <option value="Psikotes">Psikotes</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">No. WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="0812xxxxxxxx">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="guru@email.com" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Biografi Singkat</label>
                        <textarea name="bio" class="form-control" rows="3" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="Ceritakan pengalaman & keahlian guru..."></textarea>
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
<div class="modal fade" id="modalEditGuru" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-pencil-fill me-2" style="color:#f5b93b;"></i>Edit Data Guru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditGuru" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Spesialisasi <span class="text-danger">*</span></label>
                        <select name="spesialisasi" id="edit_spesialisasi" class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                            <option value="TIU">TIU</option>
                            <option value="TWK">TWK</option>
                            <option value="TKP">TKP</option>
                            <option value="SKD">SKD</option>
                            <option value="SKB">SKB</option>
                            <option value="Matematika">Matematika</option>
                            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                            <option value="Bahasa Inggris">Bahasa Inggris</option>
                            <option value="Psikotes">Psikotes</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">No. WhatsApp</label>
                            <input type="text" name="whatsapp" id="edit_whatsapp" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="edit_email" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Password Baru <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                        <input type="password" name="password" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="Masukkan password baru jika ingin mengubah">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Biografi Singkat</label>
                        <textarea name="bio" id="edit_bio" class="form-control" rows="3" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;"></textarea>
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
<div class="modal fade" id="modalHapusGuru" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content" style="border-radius:16px;border:none;">
            <div class="modal-body text-center p-4">
                <div style="width:60px;height:60px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="bi bi-trash-fill" style="font-size:24px;color:#e53e3e;"></i>
                </div>
                <h6 class="fw-bold mb-2" style="color:#071739;">Hapus Guru?</h6>
                <p class="text-muted mb-0" style="font-size:13px;">
                    Yakin ingin menghapus <strong id="hapus_nama_guru"></strong>? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer border-0 px-4 pb-4 justify-content-center gap-2">
                <button type="button" class="btn px-4" data-bs-dismiss="modal"
                        style="border-radius:10px;border-color:#e2e8f0;color:#64748b;font-size:14px;">Batal</button>
                <form id="formHapusGuru" action="" method="POST" style="display:inline;">
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
function editGuru(id, nama, spesialisasi, whatsapp, email, bio) {
    document.getElementById('formEditGuru').action = '/admin/guru/' + id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_whatsapp').value = whatsapp;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_bio').value = bio;
    // Set select
    const sel = document.getElementById('edit_spesialisasi');
    for (let opt of sel.options) {
        opt.selected = (opt.value === spesialisasi);
    }
    new bootstrap.Modal(document.getElementById('modalEditGuru')).show();
}

function hapusGuru(id, nama) {
    document.getElementById('formHapusGuru').action = '/admin/guru/' + id;
    document.getElementById('hapus_nama_guru').textContent = nama;
    new bootstrap.Modal(document.getElementById('modalHapusGuru')).show();
}
</script>
@endsection