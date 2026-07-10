@extends('layouts.app')
@section('title', 'Simulasi Try Out CAT SKD')

@section('content')

<div class="container py-5" id="tryoutContainer">

    <!-- STATE 1: DAFTAR TRY OUT -->
    <div id="state-list" class="state-section">
        <div class="text-center mb-5">
            <h1 class="fw-bold" style="color:#071739;">Try Out Online</h1>
            <p class="text-muted">Simulasi CAT SKD Nasional Terintegrasi</p>
        </div>

        <div class="row g-4 justify-content-center">
            @if($tryouts->isEmpty())
                <div class="col-md-8 text-center py-5">
                    <div class="card shadow border-0 p-5 rounded-4 bg-white">
                        <i class="bi bi-patch-question-fill text-secondary mb-3" style="font-size: 64px; opacity: 0.5;"></i>
                        <h4 class="fw-bold text-dark">Belum Ada Try Out Tersedia</h4>
                        <p class="text-muted">Jadwal Try Out belum dirilis oleh Admin. Silakan periksa kembali halaman ini secara berkala.</p>
                    </div>
                </div>
            @else
                @foreach($tryouts as $to)
                    <div class="col-md-4">
                        @if($to->status === 'belum_dimulai')
                            <div class="card border-0 shadow h-100 opacity-75" style="border-radius: 16px; background-color: #fafafa;">
                                <div class="card-header text-white fw-bold d-flex justify-content-between align-items-center"
                                     style="background:#64748b; padding: 15px 20px; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                    <span>CAT SKD</span>
                                    <span class="badge bg-warning text-dark" style="font-size: 11px;">Belum Mulai</span>
                                </div>
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="fw-bold mb-3 text-secondary">{{ $to->nama_tryout }}</h5>
                                        <p class="text-secondary small mb-3">
                                            {{ $to->deskripsi ?? 'Tidak ada deskripsi.' }}
                                        </p>
                                        <div class="d-flex flex-column gap-2 mb-4">
                                            <div class="d-flex align-items-center text-secondary small gap-2">
                                                <i class="bi bi-file-earmark-text"></i>
                                                <span><strong>Jumlah Soal:</strong> {{ $to->jumlah_soal }} Soal</span>
                                            </div>
                                            <div class="d-flex align-items-center text-secondary small gap-2">
                                                <i class="bi bi-clock"></i>
                                                <span><strong>Durasi:</strong> {{ $to->durasi }} Menit</span>
                                            </div>
                                            <div class="d-flex align-items-center text-secondary small gap-2 text-warning fw-medium">
                                                <i class="bi bi-calendar-event"></i>
                                                <span>Mulai: {{ $to->tanggal_mulai->format('d M Y, H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-secondary w-100 py-3 fw-bold" style="border-radius: 12px;" disabled>
                                        <i class="bi bi-lock-fill me-1"></i> BELUM DIBUKA
                                    </button>
                                </div>
                            </div>
                        @elseif($to->status === 'aktif')
                            <div class="card shadow border-0 h-100 d-flex flex-column" style="border-radius: 16px;">
                                <div class="card-header text-white fw-bold d-flex justify-content-between align-items-center"
                                     style="background:#071739; padding: 15px 20px; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                    <span>CAT SKD</span>
                                    <span class="badge bg-success" style="font-size: 11px;">Tersedia</span>
                                </div>
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="fw-bold mb-3 text-dark">{{ $to->nama_tryout }}</h5>
                                        <p class="text-secondary small mb-3">
                                            {{ $to->deskripsi ?? 'Tidak ada deskripsi.' }}
                                        </p>
                                        <div class="d-flex flex-column gap-2 mb-4">
                                            <div class="d-flex align-items-center text-secondary small gap-2">
                                                <i class="bi bi-file-earmark-text text-primary"></i>
                                                <span><strong>Jumlah Soal:</strong> {{ $to->jumlah_soal }} Soal</span>
                                            </div>
                                            <div class="d-flex align-items-center text-secondary small gap-2">
                                                <i class="bi bi-clock text-warning"></i>
                                                <span><strong>Durasi:</strong> {{ $to->durasi }} Menit</span>
                                            </div>
                                            <div class="d-flex align-items-center text-secondary small gap-2 text-danger">
                                                <i class="bi bi-calendar-check"></i>
                                                <span>Batas: {{ $to->tanggal_berakhir->format('d M Y, H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn w-100 py-3 fw-bold btn-start-exam text-white" 
                                            style="background: #071739; border-radius: 12px;"
                                            onclick="goToInstructions('{{ $to->id_tryout }}', '{{ addslashes($to->nama_tryout) }}', {{ $to->jumlah_soal }}, {{ $to->durasi }})">
                                        MULAI SEKARANG
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="card border-0 shadow h-100 opacity-75" style="border-radius: 16px; background-color: #f8fafc;">
                                <div class="card-header text-white fw-bold d-flex justify-content-between align-items-center"
                                     style="background:#1e293b; padding: 15px 20px; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                    <span>CAT SKD</span>
                                    <span class="badge bg-secondary" style="font-size: 11px;">Selesai</span>
                                </div>
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="fw-bold mb-3 text-secondary">{{ $to->nama_tryout }}</h5>
                                        <p class="text-secondary small mb-3">
                                            {{ $to->deskripsi ?? 'Tidak ada deskripsi.' }}
                                        </p>
                                        <div class="d-flex flex-column gap-2 mb-4">
                                            <div class="d-flex align-items-center text-secondary small gap-2">
                                                <i class="bi bi-file-earmark-text"></i>
                                                <span><strong>Jumlah Soal:</strong> {{ $to->jumlah_soal }} Soal</span>
                                            </div>
                                            <div class="d-flex align-items-center text-secondary small gap-2">
                                                <i class="bi bi-clock"></i>
                                                <span><strong>Durasi:</strong> {{ $to->durasi }} Menit</span>
                                            </div>
                                            <div class="d-flex align-items-center text-secondary small gap-2 text-muted">
                                                <i class="bi bi-calendar-x"></i>
                                                <span>Berakhir: {{ $to->tanggal_berakhir->format('d M Y, H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-secondary w-100 py-3 fw-bold" style="border-radius: 12px;" disabled>
                                        SUDAH BERAKHIR
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>


    <!-- STATE 2: PETUNJUK TRY OUT -->
    <div id="state-instructions" class="state-section d-none">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow border-0" style="border-radius: 20px;">
                    <div class="card-header py-4 text-center text-white" style="background: #071739; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                        <h4 class="fw-bold mb-0">Petunjuk Pelaksanaan Try Out</h4>
                    </div>
                    <div class="card-body p-5">
                        <h4 class="fw-bold text-dark mb-4 text-center" id="instruction-title">Try Out Mini Simulator I</h4>
                        
                        <table class="table table-bordered mb-4">
                            <tbody>
                                <tr>
                                    <th class="bg-light w-40">Jumlah Soal</th>
                                    <td id="instruction-soal">15 Soal</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Durasi Ujian</th>
                                    <td id="instruction-durasi">15 Menit</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Kategori Soal</th>
                                    <td>Tes Wawasan Kebangsaan (TWK), Tes Inteligensia Umum (TIU), Tes Karakteristik Pribadi (TKP)</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Sistem Penilaian</th>
                                    <td>
                                        <ul class="mb-0 ps-3 small text-secondary">
                                            <li><strong>TWK & TIU:</strong> Benar mendapat 5 poin, Salah/Tidak Menjawab 0 poin.</li>
                                            <li><strong>TKP:</strong> Bernilai skala 1-5 poin. Tidak menjawab 0 poin.</li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="alert alert-warning d-flex gap-2 align-items-start" style="border-radius: 12px;">
                            <i class="bi bi-exclamation-triangle-fill fs-5 text-warning"></i>
                            <div class="small">
                                <strong>PENTING:</strong> Waktu hitung mundur akan langsung berjalan begitu Anda menekan tombol <strong>Mulai Sekarang</strong>. Pastikan koneksi internet Anda stabil dan tidak meninggalkan halaman ujian hingga selesai.
                            </div>
                        </div>

                        <div class="row g-3 mt-4">
                            <div class="col-6">
                                <button class="btn btn-outline-secondary w-100 py-3 fw-bold" style="border-radius: 12px;" onclick="goToState('list')">
                                    Batal
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn text-white w-100 py-3 fw-bold" style="background:#071739; border-radius: 12px;" onclick="startExam()">
                                    Mulai Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- STATE 3: PENGERJAAN TRY OUT (SIMULASI CAT) -->
    <div id="state-exam" class="state-section d-none">
        
        <!-- HEADER KONDISI UJIAN -->
        <div class="row g-3 mb-4 align-items-center bg-white p-3 shadow-sm rounded-4 border">
            <div class="col-md-6 col-lg-8">
                <h5 class="fw-bold mb-1 text-dark" id="exam-package-title">Try Out Mini Simulator I</h5>
                <span class="badge bg-primary px-3 py-2 fs-7" id="question-category-badge" style="border-radius: 20px;">Kategori: TWK</span>
            </div>
            <div class="col-md-6 col-lg-4 text-md-end">
                <div class="d-inline-flex align-items-center gap-2 px-4 py-2 bg-danger bg-opacity-10 text-danger fw-bold rounded-pill" style="border: 1px solid rgba(220,53,69,0.2);">
                    <i class="bi bi-clock-history spinner-border spinner-border-sm text-danger border-0" role="status" style="animation-duration: 2s;"></i>
                    <span>Sisa Waktu:</span>
                    <span id="exam-timer">15:00</span>
                </div>
            </div>
        </div>

        <div class="row g-4">
            
            <!-- LEFT PANEL: SOAL & OPSI (Col 8) -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4 h-100 d-flex flex-column justify-content-between" style="border-radius: 16px; min-height: 480px;">
                    
                    <div class="card-body p-4">
                        <!-- Nomor Soal -->
                        <h6 class="text-secondary fw-semibold mb-3" id="current-question-number-title">Soal No. 1 dari 15</h6>
                        
                        <!-- Pertanyaan -->
                        <div class="p-3 mb-4 rounded-3 text-dark fw-medium fs-5" id="question-text-box" style="background-color: #f8fafc; border-left: 5px solid #071739; line-height: 1.6;">
                            [Pertanyaan]
                        </div>

                        <!-- Opsi Jawaban -->
                        <div class="d-flex flex-column gap-3" id="options-container">
                            <!-- Opsi A -->
                            <div class="option-row p-3 border rounded-3 d-flex align-items-center gap-3 option-card" style="cursor: pointer; transition: all 0.2s;" onclick="selectOption('A')">
                                <input class="form-check-input flex-shrink-0" type="radio" name="options-group" id="opt-a" value="A" style="pointer-events: none;">
                                <label class="form-check-label text-dark fw-medium mb-0 flex-grow-1" for="opt-a" style="cursor: pointer;">
                                    A. [Opsi A]
                                </label>
                            </div>
                            <!-- Opsi B -->
                            <div class="option-row p-3 border rounded-3 d-flex align-items-center gap-3 option-card" style="cursor: pointer; transition: all 0.2s;" onclick="selectOption('B')">
                                <input class="form-check-input flex-shrink-0" type="radio" name="options-group" id="opt-b" value="B" style="pointer-events: none;">
                                <label class="form-check-label text-dark fw-medium mb-0 flex-grow-1" for="opt-b" style="cursor: pointer;">
                                    B. [Opsi B]
                                </label>
                            </div>
                            <!-- Opsi C -->
                            <div class="option-row p-3 border rounded-3 d-flex align-items-center gap-3 option-card" style="cursor: pointer; transition: all 0.2s;" onclick="selectOption('C')">
                                <input class="form-check-input flex-shrink-0" type="radio" name="options-group" id="opt-c" value="C" style="pointer-events: none;">
                                <label class="form-check-label text-dark fw-medium mb-0 flex-grow-1" for="opt-c" style="cursor: pointer;">
                                    C. [Opsi C]
                                </label>
                            </div>
                            <!-- Opsi D -->
                            <div class="option-row p-3 border rounded-3 d-flex align-items-center gap-3 option-card" style="cursor: pointer; transition: all 0.2s;" onclick="selectOption('D')">
                                <input class="form-check-input flex-shrink-0" type="radio" name="options-group" id="opt-d" value="D" style="pointer-events: none;">
                                <label class="form-check-label text-dark fw-medium mb-0 flex-grow-1" for="opt-d" style="cursor: pointer;">
                                    D. [Opsi D]
                                </label>
                            </div>
                            <!-- Opsi E -->
                            <div class="option-row p-3 border rounded-3 d-flex align-items-center gap-3 option-card" style="cursor: pointer; transition: all 0.2s;" onclick="selectOption('E')">
                                <input class="form-check-input flex-shrink-0" type="radio" name="options-group" id="opt-e" value="E" style="pointer-events: none;">
                                <label class="form-check-label text-dark fw-medium mb-0 flex-grow-1" for="opt-e" style="cursor: pointer;">
                                    E. [Opsi E]
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER NAVIGASI SOAL -->
                    <div class="card-footer p-4 bg-white border-top d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <button class="btn btn-outline-secondary px-4 py-3 fw-bold" id="btn-prev-question" onclick="prevQuestion()" style="border-radius: 12px; width: 140px;">
                            <i class="bi bi-chevron-left me-1"></i> Sebelumnya
                        </button>
                        
                        <div class="form-check form-switch bg-warning bg-opacity-10 text-dark-emphasis px-4 py-2 border border-warning border-opacity-20" style="border-radius: 12px;">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="check-ragu" onchange="toggleRaguRagu(this)">
                            <label class="form-check-label fw-bold small text-warning" for="check-ragu">RAGU-RAGU</label>
                        </div>
                        
                        <button class="btn text-white px-4 py-3 fw-bold" id="btn-next-question" onclick="nextQuestion()" style="background:#071739; border-radius: 12px; width: 140px;">
                            Selanjutnya <i class="bi bi-chevron-right ms-1"></i>
                        </button>
                    </div>

                </div>
            </div>

            <!-- RIGHT PANEL: GRID NAVIGASI NOMOR (Col 4) -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 p-4 h-100 d-flex flex-column justify-content-between" style="border-radius: 16px;">
                    <div>
                        <h5 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                            <i class="bi bi-grid-3x3-gap-fill text-primary"></i> Navigasi Soal
                        </h5>
                        <p class="text-secondary small mb-4">Warna hijau menunjukkan soal terjawab, kuning ragu-ragu, dan abu-abu belum dijawab.</p>
                        
                        <div class="row g-2 mb-4" id="navigation-grid-container" style="max-height: 250px; overflow-y: auto;">
                            <!-- Mapped dynamically in JS -->
                        </div>
                    </div>

                    <button class="btn btn-success w-100 py-3 fw-bold" style="border-radius: 12px;" onclick="triggerSelesaiUjian()">
                        SELESAI UJIAN
                    </button>
                </div>
            </div>

        </div>

    </div>


    <!-- STATE 4: HASIL TRY OUT -->
    <div id="state-results" class="state-section d-none">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                    
                    <div class="text-center py-5 text-white position-relative" id="result-header-bg" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                        <div class="position-absolute top-50 start-50 translate-middle opacity-5">
                            <i class="bi bi-trophy-fill" style="font-size: 200px;"></i>
                        </div>
                        <h5 class="text-uppercase tracking-wide text-warning fw-bold mb-2">Hasil Evaluasi</h5>
                        <h2 class="fw-extrabold" id="result-package-title">Try Out Mini Simulator I</h2>
                        
                        <!-- Status Kelulusan Badge -->
                        <div class="mt-4">
                            <span class="fs-4 px-4 py-2 fw-extrabold rounded-pill shadow" id="result-status-badge">
                                LULUS PASSING GRADE
                            </span>
                        </div>
                    </div>

                    <div class="card-body p-5">
                        
                        <!-- Grid Nilai Breakdown -->
                        <div class="row g-3 mb-5 text-center">
                            <div class="col-md-3">
                                <div class="p-3 border rounded-3 bg-light">
                                    <span class="text-secondary small d-block mb-1">Skor TWK</span>
                                    <h3 class="fw-bold mb-0 text-dark" id="res-score-twk">25</h3>
                                    <small class="text-muted">Min. 15</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 border rounded-3 bg-light">
                                    <span class="text-secondary small d-block mb-1">Skor TIU</span>
                                    <h3 class="fw-bold mb-0 text-dark" id="res-score-tiu">25</h3>
                                    <small class="text-muted">Min. 15</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 border rounded-3 bg-light">
                                    <span class="text-secondary small d-block mb-1">Skor TKP</span>
                                    <h3 class="fw-bold mb-0 text-dark" id="res-score-tkp">25</h3>
                                    <small class="text-muted">Min. 18</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 rounded-3 text-white" style="background:#071739;">
                                    <span class="text-white-50 small d-block mb-1">Total Nilai</span>
                                    <h3 class="fw-bold mb-0 text-warning" id="res-score-total">75</h3>
                                    <small class="text-white-50">Maks. 75</small>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar Visual representation -->
                        <h6 class="fw-bold text-dark mb-2 text-center">Rasio Kelulusan Anda</h6>
                        <div class="progress mb-4" style="height: 15px; border-radius: 30px;">
                            <div class="progress-bar bg-success" role="progressbar" id="res-progress-bar" style="width: 100%"></div>
                        </div>

                        <div class="alert alert-info d-flex gap-2 align-items-start rounded-3" style="background:#fafbfc;">
                            <i class="bi bi-info-circle-fill text-info fs-5"></i>
                            <div class="small" id="result-description-text">
                                Selamat! Hasil pengerjaan Anda menunjukkan bahwa Anda telah memenuhi nilai ambang batas (*passing grade*) yang ditentukan untuk semua kategori materi. Tetap konsisten belajar dan pertahankan performa Anda.
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button class="btn btn-primary px-5 py-3 fw-bold text-white border-0" 
                                    style="background:#071739; border-radius: 12px;"
                                    onclick="goToState('list')">
                                KEMBALI KE DAFTAR TRY OUT
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- CONFIRMATION MODAL -->
<div class="modal fade" id="confirmSelesaiModal" tabindex="-1" aria-hidden="true" style="backdrop-filter: blur(5px);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header py-3" style="background: #071739; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <h5 class="modal-title fw-bold text-white"><i class="bi bi-question-circle me-2"></i>Selesai Ujian?</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning mb-3 rounded-circle" style="width:60px; height:60px;">
                    <i class="bi bi-exclamation-circle-fill fs-2"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Konfirmasi Pengumpulan</h5>
                <p class="text-secondary small mb-3" id="confirm-modal-status-text">Anda sudah menjawab 0 dari 15 soal.</p>
                <div class="alert alert-danger small d-none" id="unanswered-warning-box" style="border-radius: 10px;">
                    <i class="bi bi-exclamation-triangle-fill"></i> Masih ada soal yang belum dijawab. Jawaban kosong bernilai 0.
                </div>
                <p class="text-muted small mb-0">Apakah Anda yakin ingin menyelesaikan ujian sekarang? Setelah dikirim, jawaban tidak dapat diubah lagi.</p>
            </div>
            <div class="modal-footer p-3 border-top-0 d-flex justify-content-center gap-3">
                <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="border-radius: 10px; min-width: 120px;">Lanjutkan</button>
                <button type="button" class="btn btn-danger px-4 py-2 text-white" id="btn-submit-exam-final" onclick="submitExam()" style="border-radius: 10px; min-width: 120px;">Ya, Selesai</button>
            </div>
        </div>
    </div>
</div>

<script>
// QUIZ ENGINE DATA & LOGIC

const questionsData = [
    // TWK (1-5)
    {
        id: 1,
        category: 'TWK',
        categoryFull: 'Tes Wawasan Kebangsaan (TWK)',
        question: 'UUD 1945 telah mengalami beberapa kali amandemen. Amandemen pertama dilakukan pada tahun...',
        options: {
            A: 'A. 1998',
            B: 'B. 1999',
            C: 'C. 2000',
            D: 'D. 2001',
            E: 'E. 2002'
        },
        correct: 'B'
    },
    {
        id: 2,
        category: 'TWK',
        categoryFull: 'Tes Wawasan Kebangsaan (TWK)',
        question: 'Lambang negara Indonesia adalah Garuda Pancasila dengan semboyan Bhinneka Tunggal Ika. Semboyan ini diambil dari kitab...',
        options: {
            A: 'A. Sutasoma',
            B: 'B. Negarakertagama',
            C: 'C. Arjunawiwaha',
            D: 'D. Bharatayudha',
            E: 'E. Ramayana'
        },
        correct: 'A'
    },
    {
        id: 3,
        category: 'TWK',
        categoryFull: 'Tes Wawasan Kebangsaan (TWK)',
        question: 'Badan Penyelidik Usaha-usaha Persiapan Kemerdekaan Indonesia (BPUPKI) dibentuk pada tanggal...',
        options: {
            A: 'A. 1 Maret 1945',
            B: 'B. 29 Mei 1945',
            C: 'C. 1 Juni 1945',
            D: 'D. 10 Juli 1945',
            E: 'E. 17 Agustus 1945'
        },
        correct: 'A'
    },
    {
        id: 4,
        category: 'TWK',
        categoryFull: 'Tes Wawasan Kebangsaan (TWK)',
        question: 'Pengakuan persamaan derajat, hak, dan kewajiban antara sesama manusia merupakan pencerminan sila Pancasila ke...',
        options: {
            A: 'A. 1',
            B: 'B. 2',
            C: 'C. 3',
            D: 'D. 4',
            E: 'E. 5'
        },
        correct: 'B'
    },
    {
        id: 5,
        category: 'TWK',
        categoryFull: 'Tes Wawasan Kebangsaan (TWK)',
        question: 'Siapakah tokoh yang mengemukakan istilah Pancasila pertama kali pada sidang BPUPKI tanggal 1 Juni 1945?',
        options: {
            A: 'A. Drs. Moh. Hatta',
            B: 'B. Prof. Dr. Soepomo',
            C: 'C. Ir. Soekarno',
            D: 'D. Muh. Yamin',
            E: 'E. Radjiman Wedyodiningrat'
        },
        correct: 'C'
    },

    // TIU (6-10)
    {
        id: 6,
        category: 'TIU',
        categoryFull: 'Tes Inteligensia Umum (TIU)',
        question: 'Deret angka: 2, 4, 8, 16, 32, ... Angka berikutnya adalah...',
        options: {
            A: 'A. 40',
            B: 'B. 48',
            C: 'C. 64',
            D: 'D. 80',
            E: 'E. 128'
        },
        correct: 'C'
    },
    {
        id: 7,
        category: 'TIU',
        categoryFull: 'Tes Inteligensia Umum (TIU)',
        question: 'Jika semua guru adalah pendidik, dan sebagian pendidik adalah penulis. Manakah kesimpulan yang paling tepat?',
        options: {
            A: 'A. Semua guru adalah penulis.',
            B: 'B. Sebagian guru adalah penulis.',
            C: 'C. Semua penulis adalah guru.',
            D: 'D. Sebagian pendidik bukan guru.',
            E: 'E. Tidak dapat disimpulkan.'
        },
        correct: 'B'
    },
    {
        id: 8,
        category: 'TIU',
        categoryFull: 'Tes Inteligensia Umum (TIU)',
        question: 'Mobil : Bensin = Pelari : ...',
        options: {
            A: 'A. Makanan',
            B: 'B. Sepatu',
            C: 'C. Lintasan',
            D: 'D. Air',
            E: 'E. Kaos'
        },
        correct: 'A'
    },
    {
        id: 9,
        category: 'TIU',
        categoryFull: 'Tes Inteligensia Umum (TIU)',
        question: 'Hasil dari 2 + 3 x 4 - 6 / 2 adalah...',
        options: {
            A: 'A. 17',
            B: 'B. 11',
            C: 'C. 7',
            D: 'D. 14',
            E: 'E. 9'
        },
        correct: 'B'
    },
    {
        id: 10,
        category: 'TIU',
        categoryFull: 'Tes Inteligensia Umum (TIU)',
        question: 'Anton selesai membaca buku dalam 6 hari dengan membaca 20 halaman per hari. Jika ia ingin selesai dalam 4 hari, berapa halaman yang harus dibaca per hari?',
        options: {
            A: 'A. 25',
            B: 'B. 30',
            C: 'C. 35',
            D: 'D. 40',
            E: 'E. 45'
        },
        correct: 'B'
    },

    // TKP (11-15)
    {
        id: 11,
        category: 'TKP',
        categoryFull: 'Tes Karakteristik Pribadi (TKP)',
        question: 'Anda ditugaskan menyelesaikan pekerjaan mendadak di luar jam kantor, padahal Anda sudah berjanji makan malam bersama keluarga. Sikap Anda...',
        options: {
            A: 'A. Menyelesaikan pekerjaan terlebih dahulu lalu meminta maaf pada keluarga.',
            B: 'B. Meminta rekan kerja menyelesaikan dan Anda membayar upahnya.',
            C: 'C. Menolak pekerjaan tersebut karena hak keluarga adalah prioritas.',
            D: 'D. Membawa pekerjaan tersebut pulang untuk dikerjakan di rumah sambil berkumpul.',
            E: 'E. Mengerjakan seadanya agar bisa pulang tepat waktu.'
        },
        points: { A: 5, B: 3, C: 1, D: 4, E: 2 }
    },
    {
        id: 12,
        category: 'TKP',
        categoryFull: 'Tes Karakteristik Pribadi (TKP)',
        question: 'Saat Anda sedang sibuk melayani pelanggan, seorang rekan kerja datang meminta bantuan Anda untuk urusan pribadinya. Sikap Anda...',
        options: {
            A: 'A. Membantunya segera karena rekan kerja harus saling menolong.',
            B: 'B. Meminta rekan tersebut menunggu hingga Anda selesai melayani pelanggan.',
            C: 'C. Menolaknya dengan tegas karena urusan pekerjaan lebih penting.',
            D: 'D. Membagi konsentrasi untuk melayani pelanggan sambil membantunya.',
            E: 'E. Menyarankannya meminta bantuan kepada rekan kerja yang lain.'
        },
        points: { A: 1, B: 5, C: 4, D: 2, E: 3 }
    },
    {
        id: 13,
        category: 'TKP',
        categoryFull: 'Tes Karakteristik Pribadi (TKP)',
        question: 'Organisasi Anda mengalami perubahan sistem manajemen digital baru yang belum Anda kuasai. Tindakan Anda...',
        options: {
            A: 'A. Meminta dipindahkan ke divisi lain yang masih memakai sistem lama.',
            B: 'B. Menerima dengan pasrah dan bekerja dengan lambat.',
            C: 'C. Berusaha mempelajari sistem baru secara mandiri dan mengikuti pelatihan khusus.',
            D: 'D. Menunggu rekan kerja lain menguasainya terlebih dahulu baru ikut belajar.',
            E: 'E. Mengajukan keluhan kepada manajemen karena sistem baru menyulitkan staf.'
        },
        points: { A: 1, B: 2, C: 5, D: 3, E: 4 }
    },
    {
        id: 14,
        category: 'TKP',
        categoryFull: 'Tes Karakteristik Pribadi (TKP)',
        question: 'Anda melihat seorang rekan kerja melakukan kesalahan input data keuangan instansi. Sikap Anda...',
        options: {
            A: 'A. Membiarkannya karena itu bukan tanggung jawab divisi Anda.',
            B: 'B. Menegurnya di depan rekan kerja lain agar dia tidak mengulanginya.',
            C: 'C. Memberitahunya secara pribadi dan membantunya mengoreksi kesalahan tersebut.',
            D: 'D. Melaporkannya langsung kepada atasan agar dia mendapat sanksi.',
            E: 'E. Mendiskusikannya dengan rekan kerja lain sebelum mengambil tindakan.'
        },
        points: { A: 1, B: 2, C: 5, D: 3, E: 4 }
    },
    {
        id: 15,
        category: 'TKP',
        categoryFull: 'Tes Karakteristik Pribadi (TKP)',
        question: 'Anda ditunjuk menjadi ketua tim dalam proyek dengan anggota yang berasal dari latar belakang suku yang berbeda-beda. Sikap Anda...',
        options: {
            A: 'A. Membagi tugas berdasarkan kedekatan personal.',
            B: 'B. Menghargai perbedaan dan membagi tugas secara adil berdasarkan kompetensi.',
            C: 'C. Meminta atasan mengganti anggota agar lebih homogen.',
            D: 'D. Menyerahkan keputusan pembagian tugas kepada kesepakatan anggota.',
            E: 'E. Membatasi interaksi di luar urusan pekerjaan agar tidak konflik.'
        },
        points: { A: 1, B: 5, C: 2, D: 4, E: 3 }
    }
];

// STATE VARIABLES
let selectedTryout = {
    id: null,
    title: '',
    totalQuestions: 15,
    duration: 15
};
let activeQuestions = [];
let currentQuestionIndex = 0;
let savedAnswers = {}; // { questionId: 'A' }
let raguStatus = {}; // { questionId: true/false }
let timerInterval = null;
let timeRemaining = 15 * 60; // in seconds

// DYNAMIC QUESTION GENERATOR
function generateExamQuestions(totalSoal) {
    let list = [];
    
    // Categorize questions split:
    // TWK ~33%, TIU ~33%, TKP ~34%
    let numTwk = Math.ceil(totalSoal * 0.33);
    let numTiu = Math.ceil(totalSoal * 0.33);
    
    for (let i = 0; i < totalSoal; i++) {
        let category = 'TKP';
        let categoryFull = 'Tes Karakteristik Pribadi (TKP)';
        
        if (i < numTwk) {
            category = 'TWK';
            categoryFull = 'Tes Wawasan Kebangsaan (TWK)';
        } else if (i < numTwk + numTiu) {
            category = 'TIU';
            categoryFull = 'Tes Inteligensia Umum (TIU)';
        }

        // Get matching base question from questionsData based on index and category to maintain consistency
        let filteredBase = questionsData.filter(q => q.category === category);
        let baseQ = filteredBase[i % filteredBase.length];
        
        let newQ = JSON.parse(JSON.stringify(baseQ));
        newQ.id = i + 1;
        newQ.category = category;
        newQ.categoryFull = categoryFull;
        
        list.push(newQ);
    }
    return list;
}

// NAVIGATION
function goToState(stateName) {
    document.querySelectorAll('.state-section').forEach(el => el.classList.add('d-none'));
    document.getElementById(`state-${stateName}`).classList.remove('d-none');
    window.scrollTo(0, 0);
}

function goToInstructions(id, title, totalQuestions, duration) {
    selectedTryout.id = id;
    selectedTryout.title = title;
    selectedTryout.totalQuestions = parseInt(totalQuestions);
    selectedTryout.duration = parseInt(duration);

    document.getElementById('instruction-title').textContent = title;
    document.getElementById('instruction-soal').textContent = `${totalQuestions} Soal`;
    document.getElementById('instruction-durasi').textContent = `${duration} Menit`;
    
    goToState('instructions');
}

function startExam() {
    // Reset Ujian
    currentQuestionIndex = 0;
    savedAnswers = {};
    raguStatus = {};
    timeRemaining = selectedTryout.duration * 60;

    // Set package title
    document.getElementById('exam-package-title').textContent = selectedTryout.title;

    // Generate dynamic questions list based on totalQuestions count
    activeQuestions = generateExamQuestions(selectedTryout.totalQuestions);

    // Render Ujian
    renderQuestion(0);
    renderNavigationGrid();
    goToState('exam');

    // Timer
    startTimer();
}

function startTimer() {
    clearInterval(timerInterval);
    updateTimerDisplay();

    timerInterval = setInterval(() => {
        timeRemaining--;
        updateTimerDisplay();

        if (timeRemaining <= 0) {
            clearInterval(timerInterval);
            alert('Waktu Ujian telah berakhir! Lembar jawaban Anda akan otomatis dikirim.');
            submitExam();
        }
    }, 1000);
}

function updateTimerDisplay() {
    const minutes = Math.floor(timeRemaining / 60);
    const seconds = timeRemaining % 60;
    const formattedSec = seconds < 10 ? '0' + seconds : seconds;
    const formattedMin = minutes < 10 ? '0' + minutes : minutes;
    
    const timerEl = document.getElementById('exam-timer');
    timerEl.textContent = `${formattedMin}:${formattedSec}`;

    if (timeRemaining < 120) { // < 2 Menit
        timerEl.parentElement.classList.remove('bg-danger', 'bg-opacity-10', 'text-danger');
        timerEl.parentElement.classList.add('bg-danger', 'text-white');
    } else {
        timerEl.parentElement.classList.remove('bg-danger', 'text-white');
        timerEl.parentElement.classList.add('bg-danger', 'bg-opacity-10', 'text-danger');
    }
}

// RENDERING
function renderQuestion(index) {
    currentQuestionIndex = index;
    const q = activeQuestions[index];

    // Info header
    document.getElementById('current-question-number-title').textContent = `Soal No. ${index + 1} dari ${activeQuestions.length}`;
    document.getElementById('question-category-badge').textContent = `Kategori: ${q.category}`;
    document.getElementById('question-text-box').textContent = `${index + 1}. ${q.question}`;

    // Render Options
    const options = ['A', 'B', 'C', 'D', 'E'];
    options.forEach(opt => {
        const optionCard = document.querySelector(`#options-container .option-row:nth-child(${options.indexOf(opt) + 1})`);
        const inputRadio = optionCard.querySelector('input');
        const labelText = optionCard.querySelector('label');

        labelText.textContent = q.options[opt];
        inputRadio.value = opt;

        // Check if answered
        if (savedAnswers[q.id] === opt) {
            inputRadio.checked = true;
            optionCard.classList.add('border-primary', 'bg-primary', 'bg-opacity-10');
        } else {
            inputRadio.checked = false;
            optionCard.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10');
        }
    });

    // Ragu Ragu Checkbox
    const isRagu = raguStatus[q.id] || false;
    document.getElementById('check-ragu').checked = isRagu;

    // Previous Button state
    document.getElementById('btn-prev-question').disabled = index === 0;

    // Next Button Text (Last question is "Selesai")
    const nextBtn = document.getElementById('btn-next-question');
    if (index === activeQuestions.length - 1) {
        nextBtn.innerHTML = `Selesai <i class="bi bi-check-circle-fill ms-1"></i>`;
        nextBtn.classList.remove('btn-primary');
        nextBtn.classList.add('btn-success');
    } else {
        nextBtn.innerHTML = `Selanjutnya <i class="bi bi-chevron-right ms-1"></i>`;
        nextBtn.classList.add('btn-primary');
        nextBtn.classList.remove('btn-success');
    }

    // Highlight selected navigation button
    document.querySelectorAll('.nav-grid-btn').forEach(btn => {
        btn.classList.remove('border-dark', 'border-2');
        if (parseInt(btn.dataset.index) === index) {
            btn.classList.add('border-dark', 'border-2');
        }
    });
}

function renderNavigationGrid() {
    const container = document.getElementById('navigation-grid-container');
    container.innerHTML = '';

    activeQuestions.forEach((q, index) => {
        const div = document.createElement('div');
        div.className = 'col-3 col-md-2.4 col-lg-2.4 text-center';

        const btn = document.createElement('button');
        btn.className = 'btn w-100 py-2 nav-grid-btn border fw-bold';
        btn.dataset.index = index;
        btn.textContent = index + 1;
        btn.style.borderRadius = '8px';

        updateNavButtonColor(btn, q.id);

        btn.onclick = () => {
            renderQuestion(index);
        };

        div.appendChild(btn);
        container.appendChild(div);
    });
}

function updateNavButtonColor(btn, questionId) {
    const isAnswered = savedAnswers[questionId] !== undefined;
    const isRagu = raguStatus[questionId] === true;

    btn.className = 'btn w-100 py-2 nav-grid-btn border fw-bold';

    if (isRagu) {
        btn.classList.add('bg-warning', 'text-dark-emphasis', 'border-warning');
    } else if (isAnswered) {
        btn.classList.add('bg-success', 'text-white', 'border-success');
    } else {
        btn.classList.add('bg-light', 'text-secondary', 'border-secondary', 'border-opacity-30');
    }
}

// LOGIC CONTROLS
function selectOption(opt) {
    const q = activeQuestions[currentQuestionIndex];
    savedAnswers[q.id] = opt;

    // Highlight option
    const options = ['A', 'B', 'C', 'D', 'E'];
    options.forEach(o => {
        const optionCard = document.querySelector(`#options-container .option-row:nth-child(${options.indexOf(o) + 1})`);
        const inputRadio = optionCard.querySelector('input');
        if (o === opt) {
            inputRadio.checked = true;
            optionCard.classList.add('border-primary', 'bg-primary', 'bg-opacity-10');
        } else {
            inputRadio.checked = false;
            optionCard.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10');
        }
    });

    // Update Nav Grid
    const navBtn = document.querySelector(`.nav-grid-btn[data-index="${currentQuestionIndex}"]`);
    updateNavButtonColor(navBtn, q.id);
}

function toggleRaguRagu(checkbox) {
    const q = activeQuestions[currentQuestionIndex];
    raguStatus[q.id] = checkbox.checked;

    // Update Nav Grid
    const navBtn = document.querySelector(`.nav-grid-btn[data-index="${currentQuestionIndex}"]`);
    updateNavButtonColor(navBtn, q.id);
}

function nextQuestion() {
    if (currentQuestionIndex === activeQuestions.length - 1) {
        triggerSelesaiUjian();
    } else {
        renderQuestion(currentQuestionIndex + 1);
    }
}

function prevQuestion() {
    if (currentQuestionIndex > 0) {
        renderQuestion(currentQuestionIndex - 1);
    }
}

function triggerSelesaiUjian() {
    const answeredCount = Object.keys(savedAnswers).length;
    const totalCount = activeQuestions.length;

    const modalStatusText = document.getElementById('confirm-modal-status-text');
    modalStatusText.textContent = `Anda telah menjawab ${answeredCount} dari ${totalCount} soal.`;

    const warningBox = document.getElementById('unanswered-warning-box');
    if (answeredCount < totalCount) {
        warningBox.classList.remove('d-none');
    } else {
        warningBox.classList.add('d-none');
    }

    const modal = new bootstrap.Modal(document.getElementById('confirmSelesaiModal'));
    modal.show();
}

function submitExam() {
    // Hide confirmation modal if open
    const modalEl = document.getElementById('confirmSelesaiModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();

    clearInterval(timerInterval);

    // Calculate Scores
    let twkScore = 0;
    let tiuScore = 0;
    let tkpScore = 0;

    activeQuestions.forEach(q => {
        const userAnswer = savedAnswers[q.id];
        
        if (q.category === 'TWK') {
            if (userAnswer === q.correct) twkScore += 5;
        } else if (q.category === 'TIU') {
            if (userAnswer === q.correct) tiuScore += 5;
        } else if (q.category === 'TKP') {
            if (userAnswer) {
                const points = q.points[userAnswer] || 0;
                tkpScore += points;
            }
        }
    });

    const totalScore = twkScore + tiuScore + tkpScore;

    // Passing Grades (Scaled dynamically)
    let numTwk = activeQuestions.filter(q => q.category === 'TWK').length;
    let numTiu = activeQuestions.filter(q => q.category === 'TIU').length;
    let numTkp = activeQuestions.filter(q => q.category === 'TKP').length;

    const twkPass = Math.ceil(numTwk * 5 * 0.6); // 60%
    const tiuPass = Math.ceil(numTiu * 5 * 0.6); // 60%
    const tkpPass = Math.ceil(numTkp * 3.6); // 3.6 average per question

    const isLulus = twkScore >= twkPass && tiuScore >= tiuPass && tkpScore >= tkpPass;

    // Populate Results View
    document.getElementById('res-score-twk').textContent = twkScore;
    document.getElementById('res-score-tiu').textContent = tiuScore;
    document.getElementById('res-score-tkp').textContent = tkpScore;
    document.getElementById('res-score-total').textContent = totalScore;

    // Max potential score representation
    const maxScore = (numTwk * 5) + (numTiu * 5) + (numTkp * 5);
    document.getElementById('res-score-total').nextElementSibling.textContent = `Maks. ${maxScore}`;
    document.getElementById('res-score-twk').nextElementSibling.textContent = `Min. ${twkPass}`;
    document.getElementById('res-score-tiu').nextElementSibling.textContent = `Min. ${tiuPass}`;
    document.getElementById('res-score-tkp').nextElementSibling.textContent = `Min. ${tkpPass}`;

    const statusBadge = document.getElementById('result-status-badge');
    const progressBar = document.getElementById('res-progress-bar');
    const headerBg = document.getElementById('result-header-bg');
    const descriptionText = document.getElementById('result-description-text');

    if (isLulus) {
        statusBadge.textContent = 'LULUS PASSING GRADE';
        statusBadge.className = 'fs-5 px-4 py-2 fw-extrabold rounded-pill shadow bg-success text-white';
        progressBar.className = 'progress-bar bg-success';
        progressBar.style.width = '100%';
        headerBg.style.background = 'linear-gradient(135deg, #065f46 0%, #047857 100%)';
        descriptionText.innerHTML = `<strong>Selamat!</strong> Hasil pengerjaan Anda telah memenuhi atau melebihi batas kelulusan akademik (*passing grade*) yang ditentukan untuk materi TWK, TIU, dan TKP. Pertahankan performa luar biasa ini!`;
    } else {
        statusBadge.textContent = 'TIDAK LULUS PASSING GRADE';
        statusBadge.className = 'fs-5 px-4 py-2 fw-extrabold rounded-pill shadow bg-danger text-white';
        progressBar.className = 'progress-bar bg-danger';
        progressBar.style.width = '60%';
        headerBg.style.background = 'linear-gradient(135deg, #7f1d1d 0%, #991b1b 100%)';
        
        let alasan = [];
        if (twkScore < twkPass) alasan.push(`TWK (Min. ${twkPass})`);
        if (tiuScore < tiuPass) alasan.push(`TIU (Min. ${tiuPass})`);
        if (tkpScore < tkpPass) alasan.push(`TKP (Min. ${tkpPass})`);
        
        descriptionText.innerHTML = `<strong>Mohon maaf, Anda belum memenuhi passing grade.</strong> Anda masih di bawah ambang batas pada kategori: <strong>${alasan.join(', ')}</strong>. Tingkatkan latihan soal Anda di kategori tersebut untuk menembus ujian yang sesungguhnya.`;
    }

    // Simpan hasil ke database secara asynchronous
    axios.post(`/tryout/${selectedTryout.id}/submit`, {
        score_twk: twkScore,
        score_tiu: tiuScore,
        score_tkp: tkpScore,
        score_total: totalScore,
        status: isLulus ? 'lulus' : 'tidak_lulus'
    })
    .then(res => {
        console.log('Nilai berhasil disimpan ke database:', res.data);
    })
    .catch(err => {
        console.error('Gagal menyimpan nilai ke database:', err);
    });

    goToState('results');
}
</script>

<style>
    .option-card:hover {
        border-color: #071739 !important;
        background-color: rgba(7, 23, 57, 0.03);
    }
    
    .nav-grid-btn:hover {
        border-color: #071739 !important;
    }
    
    @media (min-width: 992px) {
        .col-lg-2.4 {
            width: 20%;
        }
    }
</style>

@endsection
