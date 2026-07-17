@extends('layouts.guru')
@section('title', 'Dashboard Guru')

@section('content')
    {{-- Welcome Header --}}
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h4 class="header-title">Selamat Mengajar, {{ $guru->nama }}! 👋</h4>
            <p class="header-subtitle mb-0">Berikut jadwal mengajar Anda di bimbingan belajar Pilar Abdi.</p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert border-0 mt-4 d-flex align-items-center gap-2"
             style="background:#d1fae5;color:#065f46;border-radius:12px;padding:14px 18px;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert border-0 mt-4 d-flex align-items-center gap-2"
             style="background:#fee2e2;color:#991b1b;border-radius:12px;padding:14px 18px;">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ $errors->first() }}
        </div>
    @endif

    {{-- Statistics Row --}}
    <div class="row g-3 mt-3">
        <div class="col-12 col-md-4">
            <div class="stat-card-custom teal">
                <div class="stat-icon teal">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                <div class="stat-num">{{ $kelas->count() }}</div>
                <div class="stat-text">Total Kelas Aktif Anda</div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card-custom gold">
                <div class="stat-icon gold">
                    <i class="bi bi-book-half"></i>
                </div>
                <div class="stat-num" style="font-size: 20px;">{{ $guru->spesialisasi }}</div>
                <div class="stat-text">Spesialisasi Mengajar</div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card-custom dark">
                <div class="stat-icon dark">
                    <i class="bi bi-chat-left-text-fill"></i>
                </div>
                <div class="stat-num">Bimbel</div>
                <div class="stat-text">Program Kedinasan</div>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="content-card-custom">
        <div class="card-header-custom">
            <i class="bi bi-calendar3 text-primary"></i>
            <h6 class="card-title-custom">Jadwal Mengajar Anda</h6>
        </div>
        <div>
            @if($kelas->isEmpty())
                <div class="text-center py-5 text-muted bg-white">
                    <i class="bi bi-calendar-x" style="font-size: 48px; opacity: 0.3;"></i>
                    <p class="mt-3 mb-1 fw-bold">Belum ada kelas ditugaskan</p>
                    <p class="mb-0 text-muted" style="font-size: 13px;">Silakan hubungi administrator untuk menghubungkan Anda ke kelas aktif.</p>
                </div>
            @else
                <div class="table-responsive bg-white">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 25%">Nama Kelas</th>
                                <th style="width: 15%">Materi</th>
                                <th style="width: 20%">Jadwal Hari & Jam</th>
                                <th style="width: 20%">Google Meet & PDF</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kelas as $idx => $k)
                                <tr>
                                    <td style="color:#94a3b8;font-size:13px;">{{ $idx + 1 }}</td>
                                    <td>
                                        <div class="fw-bold" style="color: var(--teal-dark);">{{ $k->nama_kelas }}</div>
                                        @if($k->deskripsi)
                                            <small class="text-muted" style="font-size: 11px;">{{ $k->deskripsi }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="materi-badge">{{ $k->materi }}</span>
                                    </td>
                                    <td class="fw-semibold" style="font-size: 13px;">
                                        <i class="bi bi-calendar-event me-1 text-primary"></i>{{ $k->hari ?? '—' }}
                                        <br>
                                        <small class="text-muted"><i class="bi bi-clock me-1 text-warning"></i>{{ $k->jam ?? '—' }}</small>
                                    </td>
                                    <td>
                                        @if($k->gmeet_link)
                                            <a href="{{ $k->gmeet_link }}" target="_blank" class="badge bg-success text-white text-decoration-none mb-1 d-inline-flex align-items-center gap-1 py-1 px-2" style="font-size: 11px;">
                                                <i class="bi bi-camera-video-fill"></i> Link Meet
                                            </a>
                                        @else
                                            <span class="badge bg-light text-secondary border mb-1 py-1 px-2" style="font-size: 11px;">Meet belum diset</span>
                                        @endif
                                        <br>
                                        @if($k->materi_pdf_path)
                                            <a href="{{ asset('storage/' . $k->materi_pdf_path) }}" target="_blank" class="badge bg-info text-dark text-decoration-none d-inline-flex align-items-center gap-1 py-1 px-2" style="font-size: 11px;" title="{{ $k->materi_pdf_name }}">
                                                <i class="bi bi-file-earmark-pdf-fill"></i> PDF Materi
                                            </a>
                                        @else
                                            <span class="badge bg-light text-secondary border py-1 px-2" style="font-size: 11px;">Materi belum diunggah</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary fw-semibold"
                                                style="border-radius:8px; padding:6px 12px; font-size:12px; background:var(--teal-light); border:none;"
                                                onclick="showManageModal(
                                                    {{ $k->id_kelas }},
                                                    '{{ addslashes($k->nama_kelas) }}',
                                                    '{{ addslashes($k->hari ?? '') }}',
                                                    '{{ addslashes($k->jam ?? '') }}',
                                                    '{{ addslashes($k->gmeet_link ?? '') }}',
                                                    '{{ addslashes($k->materi_pdf_name ?? '') }}',
                                                    '{{ addslashes($k->link_rekaman ?? '') }}'
                                                )">
                                            <i class="bi bi-gear-fill me-1"></i>Kelola
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Announcements Section --}}
    <div class="content-card-custom mt-4">
        <div class="card-header-custom d-flex align-items-center gap-2">
            <i class="bi bi-bell-fill text-primary"></i>
            <h6 class="card-title-custom mb-0">Pengumuman Terbaru</h6>
        </div>
        <div class="card-body p-4 bg-white" style="border-radius: 0 0 16px 16px;">
            <div class="d-flex flex-column gap-3">
                @if($announcements->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-bell-slash text-secondary mb-2" style="font-size: 32px; opacity: 0.5;"></i>
                        <p class="mb-0 small fw-semibold">Belum ada pengumuman terbaru.</p>
                    </div>
                @else
                    @foreach($announcements as $ann)
                        <div class="p-3 rounded border" style="background-color: #fafbfc;">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="badge bg-warning bg-opacity-10 text-dark-emphasis small" style="font-size: 10px;">
                                    {{ $ann->tanggal_publikasi->format('d M Y, H:i') }}
                                </span>
                            </div>
                            <h6 class="fw-bold text-dark mb-1" style="font-size: 13px;">{{ $ann->judul }}</h6>
                            <p class="text-secondary mb-0 small" style="line-height: 1.4; white-space: pre-line;">{{ $ann->isi }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- ===== MODAL KELOLA JADWAL & MATERI ===== --}}
    <div class="modal fade" id="modalManageKelas" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:16px; border:none; overflow:hidden;">
                <div class="modal-header border-0 text-white p-4" style="background: var(--teal-dark);">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-pencil-square me-2 text-warning"></i>Kelola Jadwal & Materi Kelas
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="formManageKelas" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: var(--teal-dark);">Nama Kelas</label>
                            <input type="text" id="manage_nama_kelas" class="form-control bg-light" style="border-radius:10px; font-size:14px;" readonly>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold" style="font-size: 13px; color: var(--teal-dark);">Hari Mengajar <span class="text-danger">*</span></label>
                                <select name="hari" id="manage_hari" class="form-select" style="border-radius:10px; font-size:14px;" required>
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
                                <label class="form-label fw-semibold" style="font-size: 13px; color: var(--teal-dark);">Jam Mengajar <span class="text-danger">*</span></label>
                                <input type="text" name="jam" id="manage_jam" class="form-control" style="border-radius:10px; font-size:14px;" placeholder="Contoh: 19.00 WIB" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: var(--teal-dark);">Link Google Meet</label>
                            <input type="url" name="gmeet_link" id="manage_gmeet_link" class="form-control" style="border-radius:10px; font-size:14px;" placeholder="https://meet.google.com/xxx-xxxx-xxx">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: var(--teal-dark);">Link Rekaman Video (Google Drive / YouTube)</label>
                            <input type="url" name="link_rekaman" id="manage_link_rekaman" class="form-control" style="border-radius:10px; font-size:14px;" placeholder="https://drive.google.com/drive/folders/... atau https://youtube.com/playlist?...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: var(--teal-dark);">Unggah Materi PDF <small class="text-muted">(Maks. 10MB)</small></label>
                            <input type="file" name="materi_pdf" class="form-control" style="border-radius:10px; font-size:14px;" accept="application/pdf">
                            <div id="current_pdf_container" class="mt-2 d-none">
                                <span class="badge bg-light text-dark border p-2">
                                    <i class="bi bi-file-earmark-pdf text-danger me-1"></i> File Saat Ini: <strong id="current_pdf_name"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn" data-bs-dismiss="modal"
                                style="border-radius:10px; border:1px solid #e2e8f0; color:#64748b; font-size:14px;">Batal</button>
                        <button type="submit" class="btn fw-bold px-4"
                                style="background:var(--teal-accent); color:white; border-radius:10px; border:none; font-size:14px;">
                            <i class="bi bi-save me-2"></i>Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    function showManageModal(id, nama, hari, jam, gmeet, pdfName, linkRekaman) {
        document.getElementById('formManageKelas').action = '/guru/kelas/' + id + '/update';
        document.getElementById('manage_nama_kelas').value = nama;
        document.getElementById('manage_jam').value = jam;
        document.getElementById('manage_gmeet_link').value = gmeet;
        document.getElementById('manage_link_rekaman').value = linkRekaman || '';

        // Set select hari
        const selHari = document.getElementById('manage_hari');
        for (let opt of selHari.options) {
            opt.selected = (opt.value === hari);
        }

        // Set current PDF badge
        const pdfCont = document.getElementById('current_pdf_container');
        const pdfText = document.getElementById('current_pdf_name');
        if (pdfName) {
            pdfCont.classList.remove('d-none');
            pdfText.textContent = pdfName;
        } else {
            pdfCont.classList.add('d-none');
        }

        // Show modal
        new bootstrap.Modal(document.getElementById('modalManageKelas')).show();
    }
    </script>
@endsection
