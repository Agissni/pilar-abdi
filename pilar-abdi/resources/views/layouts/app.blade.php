<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pilar Abdi</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7fb;
        }

        .navbar-custom {
            background: #071739;
        }

        .navbar-brand {
            font-weight: 800;
            color: white !important;
            margin: 0;
            padding: 0;
        }

        .nav-link {
            color: white !important;
            margin-left: 15px;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #f5b93b !important;
        }
    </style>

    @yield('styles')
</head>
<body>

@php
    $isStudentArea = request()->is('dashboard') || request()->is('kelas') || request()->is('tryout') || request()->is('profil') || request()->is('hasil*') || request()->is('siswa*');
    $homeUrl = $isStudentArea ? url('/dashboard') : url('/');
    $backUrl = $isStudentArea ? url('/dashboard') : url('/');
@endphp

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top py-3">
    <div class="container">
        @if(!request()->is('/'))
            <a href="{{ $backUrl }}" class="btn btn-outline-warning d-flex align-items-center justify-content-center me-3" style="width:40px; height:40px; border-radius:50%;">
                <i class="bi bi-arrow-left fs-5"></i>
            </a>
        @endif

        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ $homeUrl }}">
            <img
                src="{{ asset('assets/logoo.png') }}"
                style="width:38px; height:38px; object-fit:cover; border-radius:50%;"
            >
            <div class="d-flex flex-column lh-sm">
                <span class="fw-bold text-white" style="font-size:22px;">PILAR ABDI</span>
                <small class="text-warning fw-semibold">BIMBEL KEDINASAN</small>
            </div>
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto">
                @if($isStudentArea)
                    <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/kelas') }}">Kelas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/tryout') }}">Tryout</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Hasil Tryout</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-warning text-white px-3 ms-2" href="{{ url('/dashboard') }}">Keluar</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/program') }}">Program</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/keunggulan') }}">Keunggulan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/testimoni') }}">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/kontak') }}">Kontak</a></li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-warning text-white px-3 ms-2" href="{{ url('/login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark px-3 ms-2" href="{{ url('/register') }}">Daftar</a>
                        </li>
                    @endguest
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Content -->
<div style="padding-top: 80px;">
    @yield('content')
</div>

<!-- FOOTER -->
<footer class="footer mt-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-3">
                <h6 class="text-uppercase fw-bold mb-3">Hubungi Kami</h6>
                <div class="d-flex justify-content-center flex-wrap gap-4">
                    <div>
                        <span class="fw-semibold">Email:</span> <a href="mailto:info@pilarabdi.id">info@pilarabdi.id</a>
                    </div>
                    <div>
                        <span class="fw-semibold">Telepon:</span> 0812-3456-7890
                    </div>
                    <div>
                        <span class="fw-semibold">Alamat:</span> Jakarta, Indonesia
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center pt-4 border-top mt-4">
            © {{ date('Y') }} Pilar Abdi. Semua hak cipta dilindungi.
        </div>
    </div>
</footer>

@yield('scripts')

</body>
</html>