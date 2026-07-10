import urllib.request
import urllib.parse
import json
import os

dot_code = """digraph ClassDiagramPilarAbdi {
    fontname="Arial";
    fontsize=11;
    rankdir=BT;
    
    // Setup Desain Kotak Class UML
    node [shape=record, style="filled,rounded", fontname="Arial", fontsize=10, fillcolor="#f8f9fa", color="#0d6efd"];
    edge [fontname="Arial", fontsize=9, color="#6c757d"];
    
    // Kotak-Kotak Model (Atribut & Method Relasi)
    User [label="{User|+ id_user : int\\l+ name : varchar\\l+ email : varchar\\l+ role : enum(admin,siswa,guru)\\l+ status : enum(pending,active,inactive)\\l|+ payments() : hasMany\\l}"];
    
    Payment [label="{Payment|+ id : int\\l+ id_user : int (FK)\\l+ bank : varchar\\l+ amount : int\\l+ status : enum(pending,lunas,ditolak)\\l|+ user() : belongsTo\\l}"];
    
    Guru [label="{Guru|+ id : int\\l+ nama : varchar\\l+ spesialisasi : varchar\\l+ email : varchar\\l|+ kelas() : hasMany\\l}"];
    
    Kelas [label="{Kelas|+ id : int\\l+ nama_kelas : varchar\\l+ guru_id : int (FK)\\l+ gmeet_link : varchar\\l+ pdf_materi : varchar\\l|+ guru() : belongsTo\\l}"];
    
    Tryout [label="{Tryout|+ id : int\\l+ nama_tryout : varchar\\l+ durasi : int\\l|+ questions() : hasMany\\l}"];
    
    TryoutQuestion [label="{TryoutQuestion|+ id : int\\l+ tryout_id : int (FK)\\l+ nomor_soal : int\\l+ pertanyaan : text\\l+ jawaban_benar : varchar\\l|+ tryout() : belongsTo\\l}"];
    
    Pengumuman [label="{Pengumuman|+ id : int\\l+ judul : varchar\\l+ isi : text\\l+ status : varchar\\l|}"];
    
    // Garis Hubung Relasi (Ujung Panah Belah Ketupat Kosong / odiamond)
    Payment -> User [arrowhead=odiamond, label="belongsTo", color="#dc3545"];
    Kelas -> Guru [arrowhead=odiamond, label="belongsTo", color="#198754"];
    TryoutQuestion -> Tryout [arrowhead=odiamond, label="belongsTo", color="#0dcaf0"];
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

print("Sending request to QuickChart Graphviz API for Class Diagram...")
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
            
            file_path = os.path.join(target_dir, "class_diagram_pilar_abdi.png")
            with open(file_path, "wb") as f:
                f.write(image_data)
            print(f"Saved to {file_path}")
            
    print("Class Diagram generated and saved successfully as PNG!")
except Exception as e:
    print(f"Error rendering Class Diagram: {e}")
