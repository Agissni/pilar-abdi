@extends('layouts.app')

@section('title', 'Beranda')

@section('styles')
<style>
    .btn-gold {
        background: #f5b93b;
        color: #071739;
        font-weight: 700;
        border-radius: 12px;
        padding: 12px 24px;
    }
 
    .btn-gold:hover {
        background: #e0a82e;
        color: #071739;
    }

    .hero {
        min-height: 100vh;
        background:
            linear-gradient(rgba(7,23,57,.88), rgba(7,23,57,.88)),
            url('{{ asset('assets/hero.jpg') }}');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        padding-top: 90px;
    }

    .hero-title {
        font-size: 68px;
        font-weight: 800;
        line-height: 1.1;
        color: white;
    }

    .hero-title span {
        color: #f5b93b;
    }

    .hero-text {
        color: #d7dff3;
        font-size: 18px;
        line-height: 1.8;
        margin-top: 25px;
    }

    .hero-card {
        background: white;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 15px 40px rgba(0,0,0,.15);
    }

    .hero-card h3 {
        font-weight: 700;
        color: #071739;
    }

    .feature-box {
        padding: 15px;
        border-radius: 18px;
        border: 1px solid #ececec;
        transition: .3s;
    }

    .feature-box:hover {
        transform: translateY(-5px);
    }

    .feature-box h5 {
        font-weight: 700;
        color: #071739;
        margin-top: 10px;
    }

    .sekdin-section {
        margin-top: -70px;
        position: relative;
        z-index: 10;
    }

    .sekdin-card {
        background: white;
        border-radius: 28px;
        padding: 45px;
        box-shadow: 0 10px 35px rgba(0,0,0,.08);
    }

    .sekdin-item {
        background: #f8f9fd;
        border-radius: 18px;
        padding: 25px;
        text-align: center;
        transition: .3s;
        height: 100%;
        border: 1px solid transparent;
    }

    .sekdin-item:hover {
        transform: translateY(-5px);
        border-color: #f5b93b;
    }

    .sekdin-toggle {
        width: 100%;
        background: transparent;
        border: none;
        padding: 0;
        text-align: center;
        color: inherit;
    }

    .sekdin-toggle:hover,
    .sekdin-toggle:focus {
        text-decoration: none;
        outline: none;
    }

    .sekdin-item h5 {
        font-weight: 700;
        color: #071739;
        margin-bottom: 0.5rem;
    }

    .sekdin-detail {
        text-align: left;
        margin-top: 1rem;
        color: #495057;
    }

    .sekdin-detail p {
        margin-bottom: 0;
    }

    .stats {
        padding: 90px 0;
    }

    .stats-card {
        background: white;
        border-radius: 24px;
        padding: 35px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,.06);
    }

    .stats-card h2 {
        font-size: 46px;
        font-weight: 800;
        color: #071739;
    }

    @media(max-width:992px) {
        .hero-title { font-size: 48px; }
        .hero { text-align: center; }
        .hero-card { margin-top: 40px; }
    }
</style>
@endsection

@section('content')

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
                <div class="mt-4">
                    <a href="{{ url('/pendaftaran') }}" class="btn btn-gold">
                        Gabung Sekarang
                    </a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero-card">
                    <h3 class="mb-4">Kenapa Pilar Abdi?</h3>
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
                <h2 class="fw-bold">Sekolah Kedinasan yang Kami Bimbing</h2>
                <p>Klik nama sekolah kedinasan untuk membuka halaman detail lengkap.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/stan') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>PKN STAN</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/ipdn') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>IPDN</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/stis') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>STIS</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/stmkg') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>STMKG</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/poltek-ssn') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>Poltek SSN</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/stin') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>STIN</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/poltekip') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>Poltekip</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/poltekim') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>Poltekim</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/ptdi-sttd') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>PTDI-STTD</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/stip-jakarta') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>STIP Jakarta</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/pip-semarang') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>PIP Semarang</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/pip-makassar') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>Polbangtan</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/poltekbang') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>Poltekbang</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-3">
                    <a href="{{ url('/sekdin/poltektrans-sdp') }}" class="text-decoration-none text-dark">
                        <div class="sekdin-item">
                            <h5>Poltektrans SDP</h5>
                        </div>
                    </a>
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

@endsection
