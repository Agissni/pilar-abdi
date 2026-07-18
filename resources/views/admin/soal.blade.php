@extends('layouts.admin')

@section('title', 'Kelola Soal Try Out')
@section('page-title', 'Kelola Soal')

@section('content')

{{-- ===== BREADCRUMB & BACK BUTTON ===== --}}
<div class="mb-4">
    <a href="/admin/tryout" class="btn btn-outline-secondary btn-sm" style="border-radius: 8px;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Kelola Try Out
    </a>
</div>

{{-- ===== NOTIFIKASI ===== --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius:12px;">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius:12px;">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Gagal menyimpan soal:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- ===== INFO CARD TRYOUT ===== --}}
<div class="card shadow-sm border-0 mb-4 rounded-4" style="background: linear-gradient(135deg, #071739 0%, #1e293b 100%); color: white;">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="badge bg-warning text-dark mb-2 px-3 py-2 fw-bold" style="border-radius: 20px;">Try Out Target</span>
                <h3 class="fw-bold mb-1">{{ $tryout->nama_tryout }}</h3>
                <p class="mb-0 text-white-50 small">{{ $tryout->deskripsi ?? '— Tidak ada deskripsi' }}</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="d-inline-block text-center bg-white bg-opacity-10 p-3 rounded-3" style="min-width: 150px; border: 1px solid rgba(255,255,255,0.15);">
                    <span class="d-block small text-white-50">Soal Terdaftar</span>
                    <h2 class="fw-bold mb-0 text-warning">{{ count($questions) }} <span class="fs-5 text-white">/ {{ $tryout->jumlah_soal }}</span></h2>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== HEADER ===== --}}
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1" style="color:#071739;">Daftar Soal Try Out</h5>
        <p class="text-muted mb-0" style="font-size:13px;">Kelola kumpulan bank soal ujian untuk simulasi CAT ini</p>
    </div>
    
    @if(count($questions) < $tryout->jumlah_soal)
        <button class="btn fw-bold px-4 py-2 text-white" data-bs-toggle="modal" data-bs-target="#modalTambahSoal"
                style="background:linear-gradient(135deg,#071739,#0e2554);border-radius:10px;border:none;">
            <i class="bi bi-plus-lg me-2"></i>Tambah Soal
        </button>
    @else
        <button class="btn btn-secondary fw-bold px-4 py-2" onclick="alert('Jumlah soal telah mencapai batas maksimal sesuai pengaturan Try Out.')" style="border-radius:10px;">
            <i class="bi bi-exclamation-octagon me-2"></i>Tambah Soal (Penuh)
        </button>
    @endif
</div>

<div class="row">
    {{-- ===== TABLE DAFTAR SOAL ===== --}}
    <div class="col-12">
        <div class="content-card">
            <div class="content-card-header">
                <div class="content-card-title">
                    <i class="bi bi-file-earmark-text text-primary"></i> Daftar Pertanyaan
                </div>
            </div>
            <div class="content-card-body p-3">
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th class="text-center" style="width: 100px;">No. Soal</th>
                                <th class="text-center" style="width: 120px;">Kategori</th>
                                <th>Pertanyaan</th>
                                <th class="text-center" style="width: 150px;">Jawaban Benar</th>
                                <th class="text-center" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($questions->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-file-earmark-x" style="font-size: 48px; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0 fw-semibold">Belum ada soal pada Try Out ini.</p>
                                        <p class="text-muted small">Klik tombol "Tambah Soal" untuk membuat soal pertama.</p>
                                    </td>
                                </tr>
                            @else
                                @foreach($questions as $index => $q)
                                    <tr>
                                        <td class="text-center" style="color:#94a3b8;font-size:13px;">{{ $index + 1 }}</td>
                                        <td class="text-center fw-bold" style="color:#071739;">Soal {{ $q->nomor_soal }}</td>
                                        <td class="text-center">
                                            @if($q->kategori === 'TWK')
                                                <span class="status-badge" style="background:#fee2e2;color:#991b1b;">TWK</span>
                                            @elseif($q->kategori === 'TIU')
                                                <span class="status-badge text-primary" style="background:#e0f2fe;color:#0369a1;">TIU</span>
                                            @else
                                                <span class="status-badge" style="background:#d1fae5;color:#065f46;">TKP</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 450px; font-weight: 500; color:#1e293b;">
                                                {{ strip_tags($q->pertanyaan) }}
                                            </div>
                                        </td>
                                        <td class="text-center fw-bold text-success fs-6">
                                            Opsi {{ $q->jawaban_benar }}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn btn-sm" style="background:#e0f2fe;color:#0369a1;border:none;border-radius:8px;" 
                                                        onclick="showDetail({{ $q->id_tryout_question }})" title="Detail Soal">
                                                    <i class="bi bi-eye-fill"></i> Detail
                                                </button>
                                                <button class="btn btn-sm" style="background:#fef3c7;color:#92400e;border:none;border-radius:8px;" 
                                                        onclick="editQuestion({{ $q->id_tryout_question }})" title="Edit Soal">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <button class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;border-radius:8px;" 
                                                        onclick="deleteQuestion({{ $q->id_tryout_question }}, {{ $q->nomor_soal }})" title="Hapus Soal">
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

{{-- ===== MODAL TAMBAH SOAL ===== --}}
<div class="modal fade" id="modalTambahSoal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-file-earmark-plus-fill me-2 text-warning"></i>Tambah Soal Ujian
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/admin/tryout/{{ $tryout->id_tryout }}/soal" method="POST">
                @csrf
                <div class="modal-body px-4 py-3" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Pilih Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select" style="border-radius:10px;" required>
                                <option value="TIU">TIU (Tes Inteligensia Umum)</option>
                                <option value="TWK">TWK (Tes Wawasan Kebangsaan)</option>
                                <option value="TKP">TKP (Tes Karakteristik Pribadi)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Jawaban Benar <span class="text-danger">*</span></label>
                            <select name="jawaban_benar" class="form-select" style="border-radius:10px;" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Pertanyaan <span class="text-danger">*</span></label>
                        <textarea name="pertanyaan" class="form-control" rows="4" style="border-radius:10px;" placeholder="Tuliskan pertanyaan disini..." required></textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Opsi Jawaban</label>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">A</span>
                                <input type="text" name="pilihan_a" class="form-control" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;" placeholder="Pilihan Jawaban A" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">B</span>
                                <input type="text" name="pilihan_b" class="form-control" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;" placeholder="Pilihan Jawaban B" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">C</span>
                                <input type="text" name="pilihan_c" class="form-control" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;" placeholder="Pilihan Jawaban C" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">D</span>
                                <input type="text" name="pilihan_d" class="form-control" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;" placeholder="Pilihan Jawaban D" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">E</span>
                                <input type="text" name="pilihan_e" class="form-control" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;" placeholder="Pilihan Jawaban E" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Pembahasan (Opsional)</label>
                        <textarea name="pembahasan" class="form-control" rows="3" style="border-radius:10px;" placeholder="Tuliskan kunci/pembahasan materi..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius:10px;">Batal</button>
                    <button type="submit" class="btn fw-bold px-4 text-white"
                            style="background:linear-gradient(135deg,#071739,#0e2554);border-radius:10px;border:none;">
                        <i class="bi bi-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL EDIT SOAL ===== --}}
<div class="modal fade" id="modalEditSoal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Soal Ujian
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditSoal" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4 py-3" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Pilih Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" id="edit_kategori" class="form-select" style="border-radius:10px;" required>
                                <option value="TIU">TIU (Tes Inteligensia Umum)</option>
                                <option value="TWK">TWK (Tes Wawasan Kebangsaan)</option>
                                <option value="TKP">TKP (Tes Karakteristik Pribadi)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Jawaban Benar <span class="text-danger">*</span></label>
                            <select name="jawaban_benar" id="edit_jawaban_benar" class="form-select" style="border-radius:10px;" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Pertanyaan <span class="text-danger">*</span></label>
                        <textarea name="pertanyaan" id="edit_pertanyaan" class="form-control" rows="4" style="border-radius:10px;" required></textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Opsi Jawaban</label>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">A</span>
                                <input type="text" name="pilihan_a" id="edit_pilihan_a" class="form-control" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">B</span>
                                <input type="text" name="pilihan_b" id="edit_pilihan_b" class="form-control" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">C</span>
                                <input type="text" name="pilihan_c" id="edit_pilihan_c" class="form-control" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">D</span>
                                <input type="text" name="pilihan_d" id="edit_pilihan_d" class="form-control" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">E</span>
                                <input type="text" name="pilihan_e" id="edit_pilihan_e" class="form-control" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;color:#374151;">Pembahasan (Opsional)</label>
                        <textarea name="pembahasan" id="edit_pembahasan" class="form-control" rows="3" style="border-radius:10px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius:10px;">Batal</button>
                    <button type="submit" class="btn fw-bold px-4 text-white"
                            style="background:linear-gradient(135deg,#071739,#0e2554);border-radius:10px;border:none;">
                        <i class="bi bi-save me-2"></i>Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL DETAIL SOAL ===== --}}
<div class="modal fade" id="modalDetailSoal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color:#071739;">
                    <i class="bi bi-info-circle-fill me-2 text-primary"></i>Detail Soal
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4 py-3" style="max-height: 70vh; overflow-y: auto;">
                <div class="mb-3">
                    <span class="text-secondary small d-block">Kategori</span>
                    <span id="detail_kategori" class="status-badge font-bold px-3 py-1"></span>
                </div>
                <div class="mb-3">
                    <span class="text-secondary small d-block">Pertanyaan</span>
                    <div id="detail_pertanyaan" class="p-3 bg-light rounded-3 fw-semibold text-dark fs-6" style="border-left: 5px solid #071739; white-space: pre-wrap;"></div>
                </div>
                
                <div class="mb-4">
                    <span class="text-secondary small d-block mb-2">Opsi Jawaban</span>
                    <div class="d-flex flex-column gap-2">
                        <div class="p-2 border rounded-3 bg-white" id="detail_opt_a"><strong>A.</strong> </div>
                        <div class="p-2 border rounded-3 bg-white" id="detail_opt_b"><strong>B.</strong> </div>
                        <div class="p-2 border rounded-3 bg-white" id="detail_opt_c"><strong>C.</strong> </div>
                        <div class="p-2 border rounded-3 bg-white" id="detail_opt_d"><strong>D.</strong> </div>
                        <div class="p-2 border rounded-3 bg-white" id="detail_opt_e"><strong>E.</strong> </div>
                    </div>
                </div>

                <div class="mb-3">
                    <span class="text-secondary small d-block">Jawaban Benar</span>
                    <span class="badge bg-success px-3 py-2 fs-6" id="detail_jawaban_benar"></span>
                </div>

                <div class="mb-3">
                    <span class="text-secondary small d-block">Pembahasan</span>
                    <div id="detail_pembahasan" class="p-3 bg-warning bg-opacity-10 text-dark-emphasis rounded-3 fw-medium" style="white-space: pre-wrap;"></div>
                </div>
            </div>
            <div class="modal-footer border-0 px-4 pb-4">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="border-radius:10px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- ===== MODAL HAPUS SOAL ===== --}}
<div class="modal fade" id="modalHapusSoal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark"><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Hapus Soal?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-3 text-center">
                <p class="mb-0 text-secondary">Apakah Anda yakin ingin menghapus <strong id="hapus_nama_soal"></strong>? Urutan nomor soal di try out ini akan di-resequence secara otomatis.</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center gap-3 pb-4">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius:10px;">Batal</button>
                <form id="formHapusSoal" method="POST" style="display: inline-block;">
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
        axios.get(`/admin/tryout/soal/${id}`)
            .then(res => {
                const q = res.data.data;
                document.getElementById('detail_pertanyaan').textContent = q.pertanyaan;
                document.getElementById('detail_opt_a').innerHTML = `<strong>A.</strong> ${q.pilihan_a}`;
                document.getElementById('detail_opt_b').innerHTML = `<strong>B.</strong> ${q.pilihan_b}`;
                document.getElementById('detail_opt_c').innerHTML = `<strong>C.</strong> ${q.pilihan_c}`;
                document.getElementById('detail_opt_d').innerHTML = `<strong>D.</strong> ${q.pilihan_d}`;
                document.getElementById('detail_opt_e').innerHTML = `<strong>E.</strong> ${q.pilihan_e}`;
                document.getElementById('detail_jawaban_benar').textContent = `Opsi ${q.jawaban_benar}`;
                document.getElementById('detail_pembahasan').textContent = q.pembahasan || 'Tidak ada pembahasan.';
                
                const badge = document.getElementById('detail_kategori');
                badge.textContent = q.kategori;
                badge.className = 'status-badge font-bold px-3 py-1';
                if (q.kategori === 'TWK') {
                    badge.style.background = '#fee2e2';
                    badge.style.color = '#991b1b';
                } else if (q.kategori === 'TIU') {
                    badge.style.background = '#e0f2fe';
                    badge.style.color = '#0369a1';
                } else {
                    badge.style.background = '#d1fae5';
                    badge.style.color = '#065f46';
                }

                // Highlight correct option background in list
                const options = ['A', 'B', 'C', 'D', 'E'];
                options.forEach(opt => {
                    const card = document.getElementById(`detail_opt_${opt.toLowerCase()}`);
                    card.classList.remove('bg-success', 'bg-opacity-10', 'border-success');
                    if (opt === q.jawaban_benar) {
                        card.classList.add('bg-success', 'bg-opacity-10', 'border-success');
                    }
                });

                const modal = new bootstrap.Modal(document.getElementById('modalDetailSoal'));
                modal.show();
            })
            .catch(err => {
                alert('Gagal memuat detail soal.');
                console.error(err);
            });
    }

    // POPULATE EDIT MODAL
    function editQuestion(id) {
        axios.get(`/admin/tryout/soal/${id}`)
            .then(res => {
                const q = res.data.data;
                
                // Set form action
                document.getElementById('formEditSoal').action = `/admin/tryout/soal/${id}`;
                
                // Fill fields
                document.getElementById('edit_kategori').value = q.kategori;
                document.getElementById('edit_jawaban_benar').value = q.jawaban_benar;
                document.getElementById('edit_pertanyaan').value = q.pertanyaan;
                document.getElementById('edit_pilihan_a').value = q.pilihan_a;
                document.getElementById('edit_pilihan_b').value = q.pilihan_b;
                document.getElementById('edit_pilihan_c').value = q.pilihan_c;
                document.getElementById('edit_pilihan_d').value = q.pilihan_d;
                document.getElementById('edit_pilihan_e').value = q.pilihan_e;
                document.getElementById('edit_pembahasan').value = q.pembahasan || '';

                const modal = new bootstrap.Modal(document.getElementById('modalEditSoal'));
                modal.show();
            })
            .catch(err => {
                alert('Gagal memuat data soal.');
                console.error(err);
            });
    }

    // TRIGGER DELETE CONFIRMATION
    function deleteQuestion(id, nomorSoal) {
        document.getElementById('formHapusSoal').action = `/admin/tryout/soal/${id}`;
        document.getElementById('hapus_nama_soal').textContent = `Soal Nomor ${nomorSoal}`;
        
        const modal = new bootstrap.Modal(document.getElementById('modalHapusSoal'));
        modal.show();
    }
</script>
@endsection
