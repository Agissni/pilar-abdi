# BAB 5 IMPLEMENTASI DASAR

## 5.1 Tools dan Teknologi
Pengembangan aplikasi **Pilar Abdi** pada direktori `C:\xampp\htdocs\pilar-abdi` memanfaatkan susunan teknologi modern yang diklasifikasikan sebagai berikut:

### 1. Perangkat Lunak Sisi Server & DBMS (Backend & Database)
* **PHP 8.2**: Bahasa pemrograman server-side utama dengan paradigma Object-Oriented Programming (OOP).
* **Laravel 12.x**: Kerangka kerja (framework) MVC PHP yang digunakan untuk menyederhanakan pengelolaan rute (*routing*), validasi input, autentikasi session, proteksi middleware, ORM Eloquent, dan templating engine.
* **MySQL**: Relational Database Management System (RDBMS) yang digunakan untuk menyimpan data pengguna, riwayat pembayaran, data guru, kelas, tryout, dan soal-soal.
* **XAMPP Control Panel (v3.3.0 atau terbaru)**: Perangkat lunak bundel server lokal yang menyediakan server web Apache dan DBMS MySQL untuk menjalankan aplikasi secara lokal.

### 2. Perangkat Lunak Sisi Klien (Frontend)
* **HTML5**: Menyusun struktur kerangka semantik halaman web.
* **CSS3 & Bootstrap 5**: Digunakan sebagai kerangka kerja styling visual yang responsif. Bootstrap 5 diimpor via Vite ke dalam aset proyek (`resources/css/app.css`) untuk menyusun layout grid, tombol, tabel, dan komponen kartu.
* **JavaScript (Vanilla JS & ES6)**: Digunakan untuk memberikan interaksi dinamis pada sisi klien, seperti pengukur waktu mundur (timer) tryout, modal konfirmasi, penanganan upload berkas, dan visualisasi interaktif lainnya.

### 3. Lingkungan Pengembangan & Pustaka Pendukung
* **Composer v2.x**: Pengelola paket dependensi pustaka PHP.
* **Node.js & npm**: Digunakan untuk menjalankan bundler aset **Vite** yang mengompilasi file CSS dan JS untuk disajikan ke browser.

---

## 5.2 Struktur Folder
Hierarki direktori proyek **Pilar Abdi** diatur mengikuti struktur standar framework Laravel 12 yang modular, rapi, dan bersih. Berikut adalah visualisasi struktur folder utama:

```text
pilar-abdi/
├── app/                      --> Konten utama logika aplikasi PHP
│   ├── Http/
│   │   ├── Controllers/      --> Pengolah data (AdminController, PaymentController, dll.)
│   │   └── Middleware/       --> Filter hak akses (Admin, Guru, Siswa middleware)
│   └── Models/               --> Definisi entitas database (User.php, Kelas.php, dll.)
├── bootstrap/                --> Berkas inisialisasi awal sistem Laravel
├── config/                   --> File konfigurasi sistem (database, sekdins, app)
├── database/                 --> Manajemen database
│   ├── migrations/           --> File migrasi pembuat tabel MySQL
│   └── seeders/              --> File pengisi data awal (DatabaseSeeder.php)
├── public/                   --> Direktori publik & aset web yang dapat diakses browser
│   ├── assets/               --> File gambar logo instansi, gambar latar belakang, dsb.
│   └── index.php             --> Pintu masuk awal (Entry point) aplikasi
├── resources/                --> Aset mentah & file tampilan
│   ├── css/                  --> File CSS mentah (app.css mengimpor Bootstrap 5)
│   ├── js/                   --> File JavaScript mentah (app.js)
│   └── views/                --> File template Blade HTML (admin/, guru/, siswa/, public/)
├── routes/                   --> Pemetaan URL/rute aplikasi
│   └── web.php               --> Rute utama web (login, register, dashboard, dll.)
├── storage/                  --> Penyimpanan lokal (log sistem, cache, berkas unggahan bukti bayar)
├── tests/                    --> Berkas unit & feature testing program
├── .env                      --> File konfigurasi variabel lingkungan (koneksi MySQL)
├── composer.json             --> Konfigurasi dependensi PHP & perintah instalasi
├── package.json              --> Konfigurasi dependensi JavaScript
└── vite.config.js            --> Konfigurasi bundler Vite untuk memproses CSS/JS
```

---

## 5.3 Petunjuk Menjalankan Aplikasi
Berikut adalah langkah-langkah detail untuk menginstal dan menjalankan aplikasi **Pilar Abdi** di komputer lokal (localhost):

### Langkah 1: Persiapan Lingkungan XAMPP
1. Pastikan folder proyek sudah diletakkan di direktori server web lokal Anda, yaitu di:
   `C:\xampp\htdocs\pilar-abdi\`
2. Buka aplikasi **XAMPP Control Panel** di komputer Anda.
3. Klik tombol **Start** pada modul **Apache** dan **MySQL** hingga indikatornya berubah menjadi warna hijau (menandakan port `80/443` dan `3306` telah aktif).

### Langkah 2: Pembuatan Database di MySQL
1. Buka browser internet Anda (Chrome/Firefox/Edge).
2. Akses halaman phpMyAdmin melalui tautan: `http://localhost/phpmyadmin/`
3. Buat database baru dengan mengklik menu **New**, lalu ketikkan nama database: `pilar_abdi` dan klik tombol **Create**.

### Langkah 3: Konfigurasi File Lingkungan (`.env`)
1. Buka file bernama `.env` di folder `C:\xampp\htdocs\pilar-abdi\pilar-abdi\.env` menggunakan editor teks (seperti VS Code atau Notepad).
2. Pastikan baris konfigurasi database terisi sebagai berikut:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pilar_abdi
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Simpan perubahan file `.env` jika ada yang diedit.

### Langkah 4: Instalasi Dependensi & Migrasi Database
Jika Anda menjalankan aplikasi melalui terminal perintah (Command Prompt / PowerShell), jalankan perintah-perintah berikut di dalam direktori `C:\xampp\htdocs\pilar-abdi\pilar-abdi\`:

1. **Instalasi Paket PHP**:
   ```bash
   composer install
   ```
2. **Generasi Application Key**:
   ```bash
   php artisan key:generate
   ```
3. **Eksekusi Migrasi & Seed Data Awal** (membuat tabel & memasukkan data contoh seperti akun admin, guru, pengumuman):
   ```bash
   php artisan migrate --seed
   ```
4. **Instalasi & Kompilasi Aset Frontend**:
   ```bash
   npm install
   npm run build
   ```

### Langkah 5: Mengakses Aplikasi di Browser
Setelah seluruh konfigurasi selesai, Anda dapat menjalankan server pengembangan bawaan Laravel dengan mengetikkan:
```bash
php artisan serve
```
Dan membukanya melalui alamat:
`http://127.0.0.1:8000`

Atau, jika Anda ingin mengaksesnya secara langsung melalui konfigurasi virtual host Apache XAMPP, Anda dapat membukanya melalui URL:
`http://localhost/pilar-abdi/pilar-abdi/public/`
*(Silakan sesuaikan konfigurasi folder publik web server Anda).*

* Kredensial login pengujian default:
  * **Admin**: `admin@pilarabdi.id` | Password: `admin123`
  * **Siswa**: `siswa@pilarabdi.id` | Password: `siswa123`
  * **Guru**: `sri.twk@pilarabdi.id` | Password: `guru111` (Materi TWK)
