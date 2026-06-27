@extends('layouts.app')

@section('title', 'Kontak')

@section('styles')
<style>
    .kontak-hero {
        background: #071739;
        padding: 80px 0 60px;
        text-align: center;
    }

    .kontak-hero h1 {
        color: white;
        font-size: 42px;
        font-weight: 800;
    }

    .kontak-hero h1 span {
        color: #f5b93b;
    }

    .kontak-hero p {
        color: #d7dff3;
        font-size: 16px;
        margin-top: 10px;
    }

    .kontak-section {
        padding: 60px 0;
    }

    .kontak-card {
        background: white;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 8px 25px rgba(0,0,0,.07);
        min-height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 100%;
    }

    .kontak-card h4 {
        font-weight: 700;
        color: #071739;
        margin-bottom: 24px;
        font-size: 20px;
    }

    .side-note {
        background: #fffbf0;
        border-radius: 12px;
        border-left: 3px solid #f5b93b;
        padding: 22px 18px;
        margin-top: 24px;
    }

    .side-note p {
        font-size: 13px;
        color: #444;
        margin: 0;
        line-height: 1.7;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 20px;
    }

    .info-item .icon {
        font-size: 24px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .info-item .label {
        font-size: 12px;
        color: #888;
        margin: 0;
    }

    .info-item .value {
        font-size: 15px;
        font-weight: 600;
        color: #071739;
        margin: 2px 0 0;
    }

    .btn-wa {
        background: #25D366;
        color: white;
        font-weight: 700;
        border-radius: 12px;
        padding: 14px 28px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 15px;
        transition: .3s;
        width: 100%;
        justify-content: center;
        margin-top: 8px;
    }

    .btn-wa:hover {
        background: #1eb858;
        color: white;
    }

    .form-label {
        font-weight: 600;
        color: #071739;
        font-size: 14px;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 1.5px solid #e0e0e0;
        padding: 12px 16px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
    }

    .form-control:focus, .form-select:focus {
        border-color: #f5b93b;
        box-shadow: 0 0 0 3px rgba(245,185,59,.15);
    }

    .btn-kirim {
        background: #071739;
        color: white;
        font-weight: 700;
        border-radius: 12px;
        padding: 14px 28px;
        width: 100%;
        border: none;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        transition: .3s;
        cursor: pointer;
    }

    .btn-kirim:hover {
        background: #f5b93b;
        color: #071739;
    }

    .jam-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
        font-size: 14px;
    }

    .jam-item:last-child {
        border-bottom: none;
    }

    .jam-item .hari {
        color: #666;
    }

    .jam-item .waktu {
        font-weight: 600;
        color: #071739;
    }

    .jam-item .tutup {
        color: #e74c3c;
        font-weight: 600;
    }
</style>
@endsection

@section('content')

<!-- HERO -->
<section class="kontak-hero">
    <div class="container">
        <h1>Hubungi <span>Kami</span></h1>
        <p>Ada pertanyaan? Tim kami siap membantu kamu setiap hari.</p>
    </div>
</section>

<!-- KONTAK -->
<section class="kontak-section">
    <div class="container">
        <div class="row g-4 justify-content-center align-items-stretch">

            <!-- Info Kontak -->
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-10">
                <div class="kontak-card">
                    <h4>Info Kontak</h4>

                    <div class="info-item">
                        <div class="icon">📍</div>
                        <div>
                            <p class="label">Alamat</p>
                            <p class="value">Jl. Pendidikan No. 12, Depok, Jawa Barat</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon">📞</div>
                        <div>
                            <p class="label">Telepon / WhatsApp</p>
                            <p class="value">+62 831-9445-7799</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon">📧</div>
                        <div>
                            <p class="label">Email</p>
                            <p class="value">info@pilarabdi.id</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon">📸</div>
                        <div>
                            <p class="label">Instagram</p>
                            <p class="value">@pilarabdi.official</p>
                        </div>
                    </div>

                    <a href="https://wa.me/6283194457799?text=Halo%20Pilar%20Abdi%2C%20saya%20ingin%20tanya%20tentang%20program%20bimbel" target="_blank" class="btn-wa">
                        💬 Chat via WhatsApp
                    </a>
                </div>
            </div>

            <!-- Jam Operasional -->
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-10">
                <div class="kontak-card">
                    <h4>Jam Operasional</h4>
                    <div class="jam-item">
                        <span class="hari">Senin – Jumat</span>
                        <span class="waktu">08.00 – 20.00</span>
                    </div>
                    <div class="jam-item">
                        <span class="hari">Sabtu</span>
                        <span class="waktu">08.00 – 17.00</span>
                    </div>
                    <div class="jam-item">
                        <span class="hari">Minggu</span>
                        <span class="tutup">Libur</span>
                    </div>

                    <div class="side-note">
                        <p>
                            💡 Pertanyaan seputar pendaftaran dan paket biasanya dibalas dalam <strong>kurang dari 1 jam</strong> di hari kerja.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
