@extends('layouts.admin')

@section('title', 'Kelola Tryout')
@section('page-title', 'Kelola Tryout')

@section('content')

{{-- ===== STATS ROW ===== --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card navy">
            <div class="stat-icon-wrap navy">
                <i class="bi bi-file-earmark-text-fill"></i>
            </div>
            <div class="stat-number">3</div>
            <div class="stat-label">Total Paket Tryout</div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card green">
            <div class="stat-icon-wrap green">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-number">48</div>
            <div class="stat-label">Siswa Mengerjakan</div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card gold">
            <div class="stat-icon-wrap gold">
                <i class="bi bi-award-fill"></i>
            </div>
            <div class="stat-number">275</div>
            <div class="stat-label">Rata-rata Skor</div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card blue">
            <div class="stat-icon-wrap blue">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="stat-number">88%</div>
            <div class="stat-label">Tingkat Kelulusan</div>
        </div>
    </div>
</div>

{{-- ===== HEADER ===== --}}
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1" style="color:#071739;">Daftar Paket Tryout</h5>
        <p class="text-muted mb-0" style="font-size:13px;">Kelola materi dan paket ujian online siswa</p>
    </div>
    <button class="btn fw-bold px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalTambahTryout"
            style="background:linear-gradient(135deg,#071739,#0e2554);color:white;border-radius:10px;border:none;">
        <i class="bi bi-plus-lg me-2"></i>Tambah Paket
    </button>
</div>

<div class="row g-4">
    {{-- ===== TABLE PAKET TRYOUT ===== --}}
    <div class="col-12 col-xl-8">
        <div class="content-card h-100">
            <div class="content-card-header">
                <div class="content-card-title">
                    <i class="bi bi-journal-text"></i> Paket Aktif
                </div>
            </div>
            <div class="content-card-body p-3">
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Paket</th>
                                <th>Kategori</th>
                                <th>Jumlah Soal</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="color:#94a3b8;font-size:13px;">1</td>
                                <td>
                                    <div class="fw-bold" style="color:#071739;">Tryout TIU Intensif I</div>
                                    <small class="text-muted">Dibuat: 20 Juni 2026</small>
                                </td>
                                <td><span class="status-badge" style="background:#e0e7ff;color:#3730a3;">TIU</span></td>
                                <td style="font-size:13px;">35 Soal</td>
                                <td style="font-size:13px;"><i class="bi bi-clock me-1 text-warning"></i>90 Menit</td>
                                <td><span class="status-badge active"><i class="bi bi-check-circle"></i> Aktif</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm" style="background:#fef3c7;color:#92400e;border:none;border-radius:8px;" onclick="alert('Fitur edit simulasi diaktifkan!')">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        <button class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;border-radius:8px;" onclick="alert('Fitur hapus simulasi diaktifkan!')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="color:#94a3b8;font-size:13px;">2</td>
                                <td>
                                    <div class="fw-bold" style="color:#071739;">Simulasi TWK Akbar</div>
                                    <small class="text-muted">Dibuat: 22 Juni 2026</small>
                                </td>
                                <td><span class="status-badge" style="background:#fef3c7;color:#92400e;">TWK</span></td>
                                <td style="font-size:13px;">30 Soal</td>
                                <td style="font-size:13px;"><i class="bi bi-clock me-1 text-warning"></i>60 Menit</td>
                                <td><span class="status-badge active"><i class="bi bi-check-circle"></i> Aktif</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm" style="background:#fef3c7;color:#92400e;border:none;border-radius:8px;" onclick="alert('Fitur edit simulasi diaktifkan!')">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        <button class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;border-radius:8px;" onclick="alert('Fitur hapus simulasi diaktifkan!')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="color:#94a3b8;font-size:13px;">3</td>
                                <td>
                                    <div class="fw-bold" style="color:#071739;">Latihan TKP Mandiri</div>
                                    <small class="text-muted">Dibuat: 25 Juni 2026</small>
                                </td>
                                <td><span class="status-badge" style="background:#d1fae5;color:#065f46;">TKP</span></td>
                                <td style="font-size:13px;">45 Soal</td>
                                <td style="font-size:13px;"><i class="bi bi-clock me-1 text-warning"></i>100 Menit</td>
                                <td><span class="status-badge active"><i class="bi bi-check-circle"></i> Aktif</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm" style="background:#fef3c7;color:#92400e;border:none;border-radius:8px;" onclick="alert('Fitur edit simulasi diaktifkan!')">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        <button class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;border-radius:8px;" onclick="alert('Fitur hapus simulasi diaktifkan!')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== RIGHT COLUMN: LATEST RESULTS ===== --}}
    <div class="col-12 col-xl-4">
        <div class="content-card h-100">
            <div class="content-card-header">
                <div class="content-card-title">
                    <i class="bi bi-star-fill text-warning"></i> Nilai Ujian Terbaru
                </div>
            </div>
            <div class="content-card-body p-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <div class="user-avatar-sm" style="background: linear-gradient(135deg, #071739, #0e2554); width:32px; height:32px; font-size:12px;">
                                U
                            </div>
                            <div>
                                <div class="fw-semibold" style="font-size:13px; color:#071739;">udin</div>
                                <small class="text-muted" style="font-size:11px;">Tryout TIU Intensif I</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold" style="font-size:14px; color:#38a169;">255</div>
                            <small class="badge bg-success" style="font-size:9px;">Lulus</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <div class="user-avatar-sm" style="background: linear-gradient(135deg, #071739, #0e2554); width:32px; height:32px; font-size:12px;">
                                S
                            </div>
                            <div>
                                <div class="fw-semibold" style="font-size:13px; color:#071739;">Siswa Contoh</div>
                                <small class="text-muted" style="font-size:11px;">Simulasi TWK Akbar</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold" style="font-size:14px; color:#38a169;">280</div>
                            <small class="badge bg-success" style="font-size:9px;">Lulus</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="user-avatar-sm" style="background: linear-gradient(135deg, #071739, #0e2554); width:32px; height:32px; font-size:12px;">
                                A
                            </div>
                            <div>
                                <div class="fw-semibold" style="font-size:13px; color:#071739;">Andi</div>
                                <small class="text-muted" style="font-size:11px;">Latihan TKP Mandiri</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold" style="font-size:14px; color:#e53e3e;">140</div>
                            <small class="badge bg-danger" style="font-size:9px;">Gagal</small>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- ===== MODAL TAMBAH TRYOUT ===== --}}
<div class="modal fade" id="modalTambahTryout" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-file-earmark-plus-fill me-2" style="color:#f5b93b;"></i>Tambah Paket Tryout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form onsubmit="event.preventDefault(); alert('Sukses menambah paket tryout baru! (Simulasi)'); bootstrap.Modal.getInstance(document.getElementById('modalTambahTryout')).hide();">
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Nama Paket Tryout <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="Contoh: Tryout Akbar SKD 2026" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                                <option value="">-- Pilih --</option>
                                <option value="TIU">TIU (Tes Intelegensia Umum)</option>
                                <option value="TWK">TWK (Tes Wawasan Kebangsaan)</option>
                                <option value="TKP">TKP (Tes Karakteristik Pribadi)</option>
                                <option value="SKD">SKD (Paket Lengkap)</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Durasi (Menit) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="90" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Jumlah Soal <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="110" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Deskripsi</label>
                        <textarea class="form-control" rows="3" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="Keterangan tambahan untuk siswa..."></textarea>
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

@endsection
