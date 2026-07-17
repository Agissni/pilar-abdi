<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Hasil Tryout - {{ $attempt->user->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Cinzel:wght@700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 94vh;
        }
        .container {
            width: 820px;
            background: #ffffff;
            border: 4px solid #071739;
            outline: 2px solid #d4af37;
            outline-offset: -8px;
            padding: 50px;
            box-sizing: border-box;
            position: relative;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            border-radius: 8px;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #d4af37;
            padding-bottom: 25px;
            margin-bottom: 30px;
            position: relative;
        }
        .header h1 {
            margin: 0;
            font-family: 'Cinzel', serif;
            font-size: 32px;
            font-weight: 800;
            color: #071739;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .header p.subtitle {
            margin: 5px 0 0 0;
            font-size: 13px;
            color: #d4af37;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: 700;
        }
        .header p.address {
            margin: 5px 0 0 0;
            font-size: 11px;
            color: #64748b;
        }
        .meta-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 35px;
            font-size: 13px;
            background: #f8fafc;
            padding: 15px 20px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        .meta-info table {
            border-collapse: collapse;
        }
        .meta-info td {
            padding: 4px 5px;
        }
        .meta-info td.label {
            font-weight: 600;
            color: #64748b;
            width: 130px;
        }
        .meta-info td.val {
            color: #0f172a;
            font-weight: 500;
        }
        .section-title {
            font-family: 'Cinzel', serif;
            font-size: 18px;
            color: #071739;
            border-bottom: 2px solid #071739;
            padding-bottom: 5px;
            margin-bottom: 20px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .score-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 35px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #cbd5e1;
        }
        .score-table th, .score-table td {
            padding: 14px;
            text-align: center;
            font-size: 13px;
        }
        .score-table th {
            background-color: #071739;
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
        }
        .score-table td {
            background-color: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }
        .score-table td.subject {
            text-align: left;
            font-weight: 600;
            color: #0f172a;
        }
        .score-total-row td {
            background-color: #f8fafc;
            font-weight: 700;
            border-top: 2px solid #cbd5e1;
            border-bottom: none;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 700;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-lulus {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .status-tidak-lulus {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
        .result-box {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px dashed #cbd5e1;
        }
        .result-box p {
            margin: 0 0 10px 0;
            font-weight: 700;
            color: #64748b;
            font-size: 13px;
            letter-spacing: 1px;
        }
        .result-box .badge-large {
            display: inline-block;
            padding: 10px 30px;
            font-size: 18px;
            font-weight: 800;
            border-radius: 50px;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            font-size: 13px;
        }
        .dicetak-info {
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.5;
        }
        .signature-box {
            text-align: center;
            width: 240px;
        }
        .signature-line {
            margin-top: 65px;
            border-top: 2px solid #071739;
            font-weight: 700;
            padding-top: 6px;
            color: #0f172a;
        }
        .signature-title {
            font-size: 11px;
            color: #64748b;
            margin-top: 2px;
        }
        .no-print {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 100;
        }
        .btn-print {
            background-color: #071739;
            color: white;
            border: none;
            padding: 12px 24px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            font-family: 'Poppins', sans-serif;
            transition: transform 0.2s;
        }
        .btn-print:hover {
            transform: scale(1.05);
            background-color: #11224d;
        }
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .container {
                box-shadow: none;
                border: 4px solid #071739 !important;
                outline: 2px solid #d4af37 !important;
                padding: 40px;
                width: 100%;
                border-radius: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()" class="btn-print">🖨️ Cetak / Simpan PDF</button>
    </div>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Pilar Abdi</h1>
            <p class="subtitle">Bimbingan Belajar Kedinasan Terpercaya</p>
            <p class="address">Alamat: Jl. Pendidikan No. 12, Depok, Jawa Barat | Telp/WhatsApp: +62 831-9445-7799</p>
        </div>

        <!-- Meta Info -->
        <div class="meta-info">
            <table>
                <tr>
                    <td class="label">Nama Siswa</td>
                    <td class="val">: {{ $attempt->user->name }}</td>
                </tr>
                <tr>
                    <td class="label">Paket Belajar</td>
                    <td class="val">: {{ ucfirst($attempt->user->package ?? 'Dasar') }}</td>
                </tr>
                <tr>
                    <td class="label">Sekolah Tujuan</td>
                    <td class="val">: {{ strtoupper($attempt->user->sekdin ?? '—') }}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="label">Nama Ujian</td>
                    <td class="val">: {{ $attempt->tryout->nama_tryout ?? 'Try Out' }}</td>
                </tr>
                <tr>
                    <td class="label">Tgl Pengerjaan</td>
                    <td class="val">: {{ $attempt->created_at->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Sesi Ujian ID</td>
                    <td class="val">: TO-{{ $attempt->id_tryout_attempt }}</td>
                </tr>
            </table>
        </div>

        <!-- Title Section -->
        <div class="section-title">Laporan Skor Kelulusan CAT SKD</div>
        
        <!-- Score Table -->
        <table class="score-table">
            <thead>
                <tr>
                    <th>Materi Kategori</th>
                    <th>Skor Minimal (PG)</th>
                    <th>Skor Capaian</th>
                    <th>Hasil Analisis</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="subject">Tes Wawasan Kebangsaan (TWK)</td>
                    <td>65</td>
                    <td style="font-weight: 700; font-size: 15px;">{{ $attempt->score_twk }}</td>
                    <td>
                        @if($attempt->score_twk >= 65)
                            <span class="status-badge status-lulus">Lulus PG</span>
                        @else
                            <span class="status-badge status-tidak-lulus">Di Bawah PG</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="subject">Tes Inteligensia Umum (TIU)</td>
                    <td>80</td>
                    <td style="font-weight: 700; font-size: 15px;">{{ $attempt->score_tiu }}</td>
                    <td>
                        @if($attempt->score_tiu >= 80)
                            <span class="status-badge status-lulus">Lulus PG</span>
                        @else
                            <span class="status-badge status-tidak-lulus">Di Bawah PG</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="subject">Tes Karakteristik Pribadi (TKP)</td>
                    <td>156</td>
                    <td style="font-weight: 700; font-size: 15px;">{{ $attempt->score_tkp }}</td>
                    <td>
                        @if($attempt->score_tkp >= 156)
                            <span class="status-badge status-lulus">Lulus PG</span>
                        @else
                            <span class="status-badge status-tidak-lulus">Di Bawah PG</span>
                        @endif
                    </td>
                </tr>
                <tr class="score-total-row">
                    <td class="subject">Total Akumulasi Nilai</td>
                    <td>311</td>
                    <td style="font-size: 18px; font-weight: 800; color: #071739;">{{ $attempt->score_total }}</td>
                    <td>
                        @if($attempt->status === 'lulus')
                            <span class="status-badge status-lulus">Memenuhi Syarat</span>
                        @else
                            <span class="status-badge status-tidak-lulus">Tidak Memenuhi</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Result Box -->
        <div class="result-box">
            <p>STATUS KELULUSAN AKHIR</p>
            @if($attempt->status === 'lulus')
                <div class="badge-large status-lulus">LULUS PASSING GRADE</div>
            @else
                <div class="badge-large status-tidak-lulus">TIDAK LULUS PASSING GRADE</div>
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="dicetak-info">
                Dicetak otomatis oleh sistem Pilar Abdi<br>
                Waktu Cetak: {{ now()->format('d M Y, H:i') }} WIB
            </div>
            <div class="signature-box">
                <p style="margin: 0; font-size: 13px;">Depok, {{ now()->format('d F Y') }}</p>
                <div class="signature-line">Kayla Najwa Riana Agisni, S.Tr.Kom</div>
                <div class="signature-title">Direktur Utama Pilar Abdi</div>
            </div>
        </div>
    </div>

</body>
</html>
