import base64
import urllib.request
import os

mermaid_code = """graph TD
    A([Mulai]) --> B[Admin Melakukan Login]
    B --> C[Masuk ke Dashboard Admin]
    C --> D[Membuka Menu Verifikasi Pendaftaran Baru]
    D --> E[Memeriksa Foto Bukti Transfer Siswa PENDING]
    E --> F{Apakah Bukti Transfer Valid?}
    F -- Tidak Valid --> G[Tolak Pendaftaran / Akun Tetap Terkunci]
    F -- Valid / Lunas --> H[Klik Setujui & Status Siswa Berubah Jadi ACTIVE]
    H --> I[Sistem Membuka Hak Akses Login untuk Siswa Terkait]
    I --> J[Admin Mengelola Paket Soal Tryout CAT & Pengumuman]
    G --> K([Selesai])
    J --> K"""

# Base64 encode the code
encoded = base64.urlsafe_b64encode(mermaid_code.encode("utf-8")).decode("ascii")
url = f"https://mermaid.ink/img/{encoded}"

# Directories to save
target_dirs = [
    r"c:\xampp\htdocs\pilar-abdi\pilar-abdi\dokumentasi",
    r"C:\Users\UseR\.gemini\antigravity\brain\ad57fc38-7777-46dc-98f2-92c7c0c6c7d1"
]

print("Rendering and downloading user admin flowchart...")
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
            
            file_path = os.path.join(target_dir, "flowchart_verifikasi_admin.png")
            with open(file_path, "wb") as f:
                f.write(image_data)
            print(f"Saved to {file_path}")
            
    print("Admin flowchart rendered and saved successfully as PNG!")
except Exception as e:
    print(f"Error rendering flowchart: {e}")
