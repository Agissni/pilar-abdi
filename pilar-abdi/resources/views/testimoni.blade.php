@extends('layouts.app')

@section('title', 'Testimoni')

@section('styles')
<style>
    .testimoni-hero {
        background: #071739;
        padding: 80px 0 60px;
        text-align: center;
    }

    .testimoni-hero h1 {
        color: white;
        font-size: 42px;
        font-weight: 800;
    }

    .testimoni-hero h1 span {
        color: #f5b93b;
    }

    .testimoni-hero p {
        color: #d7dff3;
        font-size: 16px;
        margin-top: 10px;
    }

    .testimoni-section {
        padding: 60px 0;
    }

    .testimoni-card {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 8px 25px rgba(0,0,0,.07);
        height: 100%;
        transition: .3s;
    }

    .testimoni-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,.12);
    }

    .testimoni-card .stars {
        color: #f5b93b;
        font-size: 18px;
        margin-bottom: 14px;
    }

    .testimoni-card .isi {
        color: #444;
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .testimoni-card .profil {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .testimoni-card .avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #071739;
        color: #f5b93b;
        font-size: 20px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .testimoni-card .nama {
        font-weight: 700;
        color: #071739;
        font-size: 15px;
        margin: 0;
    }

    .testimoni-card .sekolah {
        font-size: 13px;
        color: #888;
        margin: 0;
    }

    .badge-lulus {
        background: #e8f8f0;
        color: #1a9e5c;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
        margin-left: 8px;
    }

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
<section class="testimoni-hero">
    <div class="container">
        <h1>Kata Mereka yang <span>Sudah Lolos</span></h1>
        <p>Ribuan siswa telah membuktikan. Sekarang giliran kamu.</p>
    </div>
</section>

<!-- TESTIMONI -->
<section class="testimoni-section">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Awalnya aku ngerasa materi SKD itu susah banget, tapi setelah ikut Pilar Abdi jadi jauh lebih paham. Mentor-mentornya sabar dan selalu siap bantu kalau ada yang bingung."</p>
                    <div class="profil">
                        <div class="avatar">R</div>
                        <div>
                            <p class="nama">Rizky Aditya <span class="badge-lulus">Lolos STAN</span></p>
                            <p class="sekolah">PKN STAN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Try out rutinnya beneran membantu banget. Aku jadi tau kelemahan di bagian mana dan bisa fokus benerin sebelum hari H. Alhamdulillah tembus IPDN!"</p>
                    <div class="profil">
                        <div class="avatar">S</div>
                        <div>
                            <p class="nama">Sinta Maharani <span class="badge-lulus">Lolos IPDN</span></p>
                            <p class="sekolah">IPDN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Konsultasi 1-on-1 nya itu yang paling berasa manfaatnya. Bisa nanya langsung ke mentor tanpa takut dihakimi. Strategi belajarnya juga disesuaikan sama kebutuhan aku."</p>
                    <div class="profil">
                        <div class="avatar">F</div>
                        <div>
                            <p class="nama">Farhan Maulana <span class="badge-lulus">Lolos STIN</span></p>
                            <p class="sekolah">STIN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Materi videonya lengkap dan bisa diulang-ulang. Aku sering nonton ulang pas lagi commute. Grup WA-nya juga aktif, jadi ngerasa punya teman belajar meski beda kota."</p>
                    <div class="profil">
                        <div class="avatar">N</div>
                        <div>
                            <p class="nama">Nadya Putri <span class="badge-lulus">Lolos POLTEKIM</span></p>
                            <p class="sekolah">POLTEKIM 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Ikut Pilar Abdi dari nol, sama sekali belum paham SKD. 6 bulan kemudian alhamdulillah lolos. Harganya worth it banget dibanding bimbel lain yang pernah aku coba."</p>
                    <div class="profil">
                        <div class="avatar">D</div>
                        <div>
                            <p class="nama">Dimas Saputra <span class="badge-lulus">Lolos STAN</span></p>
                            <p class="sekolah">PKN STAN 2023</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Rekap materi mingguan itu sangat membantu aku yang susah fokus. Semua dirangkum singkat dan jelas. Mentor juga rajin follow up progress belajar tiap minggu."</p>
                    <div class="profil">
                        <div class="avatar">A</div>
                        <div>
                            <p class="nama">Ayu Lestari <span class="badge-lulus">Lolos IPDN</span></p>
                            <p class="sekolah">IPDN 2023</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2>Siap Jadi Alumni Berikutnya?</h2>
        <p>Bergabung sekarang dan mulai perjalanan lolos kedinasan kamu bersama Pilar Abdi.</p>
        <a href="{{ url('/pendaftaran') }}" class="btn btn-gold mt-4" style="background:#f5b93b;color:#071739;font-weight:700;border-radius:12px;padding:14px 32px;">
            Daftar Sekarang
        </a>
    </div>
</section>

@endsection