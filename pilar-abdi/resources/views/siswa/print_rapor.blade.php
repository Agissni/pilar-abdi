<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Hasil Tryout - {{ $attempt->user->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
            color: #333;
            margin: 0;
            padding: 30px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #000;
            padding: 40px;
            position: relative;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 800;
            color: #071739;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 13px;
            color: #666;
        }
        .meta-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 35px;
            font-size: 14px;
        }
        .meta-info table {
            border-collapse: collapse;
        }
        .meta-info td {
            padding: 4px 10px;
        }
        .meta-info td.label {
            font-weight: 600;
            width: 150px;
        }
        .score-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        .score-table th, .score-table td {
            border: 1px solid #333;
            padding: 12px;
            text-align: center;
        }
        .score-table th {
            background-color: #f1f5f9;
            font-weight: 700;
        }
        .score-table td.subject {
            text-align: left;
            font-weight: 600;
        }
        .score-total-row {
            background-color: #f8fafc;
            font-weight: bold;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            font-size: 16px;
            font-weight: 700;
            border-radius: 8px;
            text-transform: uppercase;
        }
        .status-lulus {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #34d399;
        }
        .status-tidak-lulus {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
        }
        .footer {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .signature-box {
            text-align: center;
            width: 200px;
        }
        .signature-line {
            margin-top: 70px;
            border-top: 1px solid #000;
            font-weight: bold;
            padding-top: 5px;
        }
        @media print {
            body {
                padding: 0;
            }
            .container {
                border: none;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
        .btn-print-action {
            display: inline-block;
            background-color: #071739;
            color: white;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="no-print" style="text-align: center;">
        <button onclick="window.print()" class="btn-print-action">🖨️ Cetak / Simpan PDF</button>
    </div>

    <div class="container">
        <div class="header">
            <h1>Pilar Abdi</h1>
            <p>Bimbingan Belajar Kedinasan Terpercaya Indonesia</p>
            <p style="font-size: 11px;">Alamat: Jl. Jenderal Sudirman No. 12, Jakarta Selatan | Telp: (021) 555-0199</p>
        </div>

        <div class="meta-info">
            <table>
                <tr>
                    <td class="label">Nama Siswa</td>
                    <td>: {{ $attempt->user->name }}</td>
                </tr>
                <tr>
                    <td class="label">Paket Belajar</td>
                    <td>: {{ $attempt->user->package ?? 'Reguler' }}</td>
                </tr>
                <tr>
                    <td class="label">Sekolah Tujuan</td>
                    <td>: {{ $attempt->user->sekdin ?? '—' }}</td>
                </tr>
            </table>

            <table style="text-align: right;">
                <tr>
                    <td class="label">Nama Ujian</td>
                    <td>: {{ $attempt->tryout->nama_tryout ?? 'Try Out' }}</td>
                </tr>
                <tr>
                    <td class="label">Tgl Pengerjaan</td>
                    <td>: {{ $attempt->created_at->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Sesi Ujian ID</td>
                    <td>: TO-{{ $attempt->id_tryout_attempt }}</td>
                </tr>
            </table>
        </div>

        <h3 style="border-bottom: 2px solid #333; padding-bottom: 5px; margin-bottom: 15px;">Laporan Skor Kelulusan CAT SKD</h3>
        
        <table class="score-table">
            <thead>
                <tr>
                    <th>Materi Kategori</th>
                    <th>Skor Minimal (Passing Grade)</th>
                    <th>Skor Capaian Siswa</th>
                    <th>Hasil Analisis</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="subject">Tes Wawasan Kebangsaan (TWK)</td>
                    <td>65</td>
                    <td style="font-weight: bold;">{{ $attempt->score_twk }}</td>
                    <td>{!! $attempt->score_twk >= 65 ? '<span style="color:green; font-weight:600;">LULUS PG</span>' : '<span style="color:red; font-weight:600;">DI BAWAH PG</span>' !!}</td>
                </tr>
                <tr>
                    <td class="subject">Tes Inteligensia Umum (TIU)</td>
                    <td>80</td>
                    <td style="font-weight: bold;">{{ $attempt->score_tiu }}</td>
                    <td>{!! $attempt->score_tiu >= 80 ? '<span style="color:green; font-weight:600;">LULUS PG</span>' : '<span style="color:red; font-weight:600;">DI BAWAH PG</span>' !!}</td>
                </tr>
                <tr>
                    <td class="subject">Tes Karakteristik Pribadi (TKP)</td>
                    <td>156</td>
                    <td style="font-weight: bold;">{{ $attempt->score_tkp }}</td>
                    <td>{!! $attempt->score_tkp >= 156 ? '<span style="color:green; font-weight:600;">LULUS PG</span>' : '<span style="color:red; font-weight:600;">DI BAWAH PG</span>' !!}</td>
                </tr>
                <tr class="score-total-row">
                    <td class="subject">Total Akumulasi Nilai</td>
                    <td>311</td>
                    <td style="font-size: 16px; font-weight: 800; color: #071739;">{{ $attempt->score_total }}</td>
                    <td>
                        @if($attempt->status === 'lulus')
                            <span class="status-badge status-lulus" style="font-size: 11px; padding: 3px 10px;">Memenuhi Syarat</span>
                        @else
                            <span class="status-badge status-tidak-lulus" style="font-size: 11px; padding: 3px 10px;">Tidak Memenuhi</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <div style="text-align: center; margin-top: 30px;">
            <p style="font-weight: 600; margin-bottom: 10px;">STATUS KELULUSAN AKHIR:</p>
            @if($attempt->status === 'lulus')
                <div class="status-badge status-lulus">LULUS PASSING GRADE</div>
            @else
                <div class="status-badge status-tidak-lulus">TIDAK LULUS PASSING GRADE</div>
            @endif
        </div>

        <div class="footer">
            <div>
                <p style="font-size: 12px; color: #666; margin-bottom: 5px;">Dicetak Otomatis oleh Sistem:</p>
                <p style="font-size: 11px; color: #999; margin: 0;">{{ now()->format('d M Y, H:i') }} WIB</p>
            </div>
            <div class="signature-box">
                <p style="margin: 0; font-size: 13px;">Jakarta, {{ now()->format('d F Y') }}</p>
                <p style="margin: 5px 0 0 0; font-weight: bold; font-size: 13px;">Direktur Utama Pilar Abdi</p>
                <div class="signature-line">
                    Hendrawan Prasetyo, M.B.A.
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            // Uncomment to auto-trigger print dialog
            // window.print();
        }
    </script>
</body>
</html>
