<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kelulusan - {{ $attempt->user->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Cinzel:wght@500;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 94vh;
        }
        .certificate-container {
            width: 1040px;
            height: 720px;
            padding: 40px;
            box-sizing: border-box;
            background: white;
            border: 20px solid #071739;
            outline: 5px solid #d4af37; /* Gold accent */
            outline-offset: -12px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }
        .watermark {
            position: absolute;
            font-size: 130px;
            font-family: 'Cinzel', serif;
            color: rgba(7, 23, 57, 0.03);
            font-weight: 800;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            pointer-events: none;
            z-index: 1;
            white-space: nowrap;
        }
        .logo {
            font-family: 'Cinzel', serif;
            font-size: 28px;
            font-weight: 800;
            color: #071739;
            letter-spacing: 2px;
            margin-top: 10px;
        }
        .logo-sub {
            font-size: 11px;
            color: #d4af37;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-top: -5px;
            font-weight: bold;
        }
        .certificate-title {
            font-family: 'Cinzel', serif;
            font-size: 42px;
            font-weight: 700;
            color: #071739;
            letter-spacing: 3px;
            margin: 15px 0 5px 0;
            text-transform: uppercase;
        }
        .certificate-subtitle {
            font-size: 14px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 500;
            border-bottom: 2px solid #d4af37;
            padding-bottom: 10px;
            width: 350px;
            margin: 0 auto;
        }
        .awarded-to {
            font-size: 16px;
            color: #64748b;
            margin-top: 25px;
            font-style: italic;
        }
        .student-name {
            font-family: 'Great Vibes', cursive;
            font-size: 56px;
            color: #071739;
            margin: 5px 0;
            font-weight: normal;
        }
        .certificate-text {
            font-size: 15px;
            line-height: 1.6;
            color: #334155;
            max-width: 700px;
            margin: 0 auto;
        }
        .highlight-score {
            font-weight: 700;
            color: #b45309; /* Bronze/Gold */
        }
        .certificate-footer {
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            margin-top: 20px;
            padding-bottom: 10px;
        }
        .sig-box {
            width: 250px;
            text-align: center;
        }
        .sig-line {
            border-top: 2px solid #cbd5e1;
            padding-top: 8px;
            margin-top: 55px;
            font-size: 14px;
            font-weight: bold;
            color: #0f172a;
        }
        .sig-title {
            font-size: 12px;
            color: #64748b;
            margin-top: 2px;
        }
        .gold-seal {
            width: 75px;
            height: 75px;
            background: #d4af37;
            border-radius: 50%;
            border: 4px double white;
            box-shadow: 0 4px 10px rgba(212, 175, 55, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cinzel', serif;
            font-size: 10px;
            font-weight: bold;
            color: white;
            text-align: center;
            position: relative;
        }
        .gold-seal::before, .gold-seal::after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            border-top: 30px solid #d4af37;
            bottom: -20px;
            z-index: -1;
        }
        .gold-seal::before {
            left: 10px;
            transform: rotate(-15deg);
        }
        .gold-seal::after {
            right: 10px;
            transform: rotate(15deg);
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
        }
        @media print {
            body {
                background: none;
                padding: 0;
            }
            .certificate-container {
                box-shadow: none;
                border: 20px solid #071739 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
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

    <div class="certificate-container">
        <div class="watermark">PILAR ABDI</div>

        <div>
            <div class="logo">PILAR ABDI</div>
            <div class="logo-sub">Bimbel Kedinasan</div>
        </div>

        <div>
            <div class="certificate-title">Sertifikat Kelulusan</div>
            <div class="certificate-subtitle">CAT SKD Simulation</div>
        </div>

        <div>
            <div class="awarded-to">Sertifikat ini dengan bangga dianugerahkan kepada:</div>
            <div class="student-name">{{ $attempt->user->name }}</div>
        </div>

        <div class="certificate-text">
            Dinyatakan <strong style="color: #059669;">LULUS PASSING GRADE</strong> dengan prestasi memuaskan pada simulasi CAT SKD Nasional 
            <strong>{{ $attempt->tryout->nama_tryout ?? 'Try Out CAT' }}</strong> dengan pencapaian nilai 
            <strong>TWK: {{ $attempt->score_twk }}</strong>, 
            <strong>TIU: {{ $attempt->score_tiu }}</strong>, dan 
            <strong>TKP: {{ $attempt->score_tkp }}</strong> 
            dengan Total Skor: <span class="highlight-score">{{ $attempt->score_total }}</span>.
        </div>

        <div class="certificate-footer">
            <div class="sig-box">
                <div class="sig-line">Hendrawan Prasetyo, M.B.A.</div>
                <div class="sig-title">Direktur Utama Pilar Abdi</div>
            </div>
            
            <div class="gold-seal">
                <div>OFFICIAL<br>SEAL</div>
            </div>

            <div class="sig-box">
                <div class="sig-line">{{ now()->format('d F Y') }}</div>
                <div class="sig-title">Tanggal Penerbitan</div>
            </div>
        </div>
    </div>

</body>
</html>
