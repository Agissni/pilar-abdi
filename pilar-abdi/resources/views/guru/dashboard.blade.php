<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru — Pilar Abdi</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --teal-dark: #0f303f;
            --teal-light: #1b4b5e;
            --teal-accent: #00b4d8;
            --gold: #f5b93b;
            --bg: #f4f7f6;
            --card-bg: #ffffff;
            --text-color: #2b3a4a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--teal-dark) 0%, #081e28 100%);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
        }

        .brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .brand-logo {
            width: 42px; height: 42px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid var(--gold);
        }
        .brand-text { line-height: 1.2; }
        .brand-title {
            color: white;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0.5px;
            display: block;
        }
        .brand-sub {
            color: var(--gold);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .nav-menu {
            flex: 1;
            padding: 20px 12px;
        }
        .nav-item-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
            transition: all 0.2s;
        }
        .nav-item-custom:hover {
            background: rgba(255,255,255,0.06);
            color: white;
        }
        .nav-item-custom.active {
            background: linear-gradient(135deg, var(--teal-accent) 0%, #0077b6 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 180, 216, 0.3);
        }
        .nav-item-custom i {
            font-size: 16px;
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .profile-mini {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255,255,255,0.04);
        }
        .avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), #f0a500);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: var(--teal-dark);
        }
        .profile-info { flex: 1; overflow: hidden; }
        .profile-name {
            color: white;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .profile-role {
            color: var(--gold);
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .btn-logout {
            background: none;
            border: none;
            color: rgba(255,255,255,0.4);
            font-size: 18px;
            cursor: pointer;
            padding: 4px;
            transition: color 0.2s;
        }
        .btn-logout:hover { color: #fc8181; }

        /* ===== MAIN CONTAINER ===== */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding: 30px;
        }

        .header-title {
            font-size: 24px;
            font-weight: 800;
            color: var(--teal-dark);
            margin-bottom: 5px;
        }
        .header-subtitle {
            font-size: 14px;
            color: #718096;
            margin-bottom: 24px;
        }

        /* ===== CARD WIDGETS ===== */
        .stat-card-custom {
            background: white;
            border-radius: 16px;
            padding: 22px 24px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid #eef2f3;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            overflow: hidden;
        }
        .stat-card-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        }
        .stat-card-custom::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: var(--teal-accent);
        }
        .stat-card-custom.teal::before { background: linear-gradient(90deg, var(--teal-accent), #0077b6); }
        .stat-card-custom.gold::before { background: linear-gradient(90deg, var(--gold), #e09d1a); }
        .stat-card-custom.dark::before { background: linear-gradient(90deg, var(--teal-dark), #102e3b); }

        .stat-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            margin-bottom: 12px;
        }
        .stat-icon.teal { background: rgba(0, 180, 216, 0.08); color: var(--teal-accent); }
        .stat-icon.gold { background: rgba(245, 185, 59, 0.08); color: #d4900a; }
        .stat-icon.dark { background: rgba(15, 48, 63, 0.08); color: var(--teal-dark); }

        .stat-num {
            font-size: 28px;
            font-weight: 800;
            color: var(--teal-dark);
            line-height: 1.2;
        }
        .stat-text {
            font-size: 13px;
            color: #718096;
            font-weight: 500;
        }

        /* ===== CONTENT CARD ===== */
        .content-card-custom {
            background: white;
            border-radius: 16px;
            border: 1px solid #eef2f3;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            overflow: hidden;
            margin-top: 30px;
        }
        .card-header-custom {
            padding: 20px 24px;
            border-bottom: 1px solid #eef2f3;
            background: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-title-custom {
            font-size: 16px;
            font-weight: 700;
            color: var(--teal-dark);
            margin: 0;
        }
        .card-title-custom i {
            color: var(--teal-accent);
        }

        /* ===== TABLE ===== */
        .table-custom {
            margin: 0;
            width: 100%;
        }
        .table-custom thead th {
            background: #f8fafc;
            color: #718096;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 14px 24px;
            border-bottom: 1px solid #e2e8f0;
        }
        .table-custom tbody td {
            padding: 16px 24px;
            font-size: 14px;
            color: var(--text-color);
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }
        .table-custom tbody tr:hover td {
            background: #fafcfb;
        }

        .materi-badge {
            display: inline-flex;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            background: #e0f2fe;
            color: #0369a1;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar">
        <a href="/guru/dashboard" class="brand">
            <img src="{{ asset('assets/logoo.png') }}" alt="Logo" class="brand-logo">
            <div class="brand-text">
                <span class="brand-title">PILAR ABDI</span>
                <span class="brand-sub">Panel Pengajar</span>
            </div>
        </a>

        <div class="nav-menu">
            <a href="/guru/dashboard" class="nav-item-custom active">
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>
        </div>

        <div class="sidebar-footer">
            <div class="profile-mini">
                <div class="avatar">
                    {{ strtoupper(substr($guru->nama ?? 'G', 0, 1)) }}
                </div>
                <div class="profile-info">
                    <div class="profile-name">{{ $guru->nama ?? 'Guru' }}</div>
                    <div class="profile-role">Guru Pengajar</div>
                </div>
                <a href="/logout" class="btn-logout" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
            </div>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="main-content">
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
                                                        {{ $k->id }},
                                                        '{{ addslashes($k->nama_kelas) }}',
                                                        '{{ addslashes($k->hari ?? '') }}',
                                                        '{{ addslashes($k->jam ?? '') }}',
                                                        '{{ addslashes($k->gmeet_link ?? '') }}',
                                                        '{{ addslashes($k->materi_pdf_name ?? '') }}'
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
    </main>

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

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function showManageModal(id, nama, hari, jam, gmeet, pdfName) {
        document.getElementById('formManageKelas').action = '/guru/kelas/' + id + '/update';
        document.getElementById('manage_nama_kelas').value = nama;
        document.getElementById('manage_jam').value = jam;
        document.getElementById('manage_gmeet_link').value = gmeet;

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
</body>
</html>
