<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pilar Abdi</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

    <!-- Navbar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">
            <i class="bi bi-building"></i> Pilar Abdi
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/program') }}">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Try Out</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Jadwal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pendaftaran</a>
                </li>
                
                <li class="nav-item ms-3">
                    <a href="#" class="btn btn-light">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

</body>
</html>