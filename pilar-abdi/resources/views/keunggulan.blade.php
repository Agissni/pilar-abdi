@extends('layouts.app')

@section('title', 'Keunggulan')

@section('styles')
<style>
    .keunggulan-hero {
        background: #071739;
        padding: 80px 0 60px;
        text-align: center;
    }

    .keunggulan-hero h1 {
        color: white;
        font-size: 42px;
        font-weight: 800;
    }

    .keunggulan-hero h1 span {
        color: #f5b93b;
    }

    .keunggulan-hero p {
        color: #d7dff3;
        font-size: 16px;
        margin-top: 10px;
    }

    .keunggulan-section {
        padding: 60px 0;
    }

    .keunggulan-card {
        background: white;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 8px 25px rgba(0,0,0,.07);
        height: 100%;
        transition: .3s;
        border-left: 4px solid #f5b93b;
    }

    .keunggulan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,.12);
    }

    .keunggulan-card .icon {
        font-size: 40px;
        margin-bottom: 16px;
    }

    .keunggulan-card h4 {
        font-weight: 700;
        color: #071739;
        margin-bottom: 10px;
    }

    .keunggulan-card p {
        color: #666;
        font-size: 14px;
        line-height: 1.8;
        margin: 0;
    }

    .compare-section {
        background: #f4f7fb;
        padding: 60px 0;
    }

    .compare-section h2 {
        font-weight: 800;
        color: #071739;
        text-align: center;
        margin-bottom: 40px;
    }

    .compare-table {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,.07);
    }

    .compare-table table {
        width: 100%;
        margin: 0;
    }

    .compare-table thead {
        background: #071739;
        color: white;
    }

    .compare-table thead th {
        padding: 18px 24px;
        font-weight: 700;
        font-size: 15px;
    }

    .compare-table thead th.highlight {
        background: #f5b93b;
        color: #071739;
        text-align: center;
    }

    .compare-table tbody tr {
        border-bottom: 1px solid #f0f0f0;
    }

    .compare-table tbody tr:last-child {
        border-bottom: none;
    }

    .compare-table tbody td {
        padding: 16px 24px;
        font-size: 14px;
        color: #444;
    }

    .compare-table tbody td.highlight {
        background: #fffbf0;
        text-align: center;
        font-weight: 600;
        color: #071739;
    }

    .check { color: #1a9e5c; font-size: 18px; }
    .cross { color: #e74c3c; font-size: 18px; }

    .cta-section {
        background: #071739;
        padding: 60px 0;
        text-align: center;
    }

    .cta-section h2 {
        color: white;
        font-weight: 800;
        font-size: 32px;
    }

    .cta-section p {
        color: #d7dff3;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')

<!-- HERO -->
<section class="keunggulan-hero">
    <div class="container">
        <h1>Kenapa Pilih <span>Pilar Abdi?</span></h1>
        <p>Bukan sekadar bimbel biasa. Kami hadir untuk memastikan kamu benar-benar lolos.</p>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="keunggulan-section">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <div class="keunggulan-card">
                    <div class="icon">👨‍🏫</div>
                    <h4>Mentor Berpengalaman</h4>
                    <p>Semua mentor Pilar Abdi adalah alumni sekolah kedinasan aktif yang sudah teruji. Mereka tahu persis pola soal dan trik yang dibutuhkan untuk lolos.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="keunggulan-card">
                    <div class="icon">📊</div>
                    <h4>Analisis Hasil Try Out</h4>
                    <p>Setiap try out dilengkapi laporan detail per sub-tes. Kamu bisa lihat grafik perkembangan skor dan tahu persis bagian mana yang perlu diperkuat.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="keunggulan-card">
                    <div class="icon">🎯</div>
                    <h4>Materi Sesuai Kisi-Kisi</h4>
                    <p>Materi kami selalu diperbarui sesuai kisi-kisi resmi SKD terbaru. Tidak ada waktu yang terbuang untuk belajar hal yang tidak keluar di ujian.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="keunggulan-card">
                    <div class="icon">🕐</div>
                    <h4>Belajar Fleksibel</h4>
                    <p>Semua sesi live direkam dan bisa diakses kapan saja. Cocok untuk kamu yang masih kuliah atau bekerja sambil mempersiapkan diri.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="keunggulan-card">
                    <div class="icon">💬</div>
                    <h4>Komunitas Aktif</h4>
                    <p>Bergabung dengan ribuan peserta lain di grup eksklusif. Saling berbagi info, motivasi, dan tips lolos setiap harinya.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="keunggulan-card">
                    <div class="icon">💰</div>
                    <h4>Harga Transparan</h4>
                    <p>Tidak ada biaya tersembunyi. Semua fasilitas sudah termasuk dalam harga paket. Bisa dicicil 2x tanpa bunga untuk meringankan beban biaya.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- PERBANDINGAN -->
<section class="compare-section">
    <div class="container">
        <h2>Pilar Abdi vs Bimbel Lain</h2>
        <div class="compare-table">
            <table>
                <thead>
                    <tr>
                        <th>Fitur</th>
                        <th class="highlight">⭐ Pilar Abdi</th>
                        <th style="text-align:center;">Bimbel Lain</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mentor alumni kedinasan aktif</td>
                        <td class="highlight"><span class="check">✔</span></td>
                        <td style="text-align:center;"><span class="cross">✘</span></td>
                    </tr>
                    <tr>
                        <td>Analisis skor try out detail</td>
                        <td class="highlight"><span class="check">✔</span></td>
                        <td style="text-align:center;"><span class="cross">✘</span></td>
                    </tr>
                    <tr>
                        <td>Video rekaman semua sesi</td>
                        <td class="highlight"><span class="check">✔</span></td>
                        <td style="text-align:center;"><span class="cross">✘</span></td>
                    </tr>
                    <tr>
                        <td>Konsultasi pribadi 1-on-1</td>
                        <td class="highlight"><span class="check">✔</span></td>
                        <td style="text-align:center;"><span class="cross">✘</span></td>
                    </tr>
                    <tr>
                        <td>Materi diperbarui tiap tahun</td>
                        <td class="highlight"><span class="check">✔</span></td>
                        <td style="text-align:center;"><span class="cross">✘</span></td>
                    </tr>
                    <tr>
                        <td>Cicilan tanpa bunga</td>
                        <td class="highlight"><span class="check">✔</span></td>
                        <td style="text-align:center;"><span class="cross">✘</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2>Mulai Persiapan Terbaikmu</h2>
        <p>Ribuan siswa sudah membuktikan. Sekarang giliran kamu.</p>
        <a href="{{ url('/pendaftaran') }}" class="btn mt-4" style="background:#f5b93b;color:#071739;font-weight:700;border-radius:12px;padding:14px 32px;">
            Daftar Sekarang
        </a>
    </div>
</section>

@endsection