<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilar Abdi</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        body{
            font-family:'Poppins',sans-serif;
            background:#f4f7fb;
        }

        .navbar-custom{
            background:#071739;
        }

        .navbar-brand{
        font-weight:800;
        color:white !important;
        margin:0;
        padding:0;
        }

        .nav-link{
            color:white !important;
            margin-left:15px;
            font-weight:500;
        }

        .btn-gold{
            background:#f5b93b;
            color:#071739;
            font-weight:700;
            border-radius:12px;
            padding:12px 24px;
        }

        .hero{
            min-height:100vh;
            background:
            linear-gradient(rgba(7,23,57,.88), rgba(7,23,57,.88)),
            url('{{ asset('assets/hero.jpg') }}');

            background-size:cover;
            background-position:center;
            display:flex;
            align-items:center;
            padding-top:90px;
        }

        .hero-title{
            font-size:68px;
            font-weight:800;
            line-height:1.1;
            color:white;
        }

        .hero-title span{
            color:#f5b93b;
        }

        .hero-text{
            color:#d7dff3;
            font-size:18px;
            line-height:1.8;
            margin-top:25px;
        }

        .hero-card{
            background:white;
            border-radius:24px;
            padding:35px;
            box-shadow:0 15px 40px rgba(0,0,0,.15);
        }

        .hero-card h3{
            font-weight:700;
            color:#071739;
        }

        .feature-box{
            padding:15px;
            border-radius:18px;
            border:1px solid #ececec;
            transition:.3s;
        }

        .feature-box:hover{
            transform:translateY(-5px);
        }

        .feature-box h5{
            font-weight:700;
            color:#071739;
            margin-top:10px;
        }

        .sekdin-section{
            margin-top:-70px;
            position:relative;
            z-index:10;
        }

        .sekdin-card{
            background:white;
            border-radius:28px;
            padding:45px;
            box-shadow:0 10px 35px rgba(0,0,0,.08);
        }

        .sekdin-item{
            background:#f8f9fd;
            border-radius:18px;
            padding:30px 20px;
            text-align:center;
            transition:.3s;
            height:100%;
        }

        .sekdin-item:hover{
            transform:translateY(-5px);
            border:1px solid #f5b93b;
        }

        .sekdin-item img{
            width:65px;
            height:65px;
            object-fit:contain;
            margin-bottom:15px;
        }

        .sekdin-item h5{
            font-weight:700;
            color:#071739;
        }

        .stats{
            padding:90px 0;
        }

        .stats-card{
            background:white;
            border-radius:24px;
            padding:35px;
            text-align:center;
            box-shadow:0 10px 30px rgba(0,0,0,.06);
        }

        .stats-card h2{
            font-size:46px;
            font-weight:800;
            color:#071739;
        }

        @media(max-width:992px){

            .hero-title{
                font-size:48px;
            }

            .hero{
                text-align:center;
            }

            .hero-card{
                margin-top:40px;
            }

        }

    </style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img 
                src="{{ asset('assets/logo.png') }}"
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
                <li class="nav-item"><a class="nav-link" href="#">Keunggulan</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Testimoni</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/pendaftaran') }}">Pendaftaran</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
            </ul>

            <a href="{{ url('/pendaftaran') }}" class="btn btn-gold ms-lg-4 mt-3 mt-lg-0">
                Daftar Sekarang
            </a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-7">

                <h1 class="hero-title">
                    Wujudkan Mimpi
                    Masuk <span>Sekolah Kedinasan</span>
                </h1>

                <p class="hero-text">
                    Bimbingan belajar intensif untuk persiapan sekolah kedinasan
                    dengan mentor berpengalaman, try out rutin, dan strategi lolos terbaik.
                </p>

                <div class="mt-4 d-flex gap-3 flex-wrap">

                    <a href="#" class="btn btn-gold">
                        Gabung Sekarang
                    </a>

                    <a href="#" class="btn btn-outline-light px-4 py-3 rounded-3">
                        Lihat Program
                    </a>

                </div>

            </div>

            <div class="col-lg-5">

                <div class="hero-card">

                    <h3 class="mb-4">
                        Kenapa Pilar Abdi?
                    </h3>

                    <div class="row g-3">

                        <div class="col-6">
                            <div class="feature-box text-center">
                                📘
                                <h5>Materi Lengkap</h5>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="feature-box text-center">
                                🎯
                                <h5>Try Out</h5>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="feature-box text-center">
                                👨‍🏫
                                <h5>Mentor Ahli</h5>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="feature-box text-center">
                                🚀
                                <h5>Strategi Lolos</h5>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- SEKDIN -->
<section class="sekdin-section">

    <div class="container">

        <div class="sekdin-card">

            <div class="text-center mb-5">
                <h2 class="fw-bold">
                    Sekolah Kedinasan Favorit
                </h2>
            </div>

            <div class="row g-4">

                <div class="col-lg-3 col-6">
                    <div class="sekdin-item">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/Lambang_IPDN.svg/1200px-Lambang_IPDN.svg.png">
                        <h5>IPDN</h5>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="sekdin-item">
                        <img src="https://upload.wikimedia.org/wikipedia/id/thumb/8/8c/Lambang_STAN.png/800px-Lambang_STAN.png">
                        <h5>STAN</h5>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="sekdin-item">
                        <img src="https://upload.wikimedia.org/wikipedia/id/5/53/Logo_STIN.png">
                        <h5>STIN</h5>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="sekdin-item">
                        <img src="https://upload.wikimedia.org/wikipedia/id/0/09/Logo_Poltekim.png">
                        <h5>POLTEKIM</h5>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>

<!-- STATS -->
<section class="stats">

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-3 col-6">
                <div class="stats-card">
                    <h2>5000+</h2>
                    <p>Alumni</p>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="stats-card">
                    <h2>85%</h2>
                    <p>Tingkat Kelulusan</p>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="stats-card">
                    <h2>20+</h2>
                    <p>Program Belajar</p>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="stats-card">
                    <h2>10+</h2>
                    <p>Tahun Pengalaman</p>
                </div>
            </div>

        </div>

    </div>

</section>

</body>
</html>