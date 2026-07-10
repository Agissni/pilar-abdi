import urllib.request
import urllib.parse
import json
import os

dot_code = """digraph ERDBasisDataPilarAbdi {
    fontname="Arial";
    fontsize=11;
    rankdir=LR;
    
    // Seting khusus desain kotak ERD (Warna Merah/Pink Database)
    node [shape=Mrecord, style=filled, fontname="Arial", fontsize=10, fillcolor="#fbf1f2", color="#dc3545"];
    edge [fontname="Arial", fontsize=9, color="#dc3545"];
    
    // Daftar Tabel dan Kolom Utama
    users [label="users | { <pk> id_user (PK) | name (varchar) | email (varchar) | whatsapp (varchar) | password (varchar) | role (varchar) | status (varchar) | package (varchar) | sekdin (varchar) | address (text) }"];
    
    pembayaran [label="pembayaran | { <pk> id (PK) | <fk> id_user (FK) | bank (varchar) | account_number (varchar) | sender_name (varchar) | transfer_date (date) | transfer_time (time) | amount (bigint) | proof_path (varchar) | status (enum) }"];
    
    gurus [label="gurus | { <pk> id (PK) | nama (varchar) | spesialisasi (varchar) | whatsapp (varchar) | email (varchar) | password (varchar) | bio (text) }"];
    
    kelas [label="kelas | { <pk> id (PK) | nama_kelas (varchar) | materi (varchar) | <fk> guru_id (FK) | hari (varchar) | jam (varchar) | gmeet_link (varchar) | pdf_materi (varchar) | deskripsi (text) }"];
    
    tryouts [label="tryouts | { <pk> id (PK) | nama_tryout (varchar) | deskripsi (text) | jumlah_soal (int) | durasi (int) | tanggal_mulai (datetime) | tanggal_berakhir (datetime) | status (enum) }"];
    
    tryout_questions [label="tryout_questions | { <pk> id (PK) | <fk> tryout_id (FK) | nomor_soal (int) | kategori (enum) | pertanyaan (text) | pilihan_a (text) | pilihan_b (text) | pilihan_c (text) | pilihan_d (text) | pilihan_e (text) | jawaban_benar (char) | pembahasan (text) }"];
    
    pengumuman [label="pengumuman | { <pk> id (PK) | judul (varchar) | isi (text) | tanggal_publikasi (datetime) | status (enum) }"];
    
    // Hubungan Relasi Kardinalitas Database (Menggunakan Kaki Gagak / Crow)
    pembayaran:fk -> users:pk [label="N : 1", arrowhead=crow, arrowtail=none, dir=both];
    kelas:fk -> gurus:pk [label="N : 1", arrowhead=crow, arrowtail=none, dir=both];
    tryout_questions:fk -> tryouts:pk [label="N : 1", arrowhead=crow, arrowtail=none, dir=both];
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

print("Sending request to QuickChart Graphviz API for ERD...")
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
            
            file_path = os.path.join(target_dir, "erd_pilar_abdi.png")
            with open(file_path, "wb") as f:
                f.write(image_data)
            print(f"Saved to {file_path}")
            
    print("ERD generated and saved successfully as PNG!")
except urllib.error.HTTPError as e:
    print(f"HTTP Error rendering ERD: {e.code} {e.reason}")
    image_data = e.read()
    for target_dir in target_dirs:
        if not os.path.exists(target_dir):
            os.makedirs(target_dir, exist_ok=True)
        file_path = os.path.join(target_dir, "erd_pilar_abdi.png")
        with open(file_path, "wb") as f:
            f.write(image_data)
        print(f"Saved error image to {file_path}")
except Exception as e:
    print(f"Error rendering ERD: {e}")


