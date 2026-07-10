# BAB 7 ALUR KERJA (WORKFLOW) SISTEM

## 7.1 Gambaran Umum Alur Kerja
Aplikasi **Pilar Abdi Web Portal** dirancang untuk mendigitalisasi dan mengintegrasikan alur operasional bimbingan belajar dari hulu ke hilir. Sistem ini memfasilitasi interaksi antara empat aktor utama: Pengunjung/Calon Siswa, Siswa Aktif, Guru, dan Admin. 

Untuk memberikan pemahaman mendalam tentang bagaimana aplikasi beroperasi, alur kerja sistem dibagi menjadi tiga sub-alur utama:
1. **Alur Pendaftaran dan Aktivasi Akun (Registration & Activation Flow)**: Menangani pendaftaran mandiri siswa baru, transaksi pembayaran transfer manual, dan verifikasi admin hingga status akun menjadi aktif.
2. **Alur Manajemen & Pelaksanaan Kelas Online (Class Management Flow)**: Mengatur bagaimana admin mengelola data guru dan kelas, bagaimana guru memperbarui detail materi/kelas online, serta bagaimana siswa mengakses kelas tersebut.
3. **Alur Simulasi Ujian Tryout CAT (CAT Tryout Simulator Flow)**: Mengatur siklus hidup pembuatan tryout dan soal oleh admin, pengerjaan simulasi berbasis CAT oleh siswa dengan pengukur waktu, hingga evaluasi kelulusan otomatis berdasarkan *passing grade*.

---

## 7.2 Alur Pendaftaran dan Aktivasi Akun
Alur ini berfokus pada transisi pengunjung dari calon siswa menjadi siswa aktif yang berhak menggunakan seluruh fasilitas pembelajaran di dalam portal.

### Diagram Alur Kerja (Flowchart)
![Alur Pendaftaran dan Aktivasi Akun](file:///c:/xampp/htdocs/pilar-abdi/pilar-abdi/dokumentasi/alur_pendaftaran.png)


### Penjelasan Langkah-Langkah
1. **Pendaftaran Mandiri**: Pengunjung mengakses halaman pendaftaran (`/register`), mengisi formulir berupa Nama, Email, WhatsApp, Kata Sandi, Pilihan Paket, Pilihan Instansi Kedinasan, dan Alamat.
2. **Inisialisasi Status**: Data disimpan ke tabel `users` dengan status default `pending`. Jika pengguna mencoba mengakses dashboard langsung, middleware `/siswa` akan memblokir dan mengarahkan kembali ke halaman login/pembayaran karena status belum `active`.
3. **Transaksi & Unggah Bukti**: Siswa diarahkan ke halaman `/pembayaran` untuk melihat nominal paket belajar dan nomor rekening lembaga. Siswa mengunggah berkas bukti transfer (format gambar/PDF) serta menginput detail rekening pengirim.
4. **Verifikasi Admin**: Admin masuk ke rute `/admin/pembayaran` untuk meninjau data bukti bayar yang masuk.
   * Jika admin mengklik **Terima (Accept)**: Status pembayaran diubah menjadi `lunas`, dan kolom `status` pada tabel `users` untuk siswa terkait otomatis berubah menjadi `active`.
   * Jika admin mengklik **Tolak (Reject)**: Status pembayaran diubah menjadi `ditolak`. Siswa akan melihat status tersebut di dashboard mereka dan diminta mengunggah ulang bukti pembayaran yang valid.

---

## 7.3 Alur Manajemen & Pelaksanaan Kelas Online
Alur ini menjembatani persiapan administratif oleh Admin, penyediaan materi oleh Guru, dan pelaksanaan kegiatan belajar mengajar virtual oleh Siswa.

### Diagram Alur Kerja (Flowchart)
![Alur Kegiatan Belajar Mengajar](file:///c:/xampp/htdocs/pilar-abdi/pilar-abdi/dokumentasi/alur_kelas.png)


### Penjelasan Langkah-Langkah
1. **Persiapan Data Master oleh Admin**:
   * Admin mengelola data Guru (Nama, Spesialisasi, WhatsApp, Email, Kata Sandi) melalui menu CRUD Guru.
   * Admin membuat Kelas baru, menentukan nama kelas, jenis materi (TWK/TIU/TKP), menugaskan Guru pengampu dari data master, serta mengatur waktu pelaksanaan (hari dan jam).
2. **Pembaruan oleh Guru**:
   * Guru melakukan login khusus melalui rute `/login`.
   * Di dashboard Guru, sistem memfilter kelas yang diampu oleh guru yang bersangkutan.
   * Guru dapat memasukkan/memperbarui tautan ruang kelas virtual (Google Meet) dan mengunggah dokumen PDF bahan ajar.
3. **Akses oleh Siswa**:
   * Siswa yang berstatus `active` login dan mengakses menu Kelas (`/kelas`).
   * Halaman merender daftar kelas aktif. Siswa dapat mengklik tombol "Masuk Kelas" yang akan membuka tab baru ke Google Meet, serta mengklik tombol "Unduh Materi" untuk mengunduh materi ajar berformat PDF secara instan.

---

## 7.4 Alur Simulasi Ujian Tryout CAT (Computer Assisted Test)
Alur ini memfasilitasi evaluasi berkala bagi siswa dengan simulasi pengerjaan yang menyerupai sistem ujian Seleksi Kompetensi Dasar (SKD) CAT yang sesungguhnya.

### Diagram Alur Kerja (Flowchart)
![Alur Simulasi Tryout CAT](file:///c:/xampp/htdocs/pilar-abdi/pilar-abdi/dokumentasi/alur_tryout.png)


### Penjelasan Langkah-Langkah
1. **Pembuatan Paket Ujian (Sisi Admin)**:
   * Admin membuat paket Tryout (Nama, Deskripsi, Jumlah Soal, Durasi dalam menit, tanggal mulai & berakhir, status pengerjaan).
   * Admin mengisi soal-soal di dalam paket tersebut melalui menu CRUD Soal, menyertakan kategori (TWK/TIU/TKP), teks pertanyaan, pilihan A-E, kunci jawaban, dan pembahasan soal.
2. **Inisiasi Ujian (Sisi Siswa)**:
   * Siswa membuka halaman Tryout (`/tryout`). Daftar paket tryout dirender secara dinamis.
   * Jika status tryout adalah `aktif`, siswa dapat mengklik "Mulai Sekarang", lalu membaca halaman petunjuk pengerjaan.
   * Setelah menekan tombol konfirmasi, waktu hitung mundur (*timer*) berbasis JavaScript akan aktif secara real-time.
3. **Pengerjaan Soal (Simulasi CAT)**:
   * Layar pengerjaan menampilkan satu soal per halaman untuk meningkatkan fokus.
   * Siswa memilih opsi A-E. Jawaban langsung disimpan ke dalam objek memori sementara di sisi klien.
   * Siswa dapat menandai soal dengan status "Ragu-Ragu" (akan mengubah warna tombol nomor soal di panel samping menjadi kuning).
   * Navigasi antar-soal dapat dilakukan menggunakan tombol "Sebelumnya", "Selanjutnya", atau mengklik langsung nomor soal pada grid navigasi.
4. **Kalkulasi & Hasil Ujian**:
   * Jika siswa mengklik "Selesai Ujian" (atau waktu timer mencapai `00:00`), sistem akan menutup lembar ujian dan memproses jawaban.
   * **Skema Penilaian**:
     * **Materi TWK & TIU**: Setiap jawaban benar bernilai **5**, salah atau tidak menjawab bernilai **0**.
     * **Materi TKP**: Setiap opsi (A-E) memiliki nilai skala **1-5**. Tidak menjawab bernilai **0**.
   * **Penentuan Kelulusan**:
     * Nilai ambang batas (*passing grade*) dihitung secara proporsional berdasarkan jumlah soal (misalnya, kelulusan 60% untuk TWK/TIU dan bobot nilai rata-rata untuk TKP).
     * Jika seluruh nilai kategori materi di atas ambang batas, status kelulusan bernilai **LULUS PASSING GRADE** (tampilan bertema hijau).
     * Jika ada salah satu kategori materi di bawah ambang batas, status bernilai **TIDAK LULUS PASSING GRADE** (tampilan bertema merah, disertai detail materi yang belum memenuhi target).

---

## 7.5 Diagram Alir Terintegrasi (Unified System Flowchart)
Diagram ini menyatukan seluruh alur sistem dan peran (Calon Siswa, Siswa Aktif, Guru, dan Admin) dalam satu kesatuan bagan yang mengalir dari atas ke bawah.

### Diagram Alir Terintegrasi (Graphviz Flowchart)
![Diagram Alir Terintegrasi Pilar Abdi](file:///c:/xampp/htdocs/pilar-abdi/pilar-abdi/dokumentasi/workflow_pilar_abdi.png)
