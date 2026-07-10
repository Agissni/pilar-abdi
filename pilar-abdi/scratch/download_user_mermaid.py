import base64
import urllib.request
import os

mermaid_code = """graph TD
    A([Mulai]) --> B[Siswa Mengisi Form Pendaftaran]
    B --> C[Siswa Unggah Foto Bukti Transfer Fisik]
    C --> D[Akun Terdaftar dengan Status PENDING]
    D --> E[Siswa Belum Bisa Login / Akses Halaman Utama Dikunci]
    E --> F[Menunggu Proses Verifikasi oleh Admin]
    F --> G{Bagaimana Keputusan Admin?}
    
    G -- Ditolak / Belum Diterima --> H[Status Tetap PENDING & Akses Login Tetap Terkunci]
    H --> F
    
    G -- Diterima / Lunas --> I[Status Akun Berubah Menjadi ACTIVE]
    I --> J[Siswa Melakukan Login Ke Website]
    J --> K[Masuk ke Dashboard Utama Siswa]
    K --> L[Mengunduh Materi PDF & Gabung Google Meet]
    K --> M[Mengerjakan Simulasi Tryout CAT]
    L --> N([Selesai])
    M --> N"""

# Base64 encode the code
encoded = base64.urlsafe_b64encode(mermaid_code.encode("utf-8")).decode("ascii")
url = f"https://mermaid.ink/img/{encoded}"

# Directories to save
target_dirs = [
    r"c:\xampp\htdocs\pilar-abdi\pilar-abdi\dokumentasi",
    r"C:\Users\UseR\.gemini\antigravity\brain\ad57fc38-7777-46dc-98f2-92c7c0c6c7d1"
]

print("Rendering and downloading user flowchart (v3)...")
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
            
            file_path = os.path.join(target_dir, "flowchart_pendaftaran_siswa.png")
            with open(file_path, "wb") as f:
                f.write(image_data)
            print(f"Saved to {file_path}")
            
    print("User flowchart rendered and saved successfully as PNG!")
except Exception as e:
    print(f"Error rendering flowchart: {e}")
