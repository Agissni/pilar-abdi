# Portal Bimbingan Belajar & Tryout CAT SKD - Pilar Abdi

Portal Bimbingan Belajar dan Tryout CAT (Computer Assisted Test) SKD (Seleksi Kompetensi Dasar) **Pilar Abdi** adalah platform web terpadu yang dirancang untuk membantu calon taruna/praja sekolah kedinasan (seperti PKN STAN, IPDN, dll.) dalam mempersiapkan diri menghadapi seleksi SKD.

Aplikasi ini memfasilitasi kebutuhan belajar siswa melalui pendaftaran kelas bimbingan, simulasi tryout online CAT nasional, verifikasi pembayaran paket bimbingan, serta portal interaktif bagi admin, guru, dan siswa.

---

##  Fitur Utama Sistem

Platform ini memiliki 3 hak akses utama (aktor) dengan fitur-fitur sebagai berikut:

### 1. Portal Siswa
- **Dashboard Siswa**: Melihat ringkasan data akun, paket bimbingan (misal: Paket Premium), dan target sekolah kedinasan (misal: PKN STAN).
- **Modul Kelas Online**: Mengakses daftar kelas bimbingan privat/kelompok lengkap dengan detail jadwal, materi, guru pengajar, serta tautan langsung kelas tatap muka daring (Google Meet).
- **Simulasi Tryout CAT SKD**: Mengerjakan tryout online dengan format CAT yang terdiri dari kategori soal **TWK** (Tes Wawasan Kebangsaan), **TIU** (Tes Inteligensia Umum), dan **TKP** (Tes Karakteristik Pribadi).
- **Riwayat & Nilai Tryout**: Melihat skor masing-masing materi, pembahasan soal, skor total, serta status kelulusan berdasarkan ambang batas (*passing grade*).
- **Modul Pembayaran**: Mengunggah bukti transfer pembayaran kelas bimbingan untuk diverifikasi oleh admin.
- **Pusat Pengumuman**: Melihat pengumuman penting seputar ujian, kelas tambahan, dan info verifikasi pembayaran.

### 2. Portal Guru / Pengajar
- **Dashboard Guru**: Melihat bio spesialisasi mengajar (TWK, TIU, atau TKP).
- **Manajemen Kelas**: Mengatur jadwal bimbingan dan membagikan tautan pembelajaran online (Gmeet/Zoom).
- **Manajemen Tryout**: Memantau perkembangan hasil tryout siswa bimbingan mereka.

### 3. Portal Admin
- **Manajemen Pengguna**: Mengelola data siswa, data guru spesialisasi, dan penugasan kelas.
- **Manajemen Tryout & Soal**: Mengelola data tryout beserta daftar pertanyaan, pilihan ganda (A sampai E), kunci jawaban, dan penjelasan/pembahasan soal.
- **Verifikasi Pembayaran**: Melakukan validasi dan verifikasi bukti transfer siswa agar status paket bimbingan siswa menjadi aktif.
- **Manajemen Informasi**: Membuat, mengedit, dan mempublikasikan pengumuman penting bagi pengguna.

---

## 🛠️Teknologi yang Digunakan

- **Framework Backend/Frontend**: Laravel 11
- **Bahasa Pemrograman**: PHP
- **Database**: MySQL
- **Asset Bundler / Compiler**: Vite (untuk pemrosesan CSS & JavaScript)
- **Tampilan UI**: Blade Templating & CSS/Bootstrap

---

## 📦 Cara Instalasi Proyek di Localhost

Berikut adalah langkah-langkah untuk menjalankan aplikasi web ini di komputer lokal Anda:

1. **Persiapan Sistem**:
   - Pastikan Anda sudah menginstal PHP >= 8.2, Composer, Node.js, dan server lokal seperti **XAMPP**.

2. **Pengaturan Folder**:
   - Letakkan folder proyek `pilar-abdi` di dalam direktori root server lokal Anda (untuk XAMPP: `C:\xampp\htdocs\pilar-abdi`).

3. **Instal Dependensi PHP (Composer)**:
   - Buka terminal, masuk ke folder proyek utama:
     ```bash
     cd pilar-abdi/pilar-abdi
     ```
   - Jalankan instalasi dependensi PHP:
     ```bash
     composer install
     ```

4. **Instal Dependensi JavaScript (NPM)**:
   - Jalankan perintah berikut untuk mengunduh pustaka tampilan:
     ```bash
     npm install
     ```

5. **Konfigurasi Database & Environment (.env)**:
   - Salin file konfigurasi contoh `.env.example` menjadi `.env`:
     ```bash
     cp .env.example .env
     ```
   - Buka file `.env` di teks editor, lalu sesuaikan koneksi database Anda:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=pilar_abdi
     DB_USERNAME=root
     DB_PASSWORD=
     ```

6. **Generate Application Key**:
   - Jalankan perintah berikut untuk membuat key enkripsi aplikasi:
     ```bash
     php artisan key:generate
     ```

7. **Migrasi & Seed Database**:
   - Jalankan migrasi tabel database sekaligus mengisi data default akun dan materi (seeders):
     ```bash
     php artisan migrate --seed
     ```
   - *Catatan:* Perintah seed akan membuat akun uji coba default berikut:
     - **Admin**: `admin@pilarabdi.id` | Password: `Pilaradmin26!`
     - **Siswa**: `siswa@pilarabdi.id` | Password: `siswa123`
     - **Guru TWK**: `sri.twk@pilarabdi.id` | Password: `guru111`
     - **Guru TIU**: `budi.tiu@pilarabdi.id` | Password: `guru222`
     - **Guru TKP**: `dewi.tkp@pilarabdi.id` | Password: `guru333`

8. **Menjalankan Server Lokal**:
   - Jalankan Laravel Development Server:
     ```bash
     php artisan serve
     ```
   - Jalankan Vite Compiler (di terminal terpisah):
     ```bash
     npm run dev
     ```
   - Akses aplikasi web melalui browser di alamat: `http://127.0.0.1:8000`

---

## Menjalankan Pengujian Otomatis (Testing)

Untuk memastikan fungsionalitas berjalan dengan baik (seperti fitur Reset Password), Anda dapat menjalankan pengujian otomatis berbasis PHPUnit menggunakan perintah:

```bash
php artisan test
```
