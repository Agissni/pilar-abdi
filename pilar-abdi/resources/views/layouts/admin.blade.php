<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Pilar Abdi</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --navy: #071739;
            --navy-light: #0e2554;
            --gold: #f5b93b;
            --gold-light: #fdd87b;
            --bg: #f0f4f8;
            --card-bg: #ffffff;
            --text-muted-custom: #8898aa;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            margin: 0;
            padding: 0;
        }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--navy) 0%, #0a1f45 100%);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .sidebar-brand-logo {
            width: 42px; height: 42px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid var(--gold);
        }
        .sidebar-brand-text { line-height: 1.2; }
        .sidebar-brand-title {
            color: white;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0.5px;
            display: block;
        }
        .sidebar-brand-sub {
            color: var(--gold);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }
        .sidebar-section-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.35);
            padding: 12px 10px 6px;
        }
        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 14px;
            border-radius: 10px;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 2px;
            transition: all 0.2s ease;
            position: relative;
        }
        .sidebar-nav-item:hover {
            background: rgba(255,255,255,0.08);
            color: white;
        }
        .sidebar-nav-item.active {
            background: linear-gradient(135deg, var(--gold) 0%, #f0a500 100%);
            color: var(--navy);
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(245,185,59,0.3);
        }
        .sidebar-nav-item.active i { color: var(--navy); }
        .sidebar-nav-item i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }
        .sidebar-badge {
            margin-left: auto;
            background: #e53e3e;
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            min-width: 20px;
            text-align: center;
        }
        .sidebar-nav-item.active .sidebar-badge {
            background: var(--navy);
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .admin-profile-mini {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            background: rgba(255,255,255,0.06);
        }
        .admin-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), #f0a500);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: var(--navy);
            flex-shrink: 0;
        }
        .admin-profile-info { flex: 1; overflow: hidden; }
        .admin-profile-name {
            color: white;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .admin-profile-role {
            color: var(--gold);
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .btn-logout-mini {
            background: none;
            border: none;
            color: rgba(255,255,255,0.45);
            font-size: 16px;
            cursor: pointer;
            padding: 4px;
            transition: color 0.2s;
        }
        .btn-logout-mini:hover { color: #fc8181; }

        /* ===== MAIN CONTENT ===== */
        .admin-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== TOPBAR ===== */
        .admin-topbar {
            background: white;
            padding: 0 28px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 500;
            box-shadow: 0 1px 8px rgba(0,0,0,0.05);
        }
        .topbar-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--navy);
        }
        .topbar-actions { display: flex; align-items: center; gap: 12px; }
        .topbar-btn {
            width: 38px; height: 38px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: white;
            display: flex; align-items: center; justify-content: center;
            color: #64748b;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .topbar-btn:hover {
            background: #f1f5f9;
            color: var(--navy);
        }
        .topbar-notif { position: relative; }
        .notif-dot {
            position: absolute;
            top: 6px; right: 7px;
            width: 8px; height: 8px;
            background: #e53e3e;
            border-radius: 50%;
            border: 2px solid white;
        }
        .topbar-date {
            font-size: 13px;
            color: #94a3b8;
            font-weight: 500;
        }

        /* ===== PAGE CONTENT ===== */
        .admin-content {
            padding: 28px;
            flex: 1;
        }

        /* ===== STATS CARD ===== */
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 22px 24px;
            box-shadow: 0 1px 8px rgba(0,0,0,0.06);
            border: 1px solid #f1f5f9;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            overflow: hidden;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
        }
        .stat-card.navy::before  { background: linear-gradient(90deg, var(--navy), #1a3a6e); }
        .stat-card.gold::before  { background: linear-gradient(90deg, var(--gold), #f0a500); }
        .stat-card.green::before { background: linear-gradient(90deg, #38a169, #2f855a); }
        .stat-card.red::before   { background: linear-gradient(90deg, #e53e3e, #c53030); }
        .stat-card.blue::before  { background: linear-gradient(90deg, #3182ce, #2b6cb0); }
        .stat-card.purple::before{ background: linear-gradient(90deg, #805ad5, #6b46c1); }

        .stat-icon-wrap {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            margin-bottom: 14px;
        }
        .stat-icon-wrap.navy   { background: rgba(7,23,57,0.08);   color: var(--navy); }
        .stat-icon-wrap.gold   { background: rgba(245,185,59,0.12); color: #d4900a; }
        .stat-icon-wrap.green  { background: rgba(56,161,105,0.1);  color: #38a169; }
        .stat-icon-wrap.red    { background: rgba(229,62,62,0.1);   color: #e53e3e; }
        .stat-icon-wrap.blue   { background: rgba(49,130,206,0.1);  color: #3182ce; }
        .stat-icon-wrap.purple { background: rgba(128,90,213,0.1);  color: #805ad5; }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--navy);
            line-height: 1;
            margin-bottom: 4px;
        }
        .stat-label {
            font-size: 13px;
            color: var(--text-muted-custom);
            font-weight: 500;
        }
        .stat-change {
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* ===== TABLE CARD ===== */
        .content-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 8px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .content-card-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .content-card-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--navy);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .content-card-title i {
            color: var(--gold);
        }
        .content-card-body { padding: 0; }

        .admin-table { margin: 0; }
        .admin-table thead th {
            background: #f8fafc;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 12px 16px;
            border-bottom: 1px solid #e2e8f0;
            border-top: none;
        }
        .admin-table tbody td {
            padding: 13px 16px;
            font-size: 14px;
            color: #374151;
            border-bottom: 1px solid #f8fafc;
            vertical-align: middle;
        }
        .admin-table tbody tr:last-child td { border-bottom: none; }
        .admin-table tbody tr:hover td { background: #fafbff; }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-badge.pending  { background:#fef3c7; color:#92400e; }
        .status-badge.active   { background:#d1fae5; color:#065f46; }
        .status-badge.lunas    { background:#d1fae5; color:#065f46; }
        .status-badge.ditolak  { background:#fee2e2; color:#991b1b; }

        .user-cell { display: flex; align-items: center; gap: 10px; }
        .user-avatar-sm {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--navy), #1a3a6e);
            color: white;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
        }
        .user-name { font-weight: 600; color: var(--navy); font-size: 14px; }
        .user-email { font-size: 12px; color: #94a3b8; }

        /* ===== QUICK ACCESS ===== */
        .quick-card {
            background: white;
            border-radius: 14px;
            padding: 20px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 14px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 6px rgba(0,0,0,0.05);
            transition: all 0.25s ease;
        }
        .quick-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-color: transparent;
        }
        .quick-card.qc-navy:hover  { background: linear-gradient(135deg, var(--navy), #1a3a6e); }
        .quick-card.qc-gold:hover  { background: linear-gradient(135deg, #f5b93b, #e09d1a); }
        .quick-card.qc-green:hover { background: linear-gradient(135deg, #38a169, #276749); }
        .quick-card.qc-blue:hover  { background: linear-gradient(135deg, #3182ce, #2b6cb0); }
        .quick-card:hover .qc-label { color: white; }
        .quick-card:hover .qc-sub   { color: rgba(255,255,255,0.75); }
        .quick-card:hover .qc-icon  { color: white; background: rgba(255,255,255,0.2); }

        .qc-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            transition: all 0.25s;
        }
        .qc-icon.navy   { background: rgba(7,23,57,0.08);   color: var(--navy); }
        .qc-icon.gold   { background: rgba(245,185,59,0.12); color: #d4900a; }
        .qc-icon.green  { background: rgba(56,161,105,0.1);  color: #38a169; }
        .qc-icon.blue   { background: rgba(49,130,206,0.1);  color: #3182ce; }

        .qc-label {
            font-size: 14px;
            font-weight: 700;
            color: var(--navy);
            transition: color 0.25s;
        }
        .qc-sub {
            font-size: 12px;
            color: #94a3b8;
            transition: color 0.25s;
        }

        /* ===== MOBILE TOGGLE ===== */
        @media (max-width: 992px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }
            .sidebar-overlay.show { display: block; }
        }

        /* ===== DONUT CHART MINI ===== */
        .donut-container {
            position: relative;
            width: 100px; height: 100px;
            margin: 0 auto;
        }
        .donut-svg { transform: rotate(-90deg); }
        .donut-text {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 800;
            color: var(--navy);
            line-height: 1.1;
        }
        .donut-text small { font-size: 10px; color: #94a3b8; font-weight: 500; }
    </style>

    @yield('styles')
</head>
<body>

{{-- Overlay mobile --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

{{-- ===== SIDEBAR ===== --}}
<aside class="admin-sidebar" id="adminSidebar">

    <a href="/admin/dashboard" class="sidebar-brand">
        <img src="{{ asset('assets/logoo.png') }}" alt="Logo" class="sidebar-brand-logo">
        <div class="sidebar-brand-text">
            <span class="sidebar-brand-title">PILAR ABDI</span>
            <span class="sidebar-brand-sub">Admin Panel</span>
        </div>
    </a>

    <nav class="sidebar-nav">
        <div class="sidebar-section-label">Utama</div>

        <a href="/admin/dashboard"
           class="sidebar-nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            Dashboard
        </a>

        <div class="sidebar-section-label mt-2">Manajemen</div>

        <a href="/admin/pembayaran"
           class="sidebar-nav-item {{ request()->is('admin/pembayaran*') ? 'active' : '' }}">
            <i class="bi bi-credit-card-2-front-fill"></i>
            Verifikasi Pembayaran
            @php $pendingCount = \App\Models\Payment::where('status','pending')->count(); @endphp
            @if($pendingCount > 0)
                <span class="sidebar-badge">{{ $pendingCount }}</span>
            @endif
        </a>

        <a href="/admin/siswa"
           class="sidebar-nav-item {{ request()->is('admin/siswa*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            Kelola Siswa
        </a>

        <a href="/admin/guru"
           class="sidebar-nav-item {{ request()->is('admin/guru*') ? 'active' : '' }}">
            <i class="bi bi-person-badge-fill"></i>
            Kelola Guru
        </a>

        <a href="/admin/kelas"
           class="sidebar-nav-item {{ request()->is('admin/kelas*') ? 'active' : '' }}">
            <i class="bi bi-journal-text"></i>
            Kelola Kelas
        </a>

        <a href="/admin/tryout"
           class="sidebar-nav-item {{ request()->is('admin/tryout*') ? 'active' : '' }}">
            <i class="bi bi-patch-question-fill"></i>
            Kelola Try Out
        </a>

        <a href="/admin/pengumuman"
           class="sidebar-nav-item {{ request()->is('admin/pengumuman*') ? 'active' : '' }}">
            <i class="bi bi-megaphone-fill"></i>
            Kelola Pengumuman
        </a>

        <div class="sidebar-section-label mt-2">Website</div>

        <a href="/" target="_blank"
           class="sidebar-nav-item">
            <i class="bi bi-globe"></i>
            Lihat Website
            <i class="bi bi-box-arrow-up-right ms-auto" style="font-size:11px; opacity:.5;"></i>
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-profile-mini">
            <div class="admin-avatar">
                {{ strtoupper(substr($admin->name ?? 'A', 0, 1)) }}
            </div>
            <div class="admin-profile-info">
                <div class="admin-profile-name">{{ $admin->name ?? 'Admin' }}</div>
                <div class="admin-profile-role">Administrator</div>
            </div>
            <a href="/logout" class="btn-logout-mini" title="Logout" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </div>

</aside>

{{-- ===== MAIN ===== --}}
<div class="admin-main">

    {{-- Topbar --}}
    <header class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="topbar-btn d-lg-none"
                    onclick="openSidebar()" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        </div>

        <div class="topbar-actions">
            <span class="topbar-date d-none d-md-block">
                <i class="bi bi-calendar3 me-1"></i>
                {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </span>
            <a href="/admin/pembayaran" class="topbar-btn topbar-notif" title="Pembayaran Pending">
                <i class="bi bi-bell-fill"></i>
                @if(($pendingCount ?? 0) > 0)
                    <span class="notif-dot"></span>
                @endif
            </a>
            <a href="/logout" class="topbar-btn" title="Logout" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </header>

    {{-- Content --}}
    <main class="admin-content">
        @yield('content')
    </main>

</div>

<!-- Axios JS -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function openSidebar() {
        document.getElementById('adminSidebar').classList.add('open');
        document.getElementById('sidebarOverlay').classList.add('show');
    }
    function closeSidebar() {
        document.getElementById('adminSidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('show');
    }
</script>

@yield('scripts')
</body>
</html>
