<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pilar Abdi</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

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
                    <li class="nav-item"><a class="nav-link" href="{{ url('/hasil-tryout') }}">Hasil Tryout</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/strategi-lolos') }}">Strategi Lolos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalProfilSaya">Profil</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-warning text-white px-3 ms-2" href="{{ url('/logout') }}" data-confirm="Sesi Anda akan diakhiri." data-confirm-title="Yakin Ingin Keluar?" data-confirm-button="Ya, Keluar" data-confirm-color="#e53e3e" data-confirm-type="question">Keluar</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/program') }}">Program</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/keunggulan') }}">Keunggulan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/testimoni') }}">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/kontak') }}">Kontak</a></li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark px-3 ms-2" href="{{ url('/register') }}">Daftar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-warning text-white px-3 ms-2" href="{{ url('/login') }}">Login</a>
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
                        <span class="fw-semibold">Telepon:</span> +62 831-9445-7799
                    </div>
                    <div>
                        <span class="fw-semibold">Alamat:</span> Jl. Pendidikan No. 12, Depok, Jawa Barat
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

<!-- Bootstrap 5 JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Global override for window.alert
    window.alert = function(message) {
        Swal.fire({
            text: message,
            icon: 'warning',
            confirmButtonColor: '#071739',
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
            const buttonColor = confirmEl.getAttribute('data-confirm-color') || '#071739';

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

@if(isset($user))
{{-- ===== MODAL PROFIL SAYA GLOBAL ===== --}}
<div class="modal fade" id="modalProfilSaya" tabindex="-1" aria-hidden="true" style="backdrop-filter: blur(5px);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header py-3 text-white" style="background: #071739; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <h5 class="modal-title fw-bold"><i class="bi bi-person-bounding-box me-2 text-warning"></i>Profil Saya</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-start">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning mb-2 rounded-circle" style="width: 70px; height: 70px; border: 2px solid rgba(245, 185, 59, 0.2);">
                        <i class="bi bi-person-fill fs-2"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-0">{{ $user->name }}</h5>
                    <span class="badge bg-success bg-opacity-10 text-success mt-2 px-3 py-1 fw-bold" style="border-radius: 20px;">
                        <i class="bi bi-patch-check-fill me-1"></i>Akun Aktif
                    </span>
                </div>
                
                <div class="p-3 rounded-3" style="background-color: #f8fafc;">
                    <div class="mb-3 border-bottom pb-2">
                        <label class="text-secondary small d-block mb-1">Email Terdaftar</label>
                        <span class="text-dark fw-bold" style="font-size: 14px;">{{ $user->email }}</span>
                    </div>
                    <div class="mb-3 border-bottom pb-2">
                        <label class="text-secondary small d-block mb-1">Nomor WhatsApp</label>
                        <span class="text-dark fw-bold" style="font-size: 14px;">{{ $user->whatsapp }}</span>
                    </div>
                    <div class="mb-3 border-bottom pb-2">
                        <label class="text-secondary small d-block mb-1">Sekolah Kedinasan Tujuan</label>
                        <span class="text-primary fw-bold text-uppercase" style="font-size: 14px;">{{ str_replace('-', ' ', $user->sekdin) }}</span>
                    </div>
                    <div class="mb-3 border-bottom pb-2">
                        <label class="text-secondary small d-block mb-1">Paket Bimbingan</label>
                        <span class="text-dark fw-bold text-capitalize" style="font-size: 14px;">{{ $user->package }}</span>
                    </div>
                    <div class="mb-0">
                        <label class="text-secondary small d-block mb-1">Alamat Asal</label>
                        <span class="text-dark fw-semibold" style="font-size: 14px;">{{ $user->address ?? '— Tidak ada alamat' }}</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-center pb-4">
                <button type="button" class="btn text-white px-5 py-2.5 fw-bold" data-bs-dismiss="modal" style="background: #071739; border-radius: 12px;">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif

</body>
</html>