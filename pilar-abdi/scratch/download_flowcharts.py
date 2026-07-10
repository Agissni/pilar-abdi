import base64
import urllib.request
import os

# Define the Mermaid code strings
diagrams = {
    "alur_pendaftaran": """graph TD
    A[Mulai: Pengunjung / Calon Siswa] --> B[Registrasi Akun Baru]
    B --> C[Akun Terbuat di Database <br>Status: 'pending']
    C --> D[Dialihkan ke Halaman Pembayaran]
    D --> E[Transfer Biaya Pembayaran Manual]
    E --> F[Unggah Bukti Pembayaran <br>Form: Bank, Nama Pengirim, File Bukti]
    F --> G[Data Pembayaran Tercatat <br>Status Pembayaran: 'pending']
    G --> H{Verifikasi Bukti <br>oleh Admin}
    H -- "Tidak Valid" --> I[Status Pembayaran: 'ditolak']
    I --> J[Notifikasi Halaman Siswa]
    J --> F
    H -- "Valid" --> K[Status Pembayaran: 'lunas']
    K --> L[Status Akun Siswa: 'active']
    L --> M[Akses Penuh Dashboard Siswa]
    M --> N[Selesai]""",

    "alur_kelas": """graph TD
    A[Mulai: Login] --> B{Pengecekan Peran / Role}
    B -- Admin --> C[Kelola Data Master Guru <br>CRUD]
    C --> D[Kelola Data Master Kelas <br>CRUD: Jadwal & Guru Pengampu]
    D --> E[Selesai]
    B -- Guru --> F[Dashboard Guru]
    F --> G[Pilih Kelas yang Diampu]
    G --> H[Perbarui Link Google Meet <br>& Unggah Materi PDF]
    H --> E
    B -- Siswa Aktif --> I[Dashboard Siswa]
    I --> J[Menu Kelas]
    J --> K[Lihat Jadwal & Guru Pengampu]
    K --> L[Klik Tautan Google Meet & <br>Unduh Berkas PDF Materi]
    L --> E""",

    "alur_tryout": """graph TD
    A[Mulai: Simulasi Tryout CAT] --> B{Pengecekan Peran / Role}
    B -- Admin --> C[Kelola Paket Tryout <br>CRUD: Nama, Durasi, Waktu]
    C --> D[Kelola Bank Soal CAT <br>CRUD: Soal, Pilihan A-E, Jawaban, Pembahasan]
    D --> E[Selesai]
    B -- Siswa Aktif --> F[Dashboard Siswa]
    F --> G[Menu Tryout]
    G --> H{Status Tryout <br>Aktif?}
    H -- Tidak / Selesai --> I[Tombol Dinonaktifkan]
    H -- Ya --> J[Klik 'Mulai Sekarang']
    J --> K[Baca Halaman Petunjuk Ujian]
    K --> L[Klik 'Mulai Sekarang' Kedua Kali <br>Timer JavaScript Berjalan]
    L --> M[Halaman Ujian CAT <br>Satu Soal per Halaman]
    M --> N{Navigasi Pengerjaan}
    N -- Jawab Soal --> O[Pilih Opsi A-E <br>Tersimpan Sementara]
    N -- Ragu-Ragu --> P[Tandai Ragu-Ragu <br>Warna Kuning di Grid]
    N -- Pindah Soal --> Q[Gunakan Tombol Prev/Next <br>atau Klik Grid Nomor Soal]
    O --> R{Waktu Habis / <br>Klik Selesai Ujian?}
    P --> R
    Q --> R
    R -- Belum --> M
    R -- Ya / Selesai --> S[Kalkulasi Skor Otomatis <br>TWK/TIU: Benar=5, Salah=0 <br>TKP: Skala 1-5]
    S --> T{Apakah Memenuhi <br>Passing Grade?}
    T -- Ya --> U[Tampilan: LULUS PASSING GRADE <br>Warna Hijau]
    T -- Tidak --> V[Tampilan: TIDAK LULUS <br>Warna Merah & Detail Kategori]
    U --> W[Selesai]
    V --> W"""
}

# Directories to save
target_dirs = [
    r"c:\xampp\htdocs\pilar-abdi\pilar-abdi\dokumentasi",
    r"C:\Users\UseR\.gemini\antigravity\brain\ad57fc38-7777-46dc-98f2-92c7c0c6c7d1"
]

print("Starting to render and download diagrams...")

for name, code in diagrams.items():
    # Base64 encode the code
    encoded = base64.urlsafe_b64encode(code.encode("utf-8")).decode("ascii")
    url = f"https://mermaid.ink/img/{encoded}"
    
    print(f"Downloading {name} from {url}...")
    try:
        req = urllib.request.Request(
            url, 
            headers={'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'}
        )
        with urllib.request.urlopen(req) as response:
            image_data = response.read()
            
            for target_dir in target_dirs:
                if not os.path.exists(target_dir):
                    os.makedirs(target_dir, exist_ok=True)
                
                file_path = os.path.join(target_dir, f"{name}.png")
                with open(file_path, "wb") as f:
                    f.write(image_data)
                print(f" Saved to {file_path}")
    except Exception as e:
        print(f"Error downloading {name}: {e}")

print("All diagrams downloaded successfully.")
