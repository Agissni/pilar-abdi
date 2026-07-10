import base64
import urllib.request
import os

mermaid_code = """graph TD
    A([Mulai]) --> B[Guru Melakukan Login]
    B --> C[Masuk ke Dashboard Utama Guru]
    
    %% Menu 1: Dashboard / Jadwal
    C --> D[Lihat Jadwal Mengajar]
    D --> D1[Kelola Link GMeet & Upload PDF Materi]
    
    %% Menu 2: Daftar Siswa
    C --> E[Menu Daftar Siswa]
    E --> E1[Melihat Data Siswa yang Terdaftar]
    
    %% Menu 3: Kelola Soal (Diperbaiki)
    C --> F[Menu Kelola Soal Try Out]
    F --> F0{Admin Sudah Buat Paket?}
    F0 -- Belum --> F3[Guru Tidak Bisa Membuat Soal]
    F0 -- Sudah --> F1[Pilih Paket Try Out]
    F1 --> F2[Membuat Soal Ujian Baru & Simpan ke Bank Soal]
    
    D1 --> G([Selesai])
    E1 --> G
    F2 --> G
    F3 --> G"""

# Base64 encode the code
encoded = base64.urlsafe_b64encode(mermaid_code.encode("utf-8")).decode("ascii")
url = f"https://mermaid.ink/img/{encoded}"

# Target directories to save
target_dirs = [
    r"c:\xampp\htdocs\pilar-abdi\pilar-abdi\dokumentasi",
    r"C:\Users\UseR\.gemini\antigravity\brain\ad57fc38-7777-46dc-98f2-92c7c0c6c7d1"
]

print("Rendering and downloading user guru flowchart...")
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
            
            file_path = os.path.join(target_dir, "flowchart_alur_guru.png")
            with open(file_path, "wb") as f:
                f.write(image_data)
            print(f"Saved to {file_path}")
            
    print("Guru flowchart rendered and saved successfully as PNG!")
except Exception as e:
    print(f"Error rendering flowchart: {e}")
