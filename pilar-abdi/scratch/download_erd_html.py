import urllib.request
import urllib.parse
import json
import os

dot_code = """digraph ERDBasisDataPilarAbdi {
    fontname="Arial";
    fontsize=11;
    rankdir=LR;
    
    // Seting khusus desain kotak ERD (Warna Merah/Pink Database)
    node [shape=plaintext, fontname="Arial", fontsize=10];
    edge [fontname="Arial", fontsize=9, color="#dc3545"];
    
    users [label=<
        <TABLE BORDER="0" CELLBORDER="1" CELLSPACING="0" CELLPADDING="4" BGCOLOR="#fbf1f2" COLOR="#dc3545">
            <TR><TD COLSPAN="2" BGCOLOR="#dc3545"><FONT COLOR="white"><B>users</B></FONT></TD></TR>
            <TR><TD PORT="pk" ALIGN="LEFT"><B>id_user (PK)</B></TD></TR>
            <TR><TD ALIGN="LEFT">name (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">email (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">whatsapp (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">password (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">role (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">status (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">package (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">sekdin (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">address (text)</TD></TR>
        </TABLE>
    >];

    pembayaran [label=<
        <TABLE BORDER="0" CELLBORDER="1" CELLSPACING="0" CELLPADDING="4" BGCOLOR="#fbf1f2" COLOR="#dc3545">
            <TR><TD COLSPAN="2" BGCOLOR="#dc3545"><FONT COLOR="white"><B>pembayaran</B></FONT></TD></TR>
            <TR><TD PORT="pk" ALIGN="LEFT"><B>id (PK)</B></TD></TR>
            <TR><TD PORT="fk" ALIGN="LEFT">id_user (FK)</TD></TR>
            <TR><TD ALIGN="LEFT">bank (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">account_number (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">sender_name (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">transfer_date (date)</TD></TR>
            <TR><TD ALIGN="LEFT">transfer_time (time)</TD></TR>
            <TR><TD ALIGN="LEFT">amount (bigint)</TD></TR>
            <TR><TD ALIGN="LEFT">proof_path (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">status (enum)</TD></TR>
        </TABLE>
    >];

    gurus [label=<
        <TABLE BORDER="0" CELLBORDER="1" CELLSPACING="0" CELLPADDING="4" BGCOLOR="#fbf1f2" COLOR="#dc3545">
            <TR><TD COLSPAN="2" BGCOLOR="#dc3545"><FONT COLOR="white"><B>gurus</B></FONT></TD></TR>
            <TR><TD PORT="pk" ALIGN="LEFT"><B>id (PK)</B></TD></TR>
            <TR><TD ALIGN="LEFT">nama (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">spesialisasi (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">whatsapp (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">email (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">password (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">bio (text)</TD></TR>
        </TABLE>
    >];

    kelas [label=<
        <TABLE BORDER="0" CELLBORDER="1" CELLSPACING="0" CELLPADDING="4" BGCOLOR="#fbf1f2" COLOR="#dc3545">
            <TR><TD COLSPAN="2" BGCOLOR="#dc3545"><FONT COLOR="white"><B>kelas</B></FONT></TD></TR>
            <TR><TD PORT="pk" ALIGN="LEFT"><B>id (PK)</B></TD></TR>
            <TR><TD ALIGN="LEFT">nama_kelas (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">materi (varchar)</TD></TR>
            <TR><TD PORT="fk" ALIGN="LEFT">guru_id (FK)</TD></TR>
            <TR><TD ALIGN="LEFT">hari (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">jam (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">gmeet_link (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">pdf_materi (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">deskripsi (text)</TD></TR>
        </TABLE>
    >];

    tryouts [label=<
        <TABLE BORDER="0" CELLBORDER="1" CELLSPACING="0" CELLPADDING="4" BGCOLOR="#fbf1f2" COLOR="#dc3545">
            <TR><TD COLSPAN="2" BGCOLOR="#dc3545"><FONT COLOR="white"><B>tryouts</B></FONT></TD></TR>
            <TR><TD PORT="pk" ALIGN="LEFT"><B>id (PK)</B></TD></TR>
            <TR><TD ALIGN="LEFT">nama_tryout (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">deskripsi (text)</TD></TR>
            <TR><TD ALIGN="LEFT">jumlah_soal (int)</TD></TR>
            <TR><TD ALIGN="LEFT">durasi (int)</TD></TR>
            <TR><TD ALIGN="LEFT">tanggal_mulai (datetime)</TD></TR>
            <TR><TD ALIGN="LEFT">tanggal_berakhir (datetime)</TD></TR>
            <TR><TD ALIGN="LEFT">status (enum)</TD></TR>
        </TABLE>
    >];

    tryout_questions [label=<
        <TABLE BORDER="0" CELLBORDER="1" CELLSPACING="0" CELLPADDING="4" BGCOLOR="#fbf1f2" COLOR="#dc3545">
            <TR><TD COLSPAN="2" BGCOLOR="#dc3545"><FONT COLOR="white"><B>tryout_questions</B></FONT></TD></TR>
            <TR><TD PORT="pk" ALIGN="LEFT"><B>id (PK)</B></TD></TR>
            <TR><TD PORT="fk" ALIGN="LEFT">tryout_id (FK)</TD></TR>
            <TR><TD ALIGN="LEFT">nomor_soal (int)</TD></TR>
            <TR><TD ALIGN="LEFT">kategori (enum)</TD></TR>
            <TR><TD ALIGN="LEFT">pertanyaan (text)</TD></TR>
            <TR><TD ALIGN="LEFT">pilihan_a (text)</TD></TR>
            <TR><TD ALIGN="LEFT">pilihan_b (text)</TD></TR>
            <TR><TD ALIGN="LEFT">pilihan_c (text)</TD></TR>
            <TR><TD ALIGN="LEFT">pilihan_d (text)</TD></TR>
            <TR><TD ALIGN="LEFT">pilihan_e (text)</TD></TR>
            <TR><TD ALIGN="LEFT">jawaban_benar (char)</TD></TR>
            <TR><TD ALIGN="LEFT">pembahasan (text)</TD></TR>
        </TABLE>
    >];

    pengumuman [label=<
        <TABLE BORDER="0" CELLBORDER="1" CELLSPACING="0" CELLPADDING="4" BGCOLOR="#fbf1f2" COLOR="#dc3545">
            <TR><TD COLSPAN="2" BGCOLOR="#dc3545"><FONT COLOR="white"><B>pengumuman</B></FONT></TD></TR>
            <TR><TD PORT="pk" ALIGN="LEFT"><B>id (PK)</B></TD></TR>
            <TR><TD ALIGN="LEFT">judul (varchar)</TD></TR>
            <TR><TD ALIGN="LEFT">isi (text)</TD></TR>
            <TR><TD ALIGN="LEFT">tanggal_publikasi (datetime)</TD></TR>
            <TR><TD ALIGN="LEFT">status (enum)</TD></TR>
        </TABLE>
    >];

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

print("Sending request to QuickChart Graphviz API for HTML-based ERD...")
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
            
    print("HTML-based ERD generated and saved successfully as PNG!")
except urllib.error.HTTPError as e:
    print(f"HTTP Error rendering ERD: {e.code} {e.reason}")
    print(e.read().decode('utf-8'))
except Exception as e:
    print(f"Error rendering ERD: {e}")
