# BAB 4 DESAIN ANTARMUKA

## 4.1 Konsep Desain
Desain antarmuka aplikasi **Pilar Abdi** didasarkan pada tiga pilar utama: **Kejelasan (Clarity)**, **Kesederhanaan (Simplicity)**, dan **Konsistensi (Consistency)**.
* **Layout Sederhana (Clean Layout)**: Memanfaatkan struktur grid Bootstrap 5 yang membagi layar menjadi area navigasi utama (sidebar di sisi kiri) dan area kerja/konten (di sisi kanan). Hal ini mencegah penumpukan elemen visual yang berlebihan sehingga pengguna dapat fokus pada materi pembelajaran atau tugas administratif.
* **Palet Warna Profesional**:
  * **Biru Royal (`#0d6efd`)**: Sebagai warna primer yang memunculkan kesan kredibilitas akademis, profesionalisme, dan kepercayaan diri.
  * **Biru Muda (`#e8f4fd`)**: Sebagai warna latar belakang dashboard dan komponen kartu (*cards*) untuk mengurangi ketegangan mata saat belajar.
  * **Hijau Zamrud (`#198754`)**: Sebagai aksen status aktif, tombol sukses, dan notifikasi kelulusan tryout.
  * **Merah Crimson (`#dc3545`)**: Sebagai petunjuk peringatan, tombol hapus, dan indikator status belum lunas/gagal.
* **Tipografi**: Menggunakan keluarga font sans-serif modern (`system-ui`, `Arial`) untuk memastikan teks terbaca dengan jelas baik di layar ponsel maupun desktop.
* **Navigasi Konsisten**: Menyediakan sidebar dinamis yang menyesuaikan peran pengguna (Admin, Guru, Siswa) untuk memudahkan akses halaman dengan maksimal 3 klik dari dashboard utama.

---

## 4.2 Mockup / Wireframe

Berikut adalah wireframe berbasis teks (ASCII Layout) untuk halaman-halaman utama aplikasi Pilar Abdi:

### 1. Halaman Login (`/login`)
```text
+-----------------------------------------------------------------+
|                                                                 |
|                      PILAR ABDI PORTAL                          |
|             "Gerbang Pembinaan Abdi Negara Muda"                |
|                                                                 |
|                     +---------------------+                     |
|                     |        LOGIN        |                     |
|                     +---------------------+                     |
|                     | Email Address       |                     |
|                     | [ siswa@email.com ] |                     |
|                     |                     |                     |
|                     | Password            |                     |
|                     | [ ************* ]   |                     |
|                     |                     |                     |
|                     | [ ] Ingat Saya      |                     |
|                     |                     |                     |
|                     |    (( LOGIN ))      |                     |
|                     +---------------------+                     |
|                     | Lupa Password?      |                     |
|                     | Belum punya akun?   |                     |
|                     | [Daftar Sekarang]   |                     |
|                     +---------------------+                     |
|                                                                 |
+-----------------------------------------------------------------+
```

### 2. Dashboard Utama Siswa (`/dashboard`)
```text
+-----------------------------------------------------------------+
|  [Logo] PILAR ABDI                      Halo, Siswa Contoh | LogOut |
+-----------------------------------------------------------------+
| (Sidebar)    |  [ Pengumuman Terbaru ]                         |
| > Dashboard  |  +--------------------------------------------+ |
| > Kelas      |  | 📣 Uji Coba Tryout CAT Nasional Gel. II     | |
| > Tryout     |  | Pelaksanaan: 12-14 Juli 2026               | |
| > Pembayaran |  +--------------------------------------------+ |
|              |                                                 |
|              |  [ Informasi Akun ]     [ Status Kelas ]        |
|              |  +-------------------+  +--------------------+  |
|              |  | Nama: Siswa Contoh|  | Kelas Aktif: 3     |  |
|              |  | Paket: Premium    |  | Sesi Terdekat:     |  |
|              |  | Status: ACTIVE    |  | TIU - 19.30 WIB    |  |
|              |  +-------------------+  +--------------------+  |
+-----------------------------------------------------------------+
```

### 3. Halaman Manajemen Soal Admin (`/admin/tryout/{id}/soal`)
```text
+-----------------------------------------------------------------+
|  [Logo] PILAR ABDI [Admin Panel]                        Admin | LogOut |
+-----------------------------------------------------------------+
| (Sidebar)    |  Daftar Soal Tryout: Tryout SKD Akbar            |
| > Dashboard  |  [ + Tambah Soal Baru ]                         |
| > Guru       |  +--------------------------------------------+ |
| > Kelas      |  | No | Kategori | Pertanyaan | Aksi          | |
| > Tryout     |  +----+----------+------------+---------------+ |
| > Pembayaran |  | 1  | TIU      | Berapa...  | [Edit] [Hapus]| |
| > Pengumuman |  | 2  | TWK      | Pancasila..| [Edit] [Hapus]| |
|              |  +----+----------+------------+---------------+ |
+-----------------------------------------------------------------+
```

### 4. Halaman Unggah Pembayaran (`/pembayaran`)
```text
+-----------------------------------------------------------------+
|  [Logo] PILAR ABDI                      Halo, Siswa Baru | LogOut  |
+-----------------------------------------------------------------+
| (Sidebar)    |  [ Unggah Bukti Transfer Pembayaran ]           |
| > Dashboard  |  +--------------------------------------------+ |
| > Kelas (x)  |  | Bank Pengirim    : [ Mandiri / BCA / BNI ] | |
| > Tryout (x) |  | Rekening Pengirim: [ 1234567890         ]  | |
| > Pembayaran |  | Nama Pengirim    : [ Ahmad Fauzi        ]  | |
|              |  | Jumlah Transfer  : [ Rp 1.500.000       ]  | |
|              |  | Bukti Fisik (JPG): [ Choose File...     ]  | |
|              |  |                                            | |
|              |  |            (( KIRIM BUKTI ))               | |
|              |  +--------------------------------------------+ |
+-----------------------------------------------------------------+
```

---

## 4.3 Deskripsi Tampilan

### 1. Deskripsi Tampilan Login
* **Fungsi**: Halaman pintu masuk untuk memverifikasi kredensial pengguna (Email dan Password) sebelum diizinkan mengakses data pribadi.
* **Elemen Kunci**:
  * **Input Email & Password**: Tempat mengetik email pendaftaran dan kata sandi.
  * **Tombol "LOGIN"**: Jika diklik, sistem akan mengirimkan data formulir ke `Auth\LoginController`. Jika kredensial cocok, pengguna diarahkan ke dashboard sesuai perannya.
  * **Tautan "Daftar Sekarang"**: Mengarahkan pengunjung baru ke formulir pendaftaran `/register`.

### 2. Deskripsi Tampilan Dashboard Siswa
* **Fungsi**: Halaman ringkasan informasi belajar dan pemberitahuan penting bagi siswa setelah berhasil masuk ke sistem.
* **Elemen Kunci**:
  * **Sidebar Menu**: Di sebelah kiri, berisi tautan navigasi ke halaman Dashboard, Kelas, Tryout, dan Pembayaran. Menu Kelas dan Tryout akan dinonaktifkan (dikunci) apabila status siswa masih `pending`.
  * **Card Pengumuman**: Kartu khusus di bagian atas yang memajang pengumuman terpopuler/terbaru yang diterbitkan oleh Admin.
  * **Card Status Akun**: Menampilkan nama siswa, paket bimbel yang diambil (misalnya: Paket Premium), dan lencana status akun (`ACTIVE` atau `PENDING`).

### 3. Deskripsi Tampilan Halaman Manajemen Soal Admin
* **Fungsi**: Digunakan oleh administrator untuk mengelola daftar soal yang ada di dalam suatu paket tryout tertentu.
* **Elemen Kunci**:
  * **Tombol "Tambah Soal Baru"**: Mengarahkan ke form pembuatan soal baru dengan isian pertanyaan, pilihan jawaban A-E, kunci jawaban, dan pembahasan.
  * **Tabel Soal**: Menampilkan nomor urut soal, kategori soal (TIU/TWK/TKP), potongan teks pertanyaan, serta kolom aksi.
  * **Tombol Aksi [Edit] & [Hapus]**:
    * Klik **[Edit]**: Membuka modal form edit untuk memperbarui teks soal atau kunci jawaban.
    * Klik **[Hapus]**: Memunculkan konfirmasi hapus data. Jika disetujui, data soal dihapus dari database secara permanen.

### 4. Deskripsi Tampilan Halaman Unggah Pembayaran
* **Fungsi**: Memfasilitasi siswa baru yang status akunnya masih `pending` untuk mengunggah bukti pembayaran pendaftaran agar divalidasi oleh admin.
* **Elemen Kunci**:
  * **Dropdown Bank & Input Text**: Mengisi bank asal, nomor rekening, nama pemilik rekening pengirim, dan jumlah uang yang ditransfer.
  * **Input File Upload**: Untuk memilih berkas gambar bukti transfer (.jpg/.png) dari memori perangkat.
  * **Tombol "KIRIM BUKTI"**: Jika diklik, mengirimkan data form beserta file gambar ke `PaymentController@upload`. File bukti bayar disimpan di direktori `storage/app/public/proofs/` dan link-nya disimpan di database.
