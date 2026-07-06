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
                'password' => Hash::make('admin123'),
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
        Guru::create([
            'nama'         => 'Sri Wahyuni, S.Pd.',
            'spesialisasi' => 'TWK',
            'whatsapp'     => '081234567801',
            'email'        => 'sri.twk@pilarabdi.id',
            'password'     => Hash::make('guru111'),
            'bio'          => 'Guru spesialis Tes Wawasan Kebangsaan (TWK) dengan pengalaman membimbing materi UUD 1945, Pancasila, dan Sejarah Nasional.',
        ]);

        // Guru TIU
        Guru::create([
            'nama'         => 'Budi Santoso, M.Pd.',
            'spesialisasi' => 'TIU',
            'whatsapp'     => '081234567802',
            'email'        => 'budi.tiu@pilarabdi.id',
            'password'     => Hash::make('guru222'),
            'bio'          => 'Guru spesialis Tes Inteligensia Umum (TIU) dengan metode hitung cepat dan logika penalaran analitis.',
        ]);

        // Guru TKP
        Guru::create([
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
    }
}

