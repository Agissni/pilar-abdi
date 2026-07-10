# BAB 1 PENDAHULUAN

## 1.1 Latar Belakang
Bimbingan belajar (bimbel) **Pilar Abdi** merupakan lembaga pendidikan non-formal yang berfokus pada pembinaan dan persiapan calon peserta seleksi Sekolah Kedinasan (Sekdin) di Indonesia. Sebagai lembaga yang melayani ratusan siswa dengan berbagai macam target instansi kedinasan (seperti STAN, IPDN, STIS, STMKG, dll.), efisiensi operasional sangat menentukan kualitas layanan bimbingan.

Namun, kondisi operasional berjalan di Pilar Abdi saat ini masih menghadapi berbagai kendala karena proses pencatatan data yang masih bersifat manual dan terfragmentasi. Beberapa kendala utama yang diidentifikasi meliputi:
1. **Pendaftaran dan Pembayaran Manual**: Calon siswa mendaftar melalui formulir kertas atau pesan instan WhatsApp, yang kemudian mengharuskan staf administrasi mencatat ulang data tersebut secara manual. Unggah bukti pembayaran juga dikirimkan melalui jalur percakapan pribadi, sehingga sering kali terselip dan memperlambat proses verifikasi.
2. **Pengelolaan Kelas yang Tidak Terintegrasi**: Informasi mengenai jadwal kelas, tautan pertemuan virtual (Google Meet), dan dokumen materi ajar (PDF) didistribusikan secara manual lewat grup percakapan. Hal ini menyulitkan siswa untuk melacak kembali materi yang telah diajarkan dan menyulitkan guru dalam memperbarui konten secara mandiri.
3. **Pelaksanaan Tryout Manual/Kertas**: Evaluasi berkala kemampuan siswa (SKD: TIU, TWK, TKP) masih dilakukan dengan menyebarkan soal secara manual, yang memperlambat penilaian (scoring) dan analisis hasil tryout bagi siswa.

Untuk mengatasi permasalahan tersebut, perancangan dan pembangunan aplikasi web di direktori `C:\xampp\htdocs\pilar-abdi` menjadi solusi yang sangat krusial. Melalui aplikasi berbasis web ini, seluruh proses bisnis utama—mulai dari pendaftaran siswa baru, verifikasi pembayaran oleh admin, pengelolaan jadwal/materi oleh guru, hingga pengerjaan simulasi tryout berbasis Computer Assisted Test (CAT) oleh siswa—dapat diintegrasikan ke dalam satu platform digital yang berjalan di server lokal XAMPP. Hal ini akan meminimalisasi kesalahan manusia (human error), mengamankan penyimpanan data, dan mempercepat penyampaian layanan pembelajaran secara real-time.

---

## 1.2 Nama Aplikasi dan Dasar Ide
Aplikasi yang dibangun untuk proyek ini diberi nama resmi **"Pilar Abdi Web Portal"** (atau disingkat **Pilar Abdi**). 

### Arti Filosofis
* **Pilar**: Berarti tiang penyangga utama yang kokoh. Nama ini melambangkan visi aplikasi sebagai pondasi atau penopang utama bagi para siswa dalam menempuh persiapan ujian masuk sekolah kedinasan yang ketat.
* **Abdi**: Berarti mengabdi atau pelayan. Nama ini melambangkan komitmen lembaga untuk mengabdi kepada bangsa dengan cara mencetak kader-kader aparatur sipil negara (ASN) dan abdi negara yang berkualitas melalui pembinaan akademis yang terstruktur.

### Dasar Ide
Ide dasar pembuatan aplikasi ini lahir dari observasi langsung terhadap hambatan teknis sehari-hari di lapangan. Staf administrasi sering kewalahan mengelola data Excel pendaftaran yang tumpang tindih, sementara guru kesulitan mendistribusikan link Google Meet setiap harinya karena tertimbun percakapan grup chat. Selain itu, para siswa membutuhkan simulasi pengerjaan soal dengan batasan waktu yang ketat mirip dengan kondisi ujian SKD CAT yang sesungguhnya. Oleh karena itu, ide untuk menyatukan tiga aktor utama (Admin, Guru, Siswa) ke dalam satu gerbang sistem informasi berbasis web menjadi landasan pengembangan aplikasi ini.

---

## 1.3 Tujuan Pengembangan
Tujuan dari pengembangan aplikasi Pilar Abdi ini dijabarkan sebagai berikut:

### Tujuan Umum
Menyelesaikan kendala operasional utama pada lembaga bimbingan belajar Pilar Abdi melalui digitalisasi sistem informasi pembelajaran dan administrasi secara terpadu.

### Tujuan Khusus
1. **Pendaftaran & Pembayaran Mandiri**: Menyediakan modul registrasi online bagi calon siswa serta fitur unggah bukti transfer pembayaran guna memudahkan verifikasi.
2. **Manajemen Data (CRUD) yang Aman**: Menyediakan modul manajemen data guru, siswa, kelas, pengumuman, dan soal tryout yang terproteksi hak akses role-based.
3. **Akses Pembelajaran Tersentralisasi**: Membantu guru memperbarui tautan kelas (Google Meet) dan materi ajar (PDF) secara mandiri serta memudahkan siswa mengaksesnya dari satu halaman dashboard.
4. **Sistem Tryout Berbasis Waktu (CAT)**: Menyediakan modul pengerjaan tryout online secara otomatis dengan pengukur waktu mundur (timer) dan kalkulasi skor akhir instan.
5. **Penyimpanan Lokal yang Efisien**: Memastikan penyimpanan basis data lokal yang terstruktur menggunakan MySQL di lingkungan server XAMPP.

---

## 1.4 Ruang Lingkup
Untuk memastikan bahwa pengembangan aplikasi tetap terfokus dan selesai dalam batas waktu yang ditentukan untuk Proyek 1, ruang lingkup aplikasi dibatasi pada hal-hal berikut:

1. **Lingkungan Server**: Aplikasi dikembangkan berbasis web menggunakan framework Laravel 12 dan dijalankan pada lingkungan lokal (`localhost/pilar-abdi`) memanfaatkan XAMPP (Apache & MySQL).
2. **Pengguna Sistem (Multi-user)**: Sistem melayani empat kategori pengguna dengan hak akses yang terproteksi:
   * **Pengunjung/Calon Siswa**: Melakukan registrasi akun dan mengunggah bukti pembayaran.
   * **Siswa Aktif**: Mengakses halaman kelas (Google Meet & materi PDF) serta mengerjakan tryout CAT yang aktif.
   * **Guru**: Mengelola informasi kelas yang diampu (memperbarui link Google Meet & materi PDF).
   * **Admin**: Melakukan verifikasi pembayaran siswa, manajemen data guru, kelas, soal tryout, dan pengumuman.
3. **Fitur Inti (Core Features)**:
   * Fitur Autentikasi (Registrasi, Login, dan Logout).
   * Fitur Unggah Bukti Bayar & Verifikasi Admin.
   * Fitur CRUD Data Guru, Kelas, dan Pengumuman.
   * Fitur CRUD Soal dan Tryout oleh Admin.
   * Fitur Ujian (Tryout) CAT dengan batasan waktu.
4. **Batasan Luar**: Aplikasi ini tidak mengintegrasikan gerbang pembayaran otomatis (*payment gateway*) pihak ketiga, API notifikasi (SMS/WhatsApp gateway), maupun sistem pengawasan ujian menggunakan AI/kamera (proctoring). Semua transaksi pembayaran diverifikasi secara manual oleh Admin melalui pemeriksaan bukti transfer.
