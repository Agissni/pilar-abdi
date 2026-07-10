# BAB 2 DESKRIPSI SISTEM

## 2.1 Gambaran Umum Aplikasi
Aplikasi **Pilar Abdi Web Portal** adalah sistem informasi bimbingan belajar berbasis web terintegrasi yang dirancang untuk mendukung seluruh alur kerja operasional lembaga. Alur sistem secara umum berjalan dari hulu ke hilir sebagai berikut:
1. **Akses Awal & Registrasi (Hulu)**: Pengunjung membuka aplikasi menggunakan web browser dengan mengakses tautan lokal. Pengunjung yang ingin belajar dapat melakukan registrasi secara mandiri dengan mengisi formulir pendaftaran. Setelah akun terdaftar, status awal akun adalah `pending` (belum aktif).
2. **Pembayaran & Aktivasi**: Siswa diarahkan ke halaman pembayaran untuk melihat nominal paket belajar dan nomor rekening lembaga. Siswa mengunggah foto bukti transfer. Di sisi lain, Admin yang masuk ke panel kontrol akan menerima notifikasi pembayaran tersebut, memeriksa validitas bukti fisik secara manual, dan mengubah status pembayaran menjadi `lunas` yang secara otomatis mengaktifkan status akun siswa menjadi `active`.
3. **Proses Belajar & Ujian (Hilir)**: Siswa yang berstatus aktif dapat mengakses materi pembelajaran, melihat jadwal harian, masuk ke tautan Google Meet kelas online yang diperbarui oleh Guru, dan mengikuti simulasi Tryout. Skor hasil pengerjaan Tryout langsung dihitung secara real-time oleh sistem, dan pengumuman-pengumuman terbaru dari Admin langsung tampil di dashboard utama siswa.

---

## 2.2 Stakeholder dan User
Sistem ini memfasilitasi kolaborasi antara empat peran utama (*user roles*) yang memiliki hak akses (*privileges*) khusus:

| No | Aktor | Peran (Role) | Hak Akses (Privileges) |
| :--- | :--- | :--- | :--- |
| 1 | **Pengunjung** | Calon Siswa baru | <ul><li>Mengakses halaman landing page (welcome, program, keunggulan, testimoni, kontak).</li><li>Melakukan registrasi akun baru (membuat kredensial email & password).</li><li>Mengunggah bukti pembayaran pendaftaran.</li></ul> |
| 2 | **Siswa** | Siswa aktif bimbel | <ul><li>Melakukan login & logout.</li><li>Mengakses dashboard siswa (melihat pengumuman terbaru).</li><li>Melihat jadwal kelas, tautan Google Meet, dan mengunduh berkas PDF materi belajar.</li><li>Mengakses daftar tryout dan mengerjakan simulasi ujian CAT dengan pembatasan waktu.</li></ul> |
| 3 | **Guru** | Pengajar/Tutor | <ul><li>Melakukan login & logout khusus guru.</li><li>Mengakses dashboard guru.</li><li>Memperbarui detail kelas yang diampu (mengubah link Google Meet & berkas PDF materi ajar).</li></ul> |
| 4 | **Admin** | Administrator sistem | <ul><li>Melakukan login & logout khusus admin.</li><li>Mengakses dashboard admin dengan statistik jumlah guru, siswa, kelas, dan tryout.</li><li>Melakukan verifikasi pembayaran siswa (`pending`, `lunas`, `ditolak`).</li><li>Melakukan manajemen data master Guru (CRUD).</li><li>Melakukan manajemen data master Kelas (CRUD) dan penugasan guru pengampu.</li><li>Melakukan manajemen Tryout (CRUD) beserta Soal Ujian (CRUD).</li><li>Melakukan manajemen Pengumuman (CRUD) untuk siswa.</li></ul> |

---

## 2.3 Kebutuhan Fungsional
Kebutuhan fungsional menggambarkan fungsi spesifik yang harus mampu dijalankan oleh sistem. Kebutuhan fungsional utama dirangkum dalam tabel berikut:

| ID Kebutuhan | Deskripsi Fitur / Kebutuhan Fungsional |
| :--- | :--- |
| **FR-01** | **Autentikasi Pengguna**: Sistem harus dapat mendaftarkan akun baru, melakukan enkripsi kata sandi menggunakan hashing BCRYPT, memvalidasi login, memproteksi hak akses halaman lewat middleware, dan mengamankan logout session. |
| **FR-02** | **Unggah Bukti Bayar**: Sistem harus menyediakan formulir bagi siswa untuk menginput detail bank asal, jumlah transfer, tanggal transfer, serta mengunggah berkas gambar/PDF bukti pembayaran. |
| **FR-03** | **Verifikasi Admin**: Sistem harus menampilkan daftar bukti bayar yang masuk dan menyediakan tombol aksi bagi Admin untuk menyetujui (verifikasi status menjadi active) atau menolak pembayaran siswa. |
| **FR-04** | **Manajemen Guru (CRUD)**: Admin harus dapat menambah data guru baru (nama, spesialisasi, kontak, email, password), menampilkan daftar guru, memperbarui profil guru, dan menghapus guru. |
| **FR-05** | **Manajemen Kelas (CRUD)**: Admin harus dapat membuat kelas baru, menentukan mata pelajaran (TWK/TIU/TKP), menugaskan guru pengampu, serta mengatur jadwal (hari & jam). |
| **FR-06** | **Pembaruan Kelas oleh Guru**: Guru yang ditunjuk harus dapat memperbarui link Google Meet dan mengunggah dokumen PDF bahan ajar khusus untuk kelasnya. |
| **FR-07** | **Akses Siswa terhadap Kelas**: Siswa yang aktif harus dapat melihat daftar kelas, jadwal mengajar, mengklik tautan kelas online, serta mengunduh berkas materi PDF. |
| **FR-08** | **Manajemen Tryout & Soal**: Admin harus dapat membuat ujian tryout (nama, deskripsi, durasi, tanggal mulai/selesai) dan mengisi soal-soal CAT (pertanyaan, pilihan A-E, jawaban benar, pembahasan). |
| **FR-09** | **Simulasi Tryout CAT**: Siswa harus dapat mengerjakan soal ujian dengan tampilan satu soal per halaman, tombol navigasi soal, pengukur waktu mundur otomatis (timer), dan otomatis menyimpan jawaban ke database. |
| **FR-10** | **Manajemen Pengumuman (CRUD)**: Admin harus dapat mempublikasikan pengumuman terbaru yang akan langsung ditampilkan pada dashboard siswa dan guru. |

---

## 2.4 Kebutuhan Non-Fungsional
Kebutuhan non-fungsional mendefinisikan kriteria operasional untuk menilai kualitas sistem di luar fitur fungsional.

### 1. Keamanan Informasi (Security)
* **Hashing Kata Sandi**: Sandi pengguna wajib disimpan dalam bentuk hash (BCRYPT) untuk mencegah kebocoran data.
* **Proteksi Middleware**: Setiap rute sensitif di halaman admin, guru, dan siswa wajib dilindungi oleh middleware Laravel (`admin`, `guru`, `siswa`) agar tidak dapat diakses secara ilegal melalui manipulasi URL browser.
* **Validasi Input**: Form pendaftaran, login, dan unggah pembayaran harus dilengkapi sistem validasi ketat (tipe data, format email, batasan ukuran file gambar) untuk memblokir celah serangan SQL Injection atau Cross-Site Scripting (XSS).

### 2. Kemudahan Penggunaan (Usability)
* **Antarmuka Responsif (Responsive Design)**: Sistem menggunakan kerangka Bootstrap 5 dengan desain layout yang menyesuaikan ukuran layar perangkat (smartphone, tablet, maupun komputer/laptop).
* **Navigasi Intuitif**: Tata letak panel menu (sidebar) untuk admin, guru, dan siswa diposisikan secara konsisten di sisi kiri untuk mempermudah perpindahan halaman.
* **Umpan Balik Sistem (Feedback)**: Memberikan notifikasi pesan sukses (*success alert*) atau gagal (*danger alert*) di bagian atas halaman setiap kali pengguna berhasil melakukan aksi CRUD atau transaksi data.

### 3. Performa & Ketersediaan (Performance & Availability)
* **Waktu Respon Cepat**: Waktu muat halaman dashboard dan daftar kelas lokal rata-rata harus di bawah 1,5 detik pada lingkungan localhost.
* **Keandalan Ujian**: Halaman tryout didesain dinamis menggunakan Javascript agar ketika siswa berpindah soal atau waktu habis, jawaban tidak hilang dan langsung tersimpan secara aman di database MySQL lokal.
