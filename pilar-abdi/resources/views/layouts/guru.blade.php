<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — Panel Pengajar</title>

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

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }
        
        .status-badge.active { background: #d1fae5; color: #065f46; }
        .status-badge.pending { background: #fef3c7; color: #92400e; }
        .status-badge.completed { background: #e2e8f0; color: #475569; }
    </style>
    @yield('styles')
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
            <a href="/guru/dashboard" class="nav-item-custom {{ request()->is('guru/dashboard*') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>
            
            <a href="/guru/siswa" class="nav-item-custom {{ request()->is('guru/siswa*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                Daftar Siswa
            </a>

            <a href="/guru/konsultasi" class="nav-item-custom {{ request()->is('guru/konsultasi*') ? 'active' : '' }}">
                <i class="bi bi-chat-dots-fill"></i>
                Konsultasi 1-on-1
            </a>
            
            @if(in_array(strtoupper($guru->spesialisasi ?? ''), ['TWK', 'TIU', 'TKP']))
                <a href="/guru/tryout" class="nav-item-custom {{ request()->is('guru/tryout*') ? 'active' : '' }}">
                    <i class="bi bi-patch-question-fill"></i>
                    Kelola Soal Try Out
                </a>
            @endif
        </div>

        <div class="sidebar-footer">
            <div class="profile-mini">
                <div class="avatar">
                    {{ strtoupper(substr($guru->nama ?? 'G', 0, 1)) }}
                </div>
                <div class="profile-info">
                    <div class="profile-name">{{ $guru->nama ?? 'Guru' }}</div>
                    <div class="profile-role">Guru ({{ $guru->spesialisasi ?? '' }})</div>
                </div>
                <a href="/logout" class="btn-logout" title="Logout" data-confirm="Sesi Anda akan diakhiri." data-confirm-title="Yakin Ingin Keluar?" data-confirm-button="Ya, Keluar" data-confirm-color="#e53e3e" data-confirm-type="question">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
            </div>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Global override for window.alert
        window.alert = function(message) {
            Swal.fire({
                text: message,
                icon: 'warning',
                confirmButtonColor: '#0f303f', // Matching teacher theme
                confirmButtonText: 'OK'
            });
        };

        // Generic confirmation handler via SweetAlert2 attributes
        document.addEventListener('click', function(e) {
            const confirmEl = e.target.closest('[data-confirm]');
            if (confirmEl) {
                e.preventDefault();
                const message = confirmEl.getAttribute('data-confirm');
                const title = confirmEl.getAttribute('data-confirm-title') || 'Apakah Anda yakin?';
                const type = confirmEl.getAttribute('data-confirm-type') || 'warning';
                const buttonText = confirmEl.getAttribute('data-confirm-button') || 'Ya, Lanjutkan';
                const buttonColor = confirmEl.getAttribute('data-confirm-color') || '#0f303f';

                Swal.fire({
                    title: title,
                    text: message,
                    icon: type,
                    showCancelButton: true,
                    confirmButtonColor: buttonColor,
                    cancelButtonColor: '#64748b',
                    confirmButtonText: buttonText,
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (confirmEl.tagName === 'A') {
                            window.location.href = confirmEl.getAttribute('href');
                        } else {
                            const form = confirmEl.closest('form');
                            if (form) {
                                if (confirmEl.getAttribute('name')) {
                                    const hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = confirmEl.getAttribute('name');
                                    hiddenInput.value = confirmEl.getAttribute('value');
                                    form.appendChild(hiddenInput);
                                }
                                form.submit();
                            }
                        }
                    }
                });
            }
        });

        // Flash message toasts
        @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true
            });
        @endif

        @if(session('error'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });
        @endif
    </script>
    @yield('scripts')
</body>
</html>
