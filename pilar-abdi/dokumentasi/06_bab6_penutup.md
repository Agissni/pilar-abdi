# BAB 6 PENUTUP

## 6.1 Kesimpulan
Berdasarkan hasil perancangan, implementasi, dan pengujian yang telah dilakukan pada aplikasi web **Pilar Abdi**, dapat ditarik beberapa kesimpulan sebagai berikut:
1. **Pencapaian Tujuan**: Aplikasi ini telah berhasil mentransformasi proses administrasi dan pembelajaran bimbel Pilar Abdi yang sebelumnya manual dan terfragmentasi menjadi sistem digital yang terintegrasi di lingkungan lokal server.
2. **Evaluasi Keberhasilan Fitur**:
   * **Modul Autentikasi & Otorisasi**: Berhasil mengamankan akses halaman web menggunakan middleware role-based (`admin`, `guru`, `siswa`) dengan kata sandi terenkripsi hash BCRYPT.
   * **Modul Pendaftaran & Pembayaran**: Berhasil menyediakan fasilitas registrasi mandiri bagi calon siswa serta fitur unggah bukti bayar yang kemudian dapat diverifikasi secara real-time oleh Admin melalui panel verifikasi pembayaran.
   * **Modul Kelas Online**: Memudahkan Guru memperbarui tautan pertemuan Google Meet dan materi ajar berformat PDF yang dapat diakses langsung oleh siswa aktif.
   * **Modul Tryout CAT**: Berhasil menyajikan simulasi ujian dengan batasan waktu mundur otomatis dan sistem kalkulasi nilai secara langsung untuk mengevaluasi kemampuan siswa pada kategori soal TIU, TWK, dan TKP.
3. **Efisiensi Basis Data**: Skema basis data relasional MySQL yang diterapkan telah terbukti handal dalam menangani penyimpanan data relasional secara konsisten tanpa ada tumpang tindih data (*data redundancy*).

Secara keseluruhan, seluruh tujuan pengembangan umum dan khusus yang telah ditetapkan pada Bab 1 telah berhasil dicapai secara tuntas dengan performa sistem yang stabil di lingkungan lokal.

---

## 6.2 Saran Pengembangan
Meskipun aplikasi Pilar Abdi versi pertama ini telah berjalan dengan baik, terdapat beberapa keterbatasan ruang lingkup yang dapat dikembangkan lebih lanjut di masa mendatang. Berikut adalah rekomendasi peta jalan (*roadmap*) pengembangan sistem selanjutnya:

1. **Integrasi Gerbang Pembayaran Otomatis (Payment Gateway)**:
   * **Rekomendasi**: Mengintegrasikan API layanan payment gateway pihak ketiga (seperti Midtrans, Xendit, atau Doku).
   * **Manfaat**: Menghilangkan proses verifikasi manual oleh Admin. Siswa akan mendapatkan nomor virtual account (*Virtual Account*) atau QRIS, dan sistem akan langsung mengaktifkan akun secara instan saat transfer pembayaran berhasil terdeteksi oleh sistem webhook.
2. **Implementasi Sistem Notifikasi Otomatis (WhatsApp/Email Gateway)**:
   * **Rekomendasi**: Menambahkan library/API WhatsApp Gateway (seperti Fonnte atau Wablas) atau Mail Server (seperti Mailgun atau SMTP Gmail).
   * **Manfaat**: Mengirimkan notifikasi pendaftaran berhasil, pengingat jadwal kelas online 15 menit sebelum dimulai, dan pemberitahuan rilis skor hasil tryout langsung ke nomor WhatsApp atau email siswa.
3. **Peningkatan Keamanan Ujian dengan AI (Online Proctoring)**:
   * **Rekomendasi**: Menambahkan fitur pemantauan kamera (webcam) menggunakan pustaka kecerdasan buatan berbasis Javascript (seperti Face-API.js atau TensorFlow.js).
   * **Manfaat**: Mendeteksi kecurangan siswa saat mengerjakan Tryout CAT secara online, seperti deteksi wajah ganda, deteksi tidak ada orang di depan layar, atau melacak perpindahan tab browser (*tab-switching detection*).
4. **Analisis Statistik Kemampuan Siswa (Analytics Dashboard)**:
   * **Rekomendasi**: Membuat grafik tren nilai tryout siswa menggunakan chart library (seperti Chart.js atau ApexCharts) di halaman dashboard siswa dan admin.
   * **Manfaat**: Membantu siswa dan pembimbing menganalisis grafik perkembangan nilai dari tryout pertama hingga terakhir, serta mendeteksi kelemahan materi ajar secara spesifik.
