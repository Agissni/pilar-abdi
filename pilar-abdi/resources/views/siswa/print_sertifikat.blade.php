@extends('layouts.app')
@section('title', 'Rapor Hasil Try Out - ' . $attempt->user->name)

@section('content')
<div class="container py-5">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="/hasil-tryout" class="btn btn-outline-secondary fw-bold px-4 py-2" style="border-radius: 10px; font-size: 13px;">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat Hasil
        </a>
    </div>

    <!-- Main Scorecard Card -->
    <div class="card border-0 shadow mx-auto" style="max-width: 900px; border-radius: 20px; overflow: hidden; background: radial-gradient(circle, #ffffff 0%, #fdfcf7 60%, #faf6eb 100%); border-left: 8px solid #071739 !important; border-right: 8px solid #071739 !important; border-top: 2px solid #d4af37 !important; border-bottom: 2px solid #d4af37 !important; position: relative;">
        
        <!-- Subtle Watermark Background -->
        <div class="d-none d-md-block" style="position: absolute; font-size: 80px; font-family: 'Cinzel', serif; color: rgba(7, 23, 57, 0.015); font-weight: 900; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-25deg); pointer-events: none; z-index: 1; white-space: nowrap; letter-spacing: 5px;">
            PILAR ABDI
        </div>

        <div class="card-body p-4 p-md-5 position-relative" style="z-index: 2;">
            
            <!-- Header Logo -->
            <div class="text-center mb-4">
                <div class="fw-bold text-uppercase" style="font-family: 'Cinzel', serif; font-size: 26px; color: #071739; letter-spacing: 3px;">PILAR ABDI</div>
                <div style="font-size: 10px; color: #d4af37; text-transform: uppercase; letter-spacing: 4px; font-weight: 700; margin-top: -3px;">Bimbel Kedinasan</div>
                <div class="mx-auto mt-3" style="width: 80px; height: 3px; background: #d4af37; border-radius: 2px;"></div>
            </div>

            <!-- Document Title -->
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1" style="font-family: 'Cinzel', serif; font-size: 32px; background: linear-gradient(135deg, #a67c1e 0%, #d4af37 25%, #f9f5bb 45%, #d4af37 70%, #a67c1e 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: 3px; text-transform: uppercase; text-shadow: 1px 1px 0px rgba(255,255,255,0.6);">
                    Rapor Hasil Try Out
                </h2>
                <div class="text-muted small text-uppercase tracking-wider fw-semibold" style="letter-spacing: 2px; font-size: 11px;">
                    CAT SKD Simulation Record
                </div>
            </div>

            <!-- Student Metadata -->
            <div class="text-center mb-4">
                <span class="text-muted small d-block mb-1" style="font-style: italic;">Laporan hasil evaluasi ini diterbitkan atas nama siswa:</span>
                <h3 class="fw-bold text-dark" style="font-family: 'Great Vibes', cursive; font-size: 52px; margin: 0;">
                    {{ $attempt->user->name }}
                </h3>
            </div>

            <!-- Status Description -->
            <div class="text-center text-secondary mb-4 mx-auto" style="max-width: 700px; font-size: 14px; line-height: 1.6;">
                @if($attempt->status === 'lulus')
                    Siswa di atas dinyatakan <strong class="text-success" style="font-weight: 700;">LULUS PASSING GRADE</strong> dengan prestasi memuaskan pada simulasi ujian CAT SKD:<br>
                @else
                    Siswa di atas dinyatakan <strong class="text-danger" style="font-weight: 700;">TELAH MENYELESAIKAN EVALUASI</strong> dengan capaian skor pada simulasi ujian CAT SKD:<br>
                @endif
                <strong class="text-dark">{{ $attempt->tryout->nama_tryout ?? 'Try Out CAT' }}</strong>. Berikut adalah rincian perolehan nilai resmi yang telah dicatat oleh sistem:
            </div>

            <!-- Scorecard Grid -->
            <div class="text-center mb-5">
                <div class="d-inline-flex flex-wrap gap-3 justify-content-center p-3 bg-white bg-opacity-70 rounded-4 border" style="border-color: rgba(212, 175, 55, 0.2) !important; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
                    
                    <div class="p-3 bg-white border rounded-3 text-center" style="min-width: 100px; border-radius: 12px !important;">
                        <span class="text-muted small d-block mb-1 fw-semibold" style="font-size: 10px; letter-spacing: 1px;">TWK</span>
                        <h4 class="fw-bold mb-0 text-dark" style="font-family: 'Cinzel', serif; font-size: 24px;">{{ $attempt->score_twk }}</h4>
                        <span class="badge bg-light text-secondary border mt-2" style="font-size: 9px; border-radius: 30px;">Min. 65</span>
                    </div>

                    <div class="p-3 bg-white border rounded-3 text-center" style="min-width: 100px; border-radius: 12px !important;">
                        <span class="text-muted small d-block mb-1 fw-semibold" style="font-size: 10px; letter-spacing: 1px;">TIU</span>
                        <h4 class="fw-bold mb-0 text-dark" style="font-family: 'Cinzel', serif; font-size: 24px;">{{ $attempt->score_tiu }}</h4>
                        <span class="badge bg-light text-secondary border mt-2" style="font-size: 9px; border-radius: 30px;">Min. 80</span>
                    </div>

                    <div class="p-3 bg-white border rounded-3 text-center" style="min-width: 100px; border-radius: 12px !important;">
                        <span class="text-muted small d-block mb-1 fw-semibold" style="font-size: 10px; letter-spacing: 1px;">TKP</span>
                        <h4 class="fw-bold mb-0 text-dark" style="font-family: 'Cinzel', serif; font-size: 24px;">{{ $attempt->score_tkp }}</h4>
                        <span class="badge bg-light text-secondary border mt-2" style="font-size: 9px; border-radius: 30px;">Min. 156</span>
                    </div>

                    <div class="p-3 border rounded-3 text-center text-white" style="min-width: 130px; background: linear-gradient(135deg, #071739 0%, #1e293b 100%); border-color: #d4af37 !important; border-radius: 12px !important;">
                        <span class="text-white-50 small d-block mb-1 fw-semibold" style="font-size: 10px; letter-spacing: 1px;">TOTAL SKOR</span>
                        <h4 class="fw-bold mb-0 text-warning" style="font-family: 'Cinzel', serif; font-size: 24px;">{{ $attempt->score_total }}</h4>
                        <span class="badge {{ $attempt->status === 'lulus' ? 'bg-success' : 'bg-danger' }} mt-2 text-white" style="font-size: 9px; font-weight: 700; border-radius: 30px;">
                            {{ $attempt->status === 'lulus' ? 'LULUS' : 'TIDAK LULUS' }}
                        </span>
                    </div>

                </div>
            </div>

            <!-- Footer Signatures & Official Seal -->
            <div class="row g-4 align-items-end mt-4 text-center">
                
                <!-- Director Signature -->
                <div class="col-sm-4 order-2 order-sm-1">
                    <div class="mx-auto" style="width: 180px; border-bottom: 2px solid #071739; padding-top: 40px; font-size: 13px; font-weight: 700; color: #0f172a;">
                        Hendrawan Prasetyo, M.B.A.
                    </div>
                    <div class="text-muted small mt-1" style="font-size: 11px;">Direktur Utama Pilar Abdi</div>
                </div>
                
                <!-- Official Seal Graphic -->
                <div class="col-sm-4 order-1 order-sm-2 mb-3 mb-sm-0 d-flex justify-content-center">
                    <div class="position-relative" style="width: 80px; height: 80px;">
                        <div class="position-absolute" style="width: 14px; height: 50px; background: #b45309; bottom: -20px; left: 22px; transform: rotate(-10deg); border-bottom: 5px solid transparent; z-index: 1;"></div>
                        <div class="position-absolute" style="width: 14px; height: 50px; background: #b45309; bottom: -20px; right: 22px; transform: rotate(10deg); border-bottom: 5px solid transparent; z-index: 1;"></div>
                        <div class="position-relative d-flex align-items-center justify-content-center text-center" style="width: 70px; height: 70px; background: radial-gradient(circle, #ffd700 0%, #d4af37 60%, #b8860b 100%); border-radius: 50%; border: 3px double #fff; box-shadow: 0 4px 10px rgba(184,134,11,0.3); font-family: 'Cinzel', serif; font-size: 7px; font-weight: 800; color: #071739; line-height: 1.2; z-index: 2; margin: 5px auto;">
                            <div>PILAR ABDI<br>OFFICIAL<br>SEAL</div>
                        </div>
                    </div>
                </div>

                <!-- Date Issued -->
                <div class="col-sm-4 order-3 order-sm-3">
                    <div class="mx-auto" style="width: 180px; border-bottom: 2px solid #071739; padding-top: 40px; font-size: 13px; font-weight: 700; color: #0f172a;">
                        Depok, {{ $attempt->created_at->format('d F Y') }}
                    </div>
                    <div class="text-muted small mt-1" style="font-size: 11px;">Tanggal Penerbitan</div>
                </div>

            </div>

        </div>
    </div>

    <!-- Discussion / Review Section -->
    <div class="card border-0 shadow-sm mx-auto mt-4" style="max-width: 900px; border-radius: 20px; border: 1px solid #cbd5e1;">
        <div class="card-body p-4 p-md-5">
            <h4 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2" style="font-family: 'Cinzel', serif;">
                <i class="bi bi-book-fill text-primary"></i> Kunci Jawaban & Pembahasan Ujian
            </h4>
            <p class="text-secondary small mb-4">Silakan tinjau lembar soal di bawah ini untuk mempelajari kunci jawaban dan pembahasan analitis yang telah disusun oleh Mentor Ahli kami.</p>

            @if($questions->isEmpty())
                <div class="text-center py-4 text-muted small">
                    <i class="bi bi-journals fs-2 text-secondary mb-2 d-block"></i>
                    Belum ada bank soal atau pembahasan untuk tryout ini.
                </div>
            @else
                <div class="d-flex flex-column gap-4">
                    @foreach($questions as $index => $q)
                        <div class="p-3 p-md-4 rounded-4 bg-light border border-opacity-50 border-secondary text-start position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-primary px-3 py-1.5 text-uppercase fw-bold" style="font-size: 10px; border-radius: 30px;">
                                    Soal No. {{ $q->nomor_soal }} &bull; {{ $q->kategori }}
                                </span>
                            </div>
                            
                            <p class="fw-semibold text-dark mb-3" style="font-size: 14px; line-height: 1.6;">
                                {!! nl2br(e($q->pertanyaan)) !!}
                            </p>

                            <!-- Options List -->
                            <div class="d-flex flex-column gap-2 mb-3">
                                <div class="p-2.5 rounded-3 border bg-white small d-flex gap-2">
                                    <span class="fw-bold text-secondary">A.</span>
                                    <span>{{ $q->pilihan_a }}</span>
                                </div>
                                <div class="p-2.5 rounded-3 border bg-white small d-flex gap-2">
                                    <span class="fw-bold text-secondary">B.</span>
                                    <span>{{ $q->pilihan_b }}</span>
                                </div>
                                <div class="p-2.5 rounded-3 border bg-white small d-flex gap-2">
                                    <span class="fw-bold text-secondary">C.</span>
                                    <span>{{ $q->pilihan_c }}</span>
                                </div>
                                <div class="p-2.5 rounded-3 border bg-white small d-flex gap-2">
                                    <span class="fw-bold text-secondary">D.</span>
                                    <span>{{ $q->pilihan_d }}</span>
                                </div>
                                <div class="p-2.5 rounded-3 border bg-white small d-flex gap-2">
                                    <span class="fw-bold text-secondary">E.</span>
                                    <span>{{ $q->pilihan_e }}</span>
                                </div>
                            </div>

                            <!-- Answer Key & Explanation -->
                            <div class="p-3 rounded-3" style="background-color: #f0fdf4; border: 1px solid #bbf7d0;">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-check-circle-fill text-success fs-6"></i>
                                    <strong class="text-success small">Kunci Jawaban: {{ strtoupper($q->jawaban_benar) }}</strong>
                                </div>
                                <div class="small text-secondary" style="line-height: 1.6;">
                                    <strong>Pembahasan:</strong><br>
                                    @if(trim($q->pembahasan))
                                        {!! nl2br(e($q->pembahasan)) !!}
                                    @else
                                        <span class="text-muted italic">Tidak ada pembahasan tertulis. Silakan hubungi mentor untuk info lebih lanjut.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
