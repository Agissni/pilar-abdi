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

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
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
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/program') }}">Program</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/keunggulan') }}">Keunggulan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/testimoni') }}">Testimoni</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/kontak') }}">Kontak</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Content -->
<div style="padding-top: 80px;">
    @yield('content')
</div>

</body>
</html>