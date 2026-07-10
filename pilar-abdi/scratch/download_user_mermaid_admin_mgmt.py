import base64
import urllib.request
import os

mermaid_code = """graph TD
    A([Mulai]) --> B[Admin Melakukan Login]
    B --> C[Masuk ke Dashboard Admin]
    C --> D[Pilih Menu Sistem]

    %% Percabangan Menu Utama
    D --> E[Verifikasi Pembayaran]
    D --> F[Kelola Siswa]
    D --> G[Kelola Guru]
    D --> H[Kelola Kelas]
    D --> I[Kelola Ujian]
    D --> J[Kelola Pengumuman]

    %% Detail Alur Setiap Menu (Sudah direvisi sesuai logika sistem)
    E --> E1[Periksa Bukti Transfer & Validasi Akun Siswa]
    F --> F1[Melihat Daftar Data Siswa]
    G --> G1[Tambah/Edit/Hapus Data Guru]
    H --> H1[Tambah Kelas, Plotting Guru & Jadwal Sesi]
    I --> I1[Membuat Wadah/Paket Try Out Baru]
    J --> J1[Tulis & Terbitkan Maklumat Pemberitahuan di Dashboard]

    %% Alur Menuju Selesai
    E1 --> K([Selesai])
    F1 --> K
    G1 --> K
    H1 --> K
    I1 --> K
    J1 --> K"""

# Base64 encode the code
encoded = base64.urlsafe_b64encode(mermaid_code.encode("utf-8")).decode("ascii")
url = f"https://mermaid.ink/img/{encoded}"

# Target directories to save
target_dirs = [
    r"c:\xampp\htdocs\pilar-abdi\pilar-abdi\dokumentasi",
    r"C:\Users\UseR\.gemini\antigravity\brain\ad57fc38-7777-46dc-98f2-92c7c0c6c7d1"
]

print("Rendering and downloading user admin management flowchart (revised)...")
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
            
            file_path = os.path.join(target_dir, "flowchart_manajemen_admin.png")
            with open(file_path, "wb") as f:
                f.write(image_data)
            print(f"Saved to {file_path}")
            
    print("Admin management flowchart rendered and saved successfully as PNG!")
except Exception as e:
    print(f"Error rendering flowchart: {e}")
