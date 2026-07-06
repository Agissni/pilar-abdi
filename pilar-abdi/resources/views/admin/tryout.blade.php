@extends('layouts.admin')

@section('title', 'Kelola Try Out')
@section('page-title', 'Kelola Try Out')

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
                <i class="bi bi-file-earmark-text-fill"></i>
            </div>
            <div class="stat-number">{{ count($tryouts) }}</div>
            <div class="stat-label">Total Paket Ujian</div>
        </div>
    </div>

    <div class="col-6 col-md-4">
        <div class="stat-card green">
            <div class="stat-icon-wrap green">
                <i class="bi bi-play-circle-fill"></i>
            </div>
            <div class="stat-number">{{ $tryouts->where('status', 'aktif')->count() }}</div>
            <div class="stat-label">Paket Aktif</div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="stat-card gold">
            <div class="stat-icon-wrap gold">
                <i class="bi bi-calendar-check-fill"></i>
            </div>
            <div class="stat-number">{{ $tryouts->where('status', 'selesai')->count() }}</div>
            <div class="stat-label">Paket Selesai / Ditutup</div>
        </div>
    </div>
</div>

{{-- ===== HEADER ===== --}}
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1" style="color:#071739;">Daftar Paket Ujian</h5>
        <p class="text-muted mb-0" style="font-size:13px;">Kelola jadwal dan paket ujian online yang dapat dikerjakan siswa</p>
    </div>
    <button class="btn fw-bold px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalTambahTryout"
            style="background:linear-gradient(135deg,#071739,#0e2554);color:white;border-radius:10px;border:none;">
        <i class="bi bi-plus-lg me-2"></i>Tambah Paket
    </button>
</div>

<div class="row g-4">
    {{-- ===== TABLE PAKET TRYOUT ===== --}}
    <div class="col-12">
        <div class="content-card">
            <div class="content-card-header">
                <div class="content-card-title">
                    <i class="bi bi-journal-text text-primary"></i> Daftar Try Out
                </div>
            </div>
            <div class="content-card-body p-3">
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Nama Paket</th>
                                <th>Jumlah Soal</th>
                                <th>Durasi</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($tryouts->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-journal-x" style="font-size: 48px; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0 fw-semibold">Belum ada paket Try Out.</p>
                                        <p class="text-muted small">Klik tombol "Tambah Paket" untuk membuat baru.</p>
                                    </td>
                                </tr>
                            @else
                                @foreach($tryouts as $index => $to)
                                    <tr>
                                        <td class="text-center" style="color:#94a3b8;font-size:13px;">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold" style="color:#071739;">{{ $to->nama_tryout }}</div>
                                            <small class="text-muted d-block text-truncate" style="max-width: 300px;">{{ $to->deskripsi ?? '— Tidak ada deskripsi' }}</small>
                                        </td>
                                        <td style="font-size:13px; font-weight: 500;">{{ $to->jumlah_soal }} Soal</td>
                                        <td style="font-size:13px; font-weight: 500;">
                                            <i class="bi bi-clock me-1 text-warning"></i>{{ $to->durasi }} Menit
                                        </td>
                                        <td style="font-size:12px;">
                                            <span class="d-block text-success"><strong>Mulai:</strong> {{ $to->tanggal_mulai->format('d M Y, H:i') }}</span>
                                            <span class="d-block text-danger"><strong>Selesai:</strong> {{ $to->tanggal_berakhir->format('d M Y, H:i') }}</span>
                                        </td>
                                        <td>
                                            @if($to->status === 'aktif')
                                                <span class="status-badge active"><i class="bi bi-check-circle-fill me-1"></i> Aktif</span>
                                            @elseif($to->status === 'belum_dimulai')
                                                <span class="status-badge" style="background:#fef3c7;color:#92400e;"><i class="bi bi-hourglass-split me-1"></i> Belum Mulai</span>
                                            @else
                                                <span class="status-badge" style="background:#e2e8f0;color:#64748b;"><i class="bi bi-dash-circle-fill me-1"></i> Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="/admin/tryout/{{ $to->id }}/soal" class="btn btn-sm text-white" 
                                                   style="background:#071739; border:none; border-radius:8px;" title="Kelola Soal">
                                                    <i class="bi bi-patch-question-fill"></i> Soal
                                                </a>
                                                <button class="btn btn-sm" style="background:#e0f2fe;color:#0369a1;border:none;border-radius:8px;" 
                                                        onclick="showDetail({{ $to->id }})" title="Detail">
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>
                                                <button class="btn btn-sm" style="background:#fef3c7;color:#92400e;border:none;border-radius:8px;" 
                                                        onclick="editTryout({{ $to->id }})" title="Edit">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <button class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;border-radius:8px;" 
                                                        onclick="deleteTryout({{ $to->id }}, '{{ addslashes($to->nama_tryout) }}')" title="Hapus">
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

{{-- ===== MODAL TAMBAH TRYOUT ===== --}}
<div class="modal fade" id="modalTambahTryout" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-file-earmark-plus-fill me-2 text-warning"></i>Tambah Paket Tryout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/admin/tryout" method="POST">
                @csrf
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Nama Paket Tryout <span class="text-danger">*</span></label>
                        <input type="text" name="nama_tryout" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="Contoh: Tryout Akbar SKD 2026" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Jumlah Soal <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah_soal" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="15" min="1" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Durasi (Menit) <span class="text-danger">*</span></label>
                            <input type="number" name="durasi" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="15" min="1" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="tanggal_mulai" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Tanggal Berakhir <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="tanggal_berakhir" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                            <option value="belum_dimulai">Belum Mulai</option>
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control" rows="3" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" placeholder="Keterangan tambahan untuk paket ujian ini..."></textarea>
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

{{-- ===== MODAL EDIT TRYOUT ===== --}}
<div class="modal fade" id="modalEditTryout" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Paket Tryout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditTryout" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Nama Paket Tryout <span class="text-danger">*</span></label>
                        <input type="text" name="nama_tryout" id="edit_nama_tryout" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Jumlah Soal <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah_soal" id="edit_jumlah_soal" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" min="1" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Durasi (Menit) <span class="text-danger">*</span></label>
                            <input type="number" name="durasi" id="edit_durasi" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" min="1" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="tanggal_mulai" id="edit_tanggal_mulai" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Tanggal Berakhir <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="tanggal_berakhir" id="edit_tanggal_berakhir" class="form-control" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Status <span class="text-danger">*</span></label>
                        <select name="status" id="edit_status" class="form-select" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;" required>
                            <option value="belum_dimulai">Belum Mulai</option>
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Deskripsi Singkat</label>
                        <textarea name="deskripsi" id="edit_deskripsi" class="form-control" rows="3" style="border-radius:10px;border-color:#e2e8f0;font-size:14px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                            style="border-radius:10px;border-color:#e2e8f0;color:#64748b;font-size:14px;">Batal</button>
                    <button type="submit" class="btn fw-bold px-4"
                            style="background:linear-gradient(135deg,#071739,#0e2554);color:white;border-radius:10px;border:none;font-size:14px;">
                        <i class="bi bi-save me-2"></i>Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL DETAIL TRYOUT ===== --}}
<div class="modal fade" id="modalDetailTryout" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-info-circle-fill me-2 text-primary"></i>Detail Paket Tryout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <div class="mb-3">
                    <label class="text-secondary small d-block">Nama Paket</label>
                    <h5 class="fw-bold text-dark mb-0" id="detail_nama_tryout"></h5>
                </div>
                <div class="mb-3">
                    <label class="text-secondary small d-block">Deskripsi</label>
                    <p class="text-dark mb-0 fw-medium" id="detail_deskripsi"></p>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="text-secondary small d-block">Jumlah Soal</label>
                        <p class="text-dark mb-0 fw-bold" id="detail_jumlah_soal"></p>
                    </div>
                    <div class="col-6">
                        <label class="text-secondary small d-block">Durasi Ujian</label>
                        <p class="text-dark mb-0 fw-bold" id="detail_durasi"></p>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="text-secondary small d-block">Mulai Pelaksanaan</label>
                        <p class="text-success mb-0 fw-semibold" id="detail_tanggal_mulai"></p>
                    </div>
                    <div class="col-6">
                        <label class="text-secondary small d-block">Batas Selesai</label>
                        <p class="text-danger mb-0 fw-semibold" id="detail_tanggal_berakhir"></p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="text-secondary small d-block">Status Akses</label>
                    <div id="detail_status_badge"></div>
                </div>
            </div>
            <div class="modal-footer border-0 px-4 pb-4">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal"
                        style="border-radius:10px;font-size:14px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- ===== MODAL HAPUS TRYOUT ===== --}}
<div class="modal fade" id="modalHapusTryout" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark"><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Hapus Ujian?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-3 text-center">
                <p class="mb-0 text-secondary">Apakah Anda yakin ingin menghapus paket try out <strong id="hapus_nama_tryout"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center gap-3 pb-4">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius:10px;">Batal</button>
                <form id="formHapusTryout" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4" style="border-radius:10px;">Hapus</button>
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
        axios.get(`/admin/tryout/${id}`)
            .then(res => {
                const to = res.data.data;
                document.getElementById('detail_nama_tryout').textContent = to.nama_tryout;
                document.getElementById('detail_deskripsi').textContent = to.deskripsi || '—';
                document.getElementById('detail_jumlah_soal').textContent = `${to.jumlah_soal} Soal`;
                document.getElementById('detail_durasi').textContent = `${to.durasi} Menit`;
                
                // Format dates
                const start = new Date(to.tanggal_mulai);
                const end = new Date(to.tanggal_berakhir);
                document.getElementById('detail_tanggal_mulai').textContent = start.toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });
                document.getElementById('detail_tanggal_berakhir').textContent = end.toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });

                // Badge status
                const badgeBox = document.getElementById('detail_status_badge');
                if (to.status === 'aktif') {
                    badgeBox.innerHTML = '<span class="badge bg-success px-3 py-2"><i class="bi bi-check-circle-fill me-1"></i> Aktif</span>';
                } else if (to.status === 'belum_dimulai') {
                    badgeBox.innerHTML = '<span class="badge bg-warning text-dark px-3 py-2"><i class="bi bi-hourglass-split me-1"></i> Belum Mulai</span>';
                } else {
                    badgeBox.innerHTML = '<span class="badge bg-secondary px-3 py-2"><i class="bi bi-dash-circle-fill me-1"></i> Selesai</span>';
                }

                const modal = new bootstrap.Modal(document.getElementById('modalDetailTryout'));
                modal.show();
            })
            .catch(err => {
                alert('Gagal memuat detail paket ujian.');
                console.error(err);
            });
    }

    // POPULATE EDIT MODAL
    function editTryout(id) {
        axios.get(`/admin/tryout/${id}`)
            .then(res => {
                const to = res.data.data;
                
                // Set form action
                document.getElementById('formEditTryout').action = `/admin/tryout/${id}`;
                
                // Fill fields
                document.getElementById('edit_nama_tryout').value = to.nama_tryout;
                document.getElementById('edit_deskripsi').value = to.deskripsi || '';
                document.getElementById('edit_jumlah_soal').value = to.jumlah_soal;
                document.getElementById('edit_durasi').value = to.durasi;
                
                // Format dates to YYYY-MM-DDTHH:MM
                const start = to.tanggal_mulai.substring(0, 16);
                const end = to.tanggal_berakhir.substring(0, 16);
                
                document.getElementById('edit_tanggal_mulai').value = start;
                document.getElementById('edit_tanggal_berakhir').value = end;
                document.getElementById('edit_status').value = to.status;

                const modal = new bootstrap.Modal(document.getElementById('modalEditTryout'));
                modal.show();
            })
            .catch(err => {
                alert('Gagal memuat data paket ujian.');
                console.error(err);
            });
    }

    // TRIGGER DELETE CONFIRMATION
    function deleteTryout(id, name) {
        document.getElementById('formHapusTryout').action = `/admin/tryout/${id}`;
        document.getElementById('hapus_nama_tryout').textContent = name;
        
        const modal = new bootstrap.Modal(document.getElementById('modalHapusTryout'));
        modal.show();
    }
</script>
@endsection
