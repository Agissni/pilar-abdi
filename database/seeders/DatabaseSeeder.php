<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat atau update akun admin default
        User::updateOrCreate(
            ['email' => 'admin@pilarabdi.id'],
            [
                'name'     => 'Admin Pilar Abdi',
                'password' => Hash::make('Pilaradmin26!'),
                'role'     => 'admin',
                'status'   => 'active',
                'whatsapp' => '081234567890',
            ]
        );

        // 2. Buat atau update akun siswa contoh (opsional untuk testing)
        User::updateOrCreate(
            ['email' => 'siswa@pilarabdi.id'],
            [
                'name'     => 'Siswa Contoh',
                'password' => Hash::make('siswa123'),
                'role'     => 'siswa',
                'status'   => 'active',
                'whatsapp' => '089876543210',
                'package'  => 'Paket Premium',
                'sekdin'   => 'PKN STAN',
                'address'  => 'Jakarta, Indonesia',
            ]
        );

        // 3. Bersihkan data guru lama untuk menghindari data usang/duplikat
        Guru::query()->delete();

        // 4. Buat 3 akun guru baru (1 guru untuk 1 materi/spesialisasi)
        // Guru TWK
        $guruSri = Guru::create([
            'nama'         => 'Sri Wahyuni, S.Pd.',
            'spesialisasi' => 'TWK',
            'whatsapp'     => '081234567801',
            'email'        => 'sri.twk@pilarabdi.id',
            'password'     => Hash::make('guru111'),
            'bio'          => 'Guru spesialis Tes Wawasan Kebangsaan (TWK) dengan pengalaman membimbing materi UUD 1945, Pancasila, dan Sejarah Nasional.',
        ]);

        // Guru TIU
        $guruBudi = Guru::create([
            'nama'         => 'Budi Santoso, M.Pd.',
            'spesialisasi' => 'TIU',
            'whatsapp'     => '083178560055',
            'email'        => 'budi.tiu@pilarabdi.id',
            'password'     => Hash::make('guru222'),
            'bio'          => 'Guru spesialis Tes Inteligensia Umum (TIU) dengan metode hitung cepat dan logika penalaran analitis.',
        ]);

        // Guru TKP
        $guruDewi = Guru::create([
            'nama'         => 'Dewi Lestari, S.Psi.',
            'spesialisasi' => 'TKP',
            'whatsapp'     => '081234567803',
            'email'        => 'dewi.tkp@pilarabdi.id',
            'password'     => Hash::make('guru333'),
            'bio'          => 'Guru spesialis Tes Karakteristik Pribadi (TKP) yang fokus pada pembinaan integritas, jejaring kerja, dan pelayanan publik.',
        ]);

        // 5. Seed default announcements
        \App\Models\Pengumuman::updateOrCreate(
            ['judul' => '📣 Uji Coba Tryout CAT Nasional Gelombang II'],
            [
                'isi' => 'Simulasi Tryout CAT Nasional untuk seluruh sekolah kedinasan akan dilaksanakan secara serentak pada tanggal 12-14 Juli 2026. Pastikan Anda sudah mempersiapkan diri.',
                'tanggal_publikasi' => '2026-07-06 00:00:00',
                'status' => 'aktif',
            ]
        );

        \App\Models\Pengumuman::updateOrCreate(
            ['judul' => '📚 Tambahan Kelas Pendalaman TIU & TWK'],
            [
                'isi' => 'Akan diadakan kelas tambahan materi Analisis Figural & Pilar Kebangsaan pada hari Sabtu, 11 Juli 2026 jam 19.30 WIB. Link Zoom akan dibagikan di menu Kelas.',
                'tanggal_publikasi' => '2026-07-05 00:00:00',
                'status' => 'aktif',
            ]
        );

        \App\Models\Pengumuman::updateOrCreate(
            ['judul' => '💳 Batas Akhir Verifikasi Pembayaran'],
            [
                'isi' => 'Bagi siswa yang baru mendaftar, harap segera mengunggah bukti pembayaran di menu Pembayaran agar akun Anda dapat diverifikasi secara penuh oleh admin.',
                'tanggal_publikasi' => '2026-07-04 00:00:00',
                'status' => 'aktif',
            ]
        );

        // 6. Seed default Tryout
        $tryout = \App\Models\Tryout::updateOrCreate(
            ['nama_tryout' => 'Try Out CAT SKD Nasional I'],
            [
                'deskripsi' => 'Simulasi Try Out CAT SKD Kedinasan Nasional pertama dengan materi lengkap TWK, TIU, TKP.',
                'durasi' => 100,
                'jumlah_soal' => 3,
                'tanggal_mulai' => '2026-07-01 00:00:00',
                'tanggal_berakhir' => '2026-07-31 23:59:59',
                'status' => 'aktif',
            ]
        );

        // 7. Seed default questions for this Tryout
        \App\Models\TryoutQuestion::updateOrCreate(
            ['id_tryout' => $tryout->id_tryout, 'nomor_soal' => 1],
            [
                'kategori' => 'TWK',
                'pertanyaan' => 'Undang-Undang Dasar Negara Republik Indonesia Tahun 1945 disahkan pada tanggal...',
                'pilihan_a' => '17 Agustus 1945',
                'pilihan_b' => '18 Agustus 1945',
                'pilihan_c' => '19 Agustus 1945',
                'pilihan_d' => '20 Agustus 1945',
                'pilihan_e' => '21 Agustus 1945',
                'jawaban_benar' => 'B',
                'pembahasan' => 'UUD 1945 disahkan oleh PPKI pada tanggal 18 Agustus 1945, sehari setelah proklamasi kemerdekaan.'
            ]
        );

        \App\Models\TryoutQuestion::updateOrCreate(
            ['id_tryout' => $tryout->id_tryout, 'nomor_soal' => 2],
            [
                'kategori' => 'TIU',
                'pertanyaan' => 'Jika x = 5 dan y = 3, maka nilai dari x^2 - y^2 adalah...',
                'pilihan_a' => '8',
                'pilihan_b' => '16',
                'pilihan_c' => '25',
                'pilihan_d' => '34',
                'pilihan_e' => '40',
                'jawaban_benar' => 'B',
                'pembahasan' => 'x^2 - y^2 = (5^2) - (3^2) = 25 - 9 = 16.'
            ]
        );

        \App\Models\TryoutQuestion::updateOrCreate(
            ['id_tryout' => $tryout->id_tryout, 'nomor_soal' => 3],
            [
                'kategori' => 'TKP',
                'pertanyaan' => 'Anda melihat rekan kerja Anda sedang kesulitan menyelesaikan pekerjaannya karena sistem komputer yang lambat, tindakan Anda...',
                'pilihan_a' => 'Mendiamkannya karena itu bukan tugas saya',
                'pilihan_b' => 'Melaporkan ke atasan agar diganti komputernya',
                'pilihan_c' => 'Membantu menyelesaikannya setelah pekerjaan saya sendiri selesai',
                'pilihan_d' => 'Memarahinya karena bekerja lamban',
                'pilihan_e' => 'Menyuruhnya pulang saja',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Membantu rekan kerja setelah pekerjaan kita selesai mencerminkan sikap profesionalisme dan jejaring kerja.'
            ]
        );

        // 8. Find seeded student and seed tryout attempt
        $student = \App\Models\User::where('email', 'siswa@pilarabdi.id')->first();
        if ($student) {
            \App\Models\TryoutAttempt::updateOrCreate(
                [
                    'id_user' => $student->id_user,
                    'id_tryout' => $tryout->id_tryout,
                ],
                [
                    'score_twk' => 85,
                    'score_tiu' => 110,
                    'score_tkp' => 175,
                    'score_total' => 370,
                    'status' => 'lulus',
                ]
            );
        }

        // 9. Seed default classes and link to Guru
        $kelasTwk = \App\Models\Kelas::create([
            'nama_kelas' => 'Kelas Pendalaman TWK',
            'materi' => 'TWK',
            'id_guru' => $guruSri->id_guru,
            'hari' => 'Senin',
            'jam' => '19.00 - 21.00 WIB',
            'deskripsi' => 'Fokus materi Pilar Kebangsaan, Pancasila, dan UUD 1945.',
            'gmeet_link' => 'https://meet.google.com/abc-defg-hij',
        ]);

        $kelasTiu = \App\Models\Kelas::create([
            'nama_kelas' => 'Kelas TIU Penalaran Numerik',
            'materi' => 'TIU',
            'id_guru' => $guruBudi->id_guru,
            'hari' => 'Rabu',
            'jam' => '19.00 - 21.00 WIB',
            'deskripsi' => 'Strategi cepat perhitungan aljabar, perbandingan kuantitatif, dan deret angka.',
            'gmeet_link' => 'https://meet.google.com/klm-nopq-rst',
        ]);

        $kelasTkp = \App\Models\Kelas::create([
            'nama_kelas' => 'Kelas Aspek Karakteristik Pribadi',
            'materi' => 'TKP',
            'id_guru' => $guruDewi->id_guru,
            'hari' => 'Jumat',
            'jam' => '19.00 - 21.00 WIB',
            'deskripsi' => 'Latihan studi kasus kepribadian, sosial budaya, dan profesionalisme pelayanan publik.',
            'gmeet_link' => 'https://meet.google.com/uvw-xyza-bcd',
        ]);

        // Link student to all classes
        if ($student) {
            \Illuminate\Support\Facades\DB::table('kelas_siswa')->insert([
                ['id_user' => $student->id_user, 'id_kelas' => $kelasTwk->id_kelas, 'created_at' => now(), 'updated_at' => now()],
                ['id_user' => $student->id_user, 'id_kelas' => $kelasTiu->id_kelas, 'created_at' => now(), 'updated_at' => now()],
                ['id_user' => $student->id_user, 'id_kelas' => $kelasTkp->id_kelas, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}

