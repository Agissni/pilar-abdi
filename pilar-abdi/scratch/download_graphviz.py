import urllib.request
import urllib.parse
import json
import os

dot_code = """digraph WorkflowPilarAbdi {
    fontname="Arial";
    fontsize=11;
    node [shape=box, style="filled,rounded", fontname="Arial", fontsize=10, fillcolor="#f8f9fa", color="#ced4da"];
    edge [fontname="Arial", fontsize=9, color="#6c757d"];

    // Nodes
    start [label="1. Mulai (Pengunjung)", shape=oval, fillcolor="#e2e3e5", color="#6c757d"];
    register [label="2. Daftar Akun Baru\\n(Isi Formulir Mandiri)"];
    pending [label="3. Akun Terbuat\\n(Status: Pending)"];
    upload [label="4. Transfer & Unggah\\nBukti Pembayaran"];
    
    admin_check [label="5. Admin Verifikasi\\nBukti Bayar?", shape=diamond, fillcolor="#fff3cd", color="#ffc107"];
    reject [label="6. Pembayaran Ditolak\\n(Status: Ditolak)", fillcolor="#f8d7da", color="#dc3545"];
    approve [label="7. Pembayaran Diterima\\n(Status: Lunas / Akun: Active)", fillcolor="#d1e7dd", color="#198754"];
    
    dashboard [label="8. Dashboard Siswa Aktif"];
    menu_check [label="9. Pilih Menu Utama?", shape=diamond, fillcolor="#fff3cd", color="#ffc107"];
    
    menu_kelas [label="10. Menu Kelas\\n(Melihat Jadwal, Link Google Meet, & Unduh PDF)"];
    menu_tryout [label="11. Menu Tryout\\n(Mengerjakan Soal SKD)"];
    submit_tryout [label="12. Submit Ujian\\n(Skor Hitung Otomatis)"];
    
    end [label="13. Selesai / Logout", shape=oval, fillcolor="#e2e3e5", color="#6c757d"];

    // Alur Jalur
    start -> register;
    register -> pending;
    pending -> upload;
    upload -> admin_check;
    
    admin_check -> reject [label="Tidak Valid"];
    reject -> upload [label="Unggah Ulang", style=dashed];
    
    admin_check -> approve [label="Valid"];
    approve -> dashboard;
    
    dashboard -> menu_check;
    
    menu_check -> menu_kelas [label="Pilih Kelas"];
    menu_check -> menu_tryout [label="Pilih Tryout"];
    
    menu_kelas -> end;
    menu_tryout -> submit_tryout;
    submit_tryout -> end;
}"""

url = "https://quickchart.io/graphviz"
payload = {
    "graph": dot_code,
    "format": "png"
}
data = json.dumps(payload).encode('utf-8')

# Target directories to save
target_dirs = [
    r"c:\xampp\htdocs\pilar-abdi\pilar-abdi\dokumentasi",
    r"C:\Users\UseR\.gemini\antigravity\brain\ad57fc38-7777-46dc-98f2-92c7c0c6c7d1"
]

print("Sending request to QuickChart Graphviz API...")
try:
    req = urllib.request.Request(
        url,
        data=data,
        headers={
            'Content-Type': 'application/json',
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
        }
    )
    with urllib.request.urlopen(req) as response:
        image_data = response.read()
        
        for target_dir in target_dirs:
            if not os.path.exists(target_dir):
                os.makedirs(target_dir, exist_ok=True)
            
            file_path = os.path.join(target_dir, "workflow_pilar_abdi.png")
            with open(file_path, "wb") as f:
                f.write(image_data)
            print(f"Saved to {file_path}")
            
    print("Graphviz diagram generated and saved successfully as PNG!")
except Exception as e:
    print(f"Error rendering Graphviz diagram: {e}")
