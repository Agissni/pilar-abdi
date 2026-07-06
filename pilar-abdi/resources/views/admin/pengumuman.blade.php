@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')
@section('page-title', 'Kelola Pengumuman')

@section('content')

{{-- ===== NOTIFIKASI SUKSES ===== --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius:12px;">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius:12px;">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Gagal menyimpan data:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- ===== STATS ROW ===== --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4">
        <div class="stat-card navy">
            <div class="stat-icon-wrap navy">
                <i class="bi bi-megaphone-fill"></i>
            </div>
            <div class="stat-number">{{ count($pengumuman) }}</div>
            <div class="stat-label">Total Pengumuman</div>
        </div>
    </div>

    <div class="col-6 col-md-4">
        <div class="stat-card green">
            <div class="stat-icon-wrap green">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="stat-number">{{ $pengumuman->where('status', 'aktif')->count() }}</div>
            <div class="stat-label">Pengumuman Aktif</div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="stat-card gold">
            <div class="stat-icon-wrap gold">
                <i class="bi bi-dash-circle-fill"></i>
            </div>
            <div class="stat-number">{{ $pengumuman->where('status', 'nonaktif')->count() }}</div>
            <div class="stat-label">Pengumuman Nonaktif</div>
        </div>
    </div>
</div>

{{-- ===== HEADER ===== --}}
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1" style="color:#071739;">Daftar Pengumuman</h5>
        <p class="text-muted mb-0" style="font-size:13px;">Kelola informasi, jadwal, dan pengumuman untuk siswa bimbel</p>
    </div>
    <button class="btn fw-bold px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalTambahPengumuman"
            style="background:linear-gradient(135deg,#071739,#0e2554);color:white;border-radius:10px;border:none;">
        <i class="bi bi-plus-lg me-2"></i>Tambah Pengumuman
    </button>
</div>

<div class="row g-4">
    {{-- ===== TABLE PENGUMUMAN ===== --}}
    <div class="col-12">
        <div class="content-card">
            <div class="content-card-header">
                <div class="content-card-title">
                    <i class="bi bi-megaphone-fill text-primary"></i> Data Pengumuman
                </div>
            </div>
            <div class="content-card-body p-3">
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Judul Pengumuman</th>
                                <th>Isi Pengumuman</th>
                                <th style="width: 180px;">Tanggal Publikasi</th>
                                <th style="width: 130px;">Status</th>
                                <th class="text-center" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pengumuman->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-megaphone" style="font-size: 48px; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0 fw-semibold">Belum ada pengumuman.</p>
                                        <p class="text-muted small">Klik tombol "Tambah Pengumuman" untuk membuat baru.</p>
                                    </td>
                                </tr>
                            @else
                                @foreach($pengumuman as $index => $item)
                                    <tr>
                                        <td class="text-center" style="color:#94a3b8;font-size:13px;">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold" style="color:#071739;">{{ $item->judul }}</div>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 350px; font-size:13px;">
                                                {{ strip_tags($item->isi) }}
                                            </div>
                                        </td>
                                        <td style="font-size:13px; font-weight: 500;">
                                            <i class="bi bi-calendar3 me-1 text-primary"></i>{{ $item->tanggal_publikasi->format('d M Y, H:i') }}
                                        </td>
                                        <td>
                                            @if($item->status === 'aktif')
                                                <span class="status-badge active"><i class="bi bi-check-circle-fill me-1"></i> Aktif</span>
                                            @else
                                                <span class="status-badge" style="background:#e2e8f0;color:#64748b;"><i class="bi bi-dash-circle-fill me-1"></i> Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn btn-sm text-white" style="background:#071739;border:none;border-radius:8px;" 
                                                        onclick="showDetail({{ $item->id }})" title="Detail">
                                                    <i class="bi bi-eye-fill"></i> Detail
                                                </button>
                                                <button class="btn btn-sm" style="background:#fef3c7;color:#92400e;border:none;border-radius:8px;" 
                                                        onclick="editPengumuman({{ $item->id }})" title="Edit">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <button class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;border-radius:8px;" 
                                                        onclick="deletePengumuman({{ $item->id }}, '{{ addslashes($item->judul) }}')" title="Hapus">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
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
</div>

{{-- ===== MODAL TAMBAH PENGUMUMAN ===== --}}
<div class="modal fade" id="modalTambahPengumuman" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-file-earmark-plus-fill me-2 text-warning"></i>Tambah Pengumuman
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/admin/pengumuman" method="POST">
                @csrf
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Judul Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="Contoh: Jadwal Simulasi TO Akbar Gelombang II" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Tanggal Publikasi <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="tanggal_publikasi" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Isi Pengumuman <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control" rows="5" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="Tuliskan detail pengumuman yang ingin disampaikan disini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                            style="border-radius:10px;border-color:#e2e8f0;color:#64748b;font-size:14px;">Batal</button>
                    <button type="submit" class="btn fw-bold px-4 text-white"
                            style="background:linear-gradient(135deg,#071739,#0e2554);border-radius:10px;border:none;font-size:14px;">
                        <i class="bi bi-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL EDIT PENGUMUMAN ===== --}}
<div class="modal fade" id="modalEditPengumuman" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Pengumuman
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditPengumuman" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Judul Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" name="judul" id="edit_judul" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Tanggal Publikasi <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="tanggal_publikasi" id="edit_tanggal_publikasi" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Status <span class="text-danger">*</span></label>
                            <select name="status" id="edit_status" class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Isi Pengumuman <span class="text-danger">*</span></label>
                        <textarea name="isi" id="edit_isi" class="form-control" rows="5" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                            style="border-radius:10px;border-color:#e2e8f0;color:#64748b;font-size:14px;">Batal</button>
                    <button type="submit" class="btn fw-bold px-4 text-white"
                            style="background:linear-gradient(135deg,#071739,#0e2554);border-radius:10px;border:none;font-size:14px;">
                        <i class="bi bi-save me-2"></i>Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL DETAIL PENGUMUMAN ===== --}}
<div class="modal fade" id="modalDetailPengumuman" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-info-circle-fill me-2 text-primary"></i>Detail Pengumuman
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <div class="mb-3">
                    <label class="text-secondary small d-block">Judul Pengumuman</label>
                    <h5 class="fw-bold text-dark mb-0" id="detail_judul"></h5>
                </div>
                <div class="row g-3 mb-3 border-top border-bottom py-2 my-2">
                    <div class="col-6">
                        <label class="text-secondary small d-block">Tanggal Publikasi</label>
                        <p class="text-dark mb-0 fw-semibold" id="detail_tanggal_publikasi"></p>
                    </div>
                    <div class="col-6">
                        <label class="text-secondary small d-block">Status Tampil</label>
                        <div id="detail_status_badge"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="text-secondary small d-block">Isi Pengumuman</label>
                    <div class="p-3 bg-light rounded-3 text-dark fw-medium text-pre-wrap" id="detail_isi" style="white-space: pre-wrap; line-height: 1.6;"></div>
                </div>
            </div>
            <div class="modal-footer border-0 px-4 pb-4">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal"
                        style="border-radius:10px;font-size:14px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- ===== MODAL HAPUS PENGUMUMAN ===== --}}
<div class="modal fade" id="modalHapusPengumuman" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark"><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Hapus?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-3 text-center">
                <p class="mb-0 text-secondary">Apakah Anda yakin ingin menghapus pengumuman <strong id="hapus_judul"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center gap-3 pb-4">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius:10px;">Batal</button>
                <form id="formHapusPengumuman" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 text-white" style="border-radius:10px;">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // AJAX DETAIL FETCH
    function showDetail(id) {
        axios.get(`/admin/pengumuman/${id}`)
            .then(res => {
                const item = res.data.data;
                document.getElementById('detail_judul').textContent = item.judul;
                document.getElementById('detail_isi').textContent = item.isi;
                
                // Format dates
                const pubDate = new Date(item.tanggal_publikasi);
                document.getElementById('detail_tanggal_publikasi').textContent = pubDate.toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });

                // Badge status
                const badgeBox = document.getElementById('detail_status_badge');
                if (item.status === 'aktif') {
                    badgeBox.innerHTML = '<span class="badge bg-success px-3 py-2"><i class="bi bi-check-circle-fill me-1"></i> Aktif</span>';
                } else {
                    badgeBox.innerHTML = '<span class="badge bg-secondary px-3 py-2"><i class="bi bi-dash-circle-fill me-1"></i> Nonaktif</span>';
                }

                const modal = new bootstrap.Modal(document.getElementById('modalDetailPengumuman'));
                modal.show();
            })
            .catch(err => {
                alert('Gagal memuat detail pengumuman.');
                console.error(err);
            });
    }

    // POPULATE EDIT MODAL
    function editPengumuman(id) {
        axios.get(`/admin/pengumuman/${id}`)
            .then(res => {
                const item = res.data.data;
                
                // Set form action
                document.getElementById('formEditPengumuman').action = `/admin/pengumuman/${id}`;
                
                // Fill fields
                document.getElementById('edit_judul').value = item.judul;
                document.getElementById('edit_isi').value = item.isi;
                document.getElementById('edit_status').value = item.status;
                
                // Format date to YYYY-MM-DDTHH:MM
                const pubDateStr = item.tanggal_publikasi.substring(0, 16);
                document.getElementById('edit_tanggal_publikasi').value = pubDateStr;

                const modal = new bootstrap.Modal(document.getElementById('modalEditPengumuman'));
                modal.show();
            })
            .catch(err => {
                alert('Gagal memuat data pengumuman.');
                console.error(err);
            });
    }

    // TRIGGER DELETE CONFIRMATION
    function deletePengumuman(id, title) {
        document.getElementById('formHapusPengumuman').action = `/admin/pengumuman/${id}`;
        document.getElementById('hapus_judul').textContent = title;
        
        const modal = new bootstrap.Modal(document.getElementById('modalHapusPengumuman'));
        modal.show();
    }
</script>
@endsection
