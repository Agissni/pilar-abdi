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
                    <p class="isi">"Materinya terstruktur dan jelas. Aku nggak lagi bingung mau mulai dari mana untuk persiapan sekolah kedinasan."</p>
                    <div class="profil">
                        <div class="avatar">A</div>
                        <div>
                            <p class="nama">Agnes Putri <span class="badge-lulus">Lolos STIS</span></p>
                            <p class="sekolah">STIS 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Fasilitas belajarnya nyaman, dan kelas online bisa diulang kalau belum paham. Bimbingan langsung ke sasaran."</p>
                    <div class="profil">
                        <div class="avatar">D</div>
                        <div>
                            <p class="nama">Dwi Kurniawan <span class="badge-lulus">Lolos STMKG</span></p>
                            <p class="sekolah">STMKG 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Tim mentor cepat merespon chat. Jadi aku bisa belajar tanpa menunggu lama, materi pun selalu up to date."</p>
                    <div class="profil">
                        <div class="avatar">I</div>
                        <div>
                            <p class="nama">Indra Santoso <span class="badge-lulus">Lolos POLTEKSSN</span></p>
                            <p class="sekolah">Poltek SSN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Suasana belajarnya asik dan nggak monoton. Banyak latihan langsung jadi lebih siap menghadapi ujian."</p>
                    <div class="profil">
                        <div class="avatar">E</div>
                        <div>
                            <p class="nama">Elena Rahma <span class="badge-lulus">Lolos POLTEKIM</span></p>
                            <p class="sekolah">Poltekim 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Pembahasan soal detail sekali. Aku jadi ngerti kenapa jawabannya seperti itu, bukan sekadar hafalan."</p>
                    <div class="profil">
                        <div class="avatar">N</div>
                        <div>
                            <p class="nama">Nadia Fitri <span class="badge-lulus">Lolos POLTEKIP</span></p>
                            <p class="sekolah">Poltekip 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Kelas reviewnya membantu banget menjelaskan kesalahan yang sering saya buat saat latihan."</p>
                    <div class="profil">
                        <div class="avatar">M</div>
                        <div>
                            <p class="nama">Mira Saraswati <span class="badge-lulus">Lolos POLTEKIM</span></p>
                            <p class="sekolah">Poltekim 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Pembayaran mudah dan proses konfirmasinya cepat. Setelah bayar, akun langsung siap dipakai."</p>
                    <div class="profil">
                        <div class="avatar">W</div>
                        <div>
                            <p class="nama">Wulan Hidayat <span class="badge-lulus">Lolos STIN</span></p>
                            <p class="sekolah">STIN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Kelasnya fleksibel dan bisa diakses kapan saja. Sangat cocok untuk siswa yang punya jadwal padat."</p>
                    <div class="profil">
                        <div class="avatar">T</div>
                        <div>
                            <p class="nama">Tegar Gunawan <span class="badge-lulus">Lolos PKN STAN</span></p>
                            <p class="sekolah">PKN STAN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Materi digitalnya lengkap banget dan update. Nggak perlu bingung cari sumber lain lagi."</p>
                    <div class="profil">
                        <div class="avatar">L</div>
                        <div>
                            <p class="nama">Lia Kartika <span class="badge-lulus">Lolos IPDN</span></p>
                            <p class="sekolah">IPDN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Sistem tryoutnya mirip ujian asli, jadi aku nggak kaget saat hari tes."</p>
                    <div class="profil">
                        <div class="avatar">P</div>
                        <div>
                            <p class="nama">Putri Ananda <span class="badge-lulus">Lolos STIS</span></p>
                            <p class="sekolah">STIS 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Pendekatan belajarnya sistematis dan bikin saya lebih percaya diri saat mengerjakan soal."</p>
                    <div class="profil">
                        <div class="avatar">C</div>
                        <div>
                            <p class="nama">Chandra Putra <span class="badge-lulus">Lolos POLTEKSSN</span></p>
                            <p class="sekolah">Poltek SSN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Dari awal sampai akhir bimbingan, pelatihnya sabar dan jelas dalam menjelaskan konsep."</p>
                    <div class="profil">
                        <div class="avatar">H</div>
                        <div>
                            <p class="nama">Hana Salsabila <span class="badge-lulus">Lolos POLTEKIP</span></p>
                            <p class="sekolah">Poltekip 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Pembimbingnya selalu memberikan motivasi supaya nggak cepat menyerah. Itu sangat membantu mental saat belajar."</p>
                    <div class="profil">
                        <div class="avatar">Y</div>
                        <div>
                            <p class="nama">Yudha Pratama <span class="badge-lulus">Lolos PKN STAN</span></p>
                            <p class="sekolah">PKN STAN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Proses belajarnya terencana, jadi setiap minggu ada target yang jelas untuk dicapai."</p>
                    <div class="profil">
                        <div class="avatar">Z</div>
                        <div>
                            <p class="nama">Zahra Aulia <span class="badge-lulus">Lolos IPDN</span></p>
                            <p class="sekolah">IPDN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Fleksibelnya sesi diskusi membuat aku bisa bertanya langsung setiap kali stuck."</p>
                    <div class="profil">
                        <div class="avatar">K</div>
                        <div>
                            <p class="nama">Kevin Wijaya <span class="badge-lulus">Lolos STIN</span></p>
                            <p class="sekolah">STIN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Materi tambahan dan pembahasan paket soal sangat membantu persiapan ujian masuk."</p>
                    <div class="profil">
                        <div class="avatar">B</div>
                        <div>
                            <p class="nama">Bima Adhitya <span class="badge-lulus">Lolos STIS</span></p>
                            <p class="sekolah">STIS 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Support admin dan pengingat kelasnya membuat jadwal belajarku tetap teratur."</p>
                    <div class="profil">
                        <div class="avatar">J</div>
                        <div>
                            <p class="nama">Jenna Permata <span class="badge-lulus">Lolos POLTEKSSN</span></p>
                            <p class="sekolah">Poltek SSN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Bimbingannya terstruktur mulai dari teori sampai latihan soal. Jadi aku nggak stuck di satu materi."</p>
                    <div class="profil">
                        <div class="avatar">G</div>
                        <div>
                            <p class="nama">Gina Larasati <span class="badge-lulus">Lolos POLTEKIM</span></p>
                            <p class="sekolah">Poltekim 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Akun dan materi pembelajarannya lengkap, jadi bisa diakses kapan saja saat butuh review."</p>
                    <div class="profil">
                        <div class="avatar">Q</div>
                        <div>
                            <p class="nama">Qori Maulana <span class="badge-lulus">Lolos POLTEKIP</span></p>
                            <p class="sekolah">Poltekip 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Fokusnya betul-betul ke persiapan ujian. Bukan sekadar materi, tapi juga strategi menghadapi soal."</p>
                    <div class="profil">
                        <div class="avatar">O</div>
                        <div>
                            <p class="nama">Oktavianus <span class="badge-lulus">Lolos PKN STAN</span></p>
                            <p class="sekolah">PKN STAN 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimoni-card">
                    <div class="stars">★★★★★</div>
                    <p class="isi">"Fokus pembelajarannya sesuai dengan kebutuhan tes kedinasan. Materi, tryout, dan bimbingannya membantu saya lebih siap menghadapi proses seleksi"</p>
                    <div class="profil">
                        <div class="avatar">O</div>
                        <div>
                            <p class="nama">Cahyo Prianto, S.Pd., M.T<span class="badge-lulus">Lolos IPDN</span></p>
                            <p class="sekolah">IPDN 2026</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
