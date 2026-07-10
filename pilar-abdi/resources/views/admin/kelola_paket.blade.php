@extends('layouts.admin')

@section('title', 'Kelola Paket Tryout')
@section('page-title', 'Kelola Paket Tryout')

@section('content')
<div class="container-fluid">
    {{-- ===== BREADCRUMB & BACK BUTTON ===== --}}
    <div class="mb-4">
        <a href="/admin/tryout" class="btn btn-outline-secondary btn-sm" style="border-radius: 8px;">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Tryout
        </a>
    </div>

    {{-- ===== NOTIFIKASI ===== --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius:12px;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius:12px;">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- ===== CARD INFORMASI TRYOUT (BAGIAN ATAS) ===== --}}
    <div class="card shadow-sm border-0 mb-4 rounded-4" style="background: linear-gradient(135deg, #071739 0%, #1e293b 100%); color: white;">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <span class="badge bg-warning text-dark mb-2 px-3 py-2 fw-bold" style="border-radius: 20px;">Detail Paket Aktif</span>
                    <h3 class="fw-bold mb-1">{{ $tryout->nama_tryout }}</h3>
                    <p class="mb-0 text-white-50 small">{{ $tryout->deskripsi ?? '— Tidak ada deskripsi' }}</p>
                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <div class="row g-2 text-center">
                        <div class="col-6">
                            <div class="bg-white bg-opacity-10 p-2 rounded-3 border border-white border-opacity-10">
                                <span class="d-block small text-white-50" style="font-size: 11px;">Durasi Ujian</span>
                                <h5 class="fw-bold mb-0 text-warning">{{ $tryout->durasi }} Min</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white bg-opacity-10 p-2 rounded-3 border border-white border-opacity-10">
                                <span class="d-block small text-white-50" style="font-size: 11px;">Target Soal</span>
                                <h5 class="fw-bold mb-0 text-warning">{{ $tryout->jumlah_soal }} Soal</h5>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-white bg-opacity-10 p-2 rounded-3 border border-white border-opacity-10">
                                <span class="d-block small text-white-50" style="font-size: 10px;">Masa Berlaku</span>
                                <span class="fw-semibold text-white" style="font-size: 11px;">
                                    {{ \Carbon\Carbon::parse($tryout->tanggal_mulai)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($tryout->tanggal_berakhir)->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== FORM SYNC SOAL ===== --}}
    <form action="/admin/tryout/{{ $tryout->id_tryout }}/soal/sync" method="POST">
        @csrf
        
        {{-- ===== NAV-TABS BANK SOAL (BAGIAN BAWAH) ===== --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-bottom p-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <h5 class="fw-bold text-dark mb-1"><i class="bi bi-collection-play-fill text-primary me-2"></i>Bank Soal Penyusun</h5>
                        <p class="text-muted mb-0 small">Pilih dan centang soal-soal di bawah ini berdasarkan tab materi untuk dimasukkan ke dalam paket tryout.</p>
                    </div>
                    <div class="bg-light px-3 py-2 rounded-3 text-secondary small fw-bold">
                        Total Terpilih: <span id="checked-counter" class="text-primary">0</span> / {{ $tryout->jumlah_soal }} Soal
                    </div>
                </div>

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs card-header-tabs mt-4 border-0" id="bankSoalTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold text-uppercase px-4 py-2 border-0 position-relative" 
                                id="twk-tab" data-bs-toggle="tab" data-bs-target="#twk-content" type="button" role="tab"
                                style="border-radius: 8px 8px 0 0;">
                            Tes Wawasan Kebangsaan (TWK)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold text-uppercase px-4 py-2 border-0" 
                                id="tiu-tab" data-bs-toggle="tab" data-bs-target="#tiu-content" type="button" role="tab"
                                style="border-radius: 8px 8px 0 0;">
                            Tes Inteligensia Umum (TIU)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold text-uppercase px-4 py-2 border-0" 
                                id="tkp-tab" data-bs-toggle="tab" data-bs-target="#tkp-content" type="button" role="tab"
                                style="border-radius: 8px 8px 0 0;">
                            Tes Karakteristik Pribadi (TKP)
                        </button>
                    </li>
                </ul>
            </div>
            
            <div class="card-body p-0">
                <div class="tab-content" id="bankSoalTabContent">
                    
                    {{-- TWK TAB CONTENT --}}
                    <div class="tab-pane fade show active" id="twk-content" role="tabpanel" aria-labelledby="twk-tab">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 60px;">Pilih</th>
                                        <th style="width: 80px;" class="text-center">No. Soal</th>
                                        <th>Pertanyaan</th>
                                        <th style="width: 150px;">Opsi Kunci</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($questions_twk->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">
                                                <i class="bi bi-file-earmark-x" style="font-size: 40px; opacity: 0.3;"></i>
                                                <p class="mt-2 mb-0 fw-semibold">Tidak ada bank soal TWK tersedia.</p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($questions_twk as $q)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input question-checkbox" type="checkbox" name="question_ids[]" value="{{ $q->id_tryout_question }}"
                                                               {{ in_array($q->id_tryout_question, $selected_ids) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                                                    </div>
                                                </td>
                                                <td class="text-center fw-bold text-dark">#{{ $q->nomor_soal }}</td>
                                                <td>
                                                    <div class="fw-medium text-dark" style="max-height: 48px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                        {{ strip_tags($q->pertanyaan) }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-success">Opsi {{ $q->jawaban_benar }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- TIU TAB CONTENT --}}
                    <div class="tab-pane fade" id="tiu-content" role="tabpanel" aria-labelledby="tiu-tab">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 60px;">Pilih</th>
                                        <th style="width: 80px;" class="text-center">No. Soal</th>
                                        <th>Pertanyaan</th>
                                        <th style="width: 150px;">Opsi Kunci</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($questions_tiu->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">
                                                <i class="bi bi-file-earmark-x" style="font-size: 40px; opacity: 0.3;"></i>
                                                <p class="mt-2 mb-0 fw-semibold">Tidak ada bank soal TIU tersedia.</p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($questions_tiu as $q)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input question-checkbox" type="checkbox" name="question_ids[]" value="{{ $q->id_tryout_question }}"
                                                               {{ in_array($q->id_tryout_question, $selected_ids) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                                                    </div>
                                                </td>
                                                <td class="text-center fw-bold text-dark">#{{ $q->nomor_soal }}</td>
                                                <td>
                                                    <div class="fw-medium text-dark" style="max-height: 48px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                        {{ strip_tags($q->pertanyaan) }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-success">Opsi {{ $q->jawaban_benar }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- TKP TAB CONTENT --}}
                    <div class="tab-pane fade" id="tkp-content" role="tabpanel" aria-labelledby="tkp-tab">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 60px;">Pilih</th>
                                        <th style="width: 80px;" class="text-center">No. Soal</th>
                                        <th>Pertanyaan</th>
                                        <th style="width: 150px;">Opsi Kunci</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($questions_tkp->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">
                                                <i class="bi bi-file-earmark-x" style="font-size: 40px; opacity: 0.3;"></i>
                                                <p class="mt-2 mb-0 fw-semibold">Tidak ada bank soal TKP tersedia.</p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($questions_tkp as $q)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input question-checkbox" type="checkbox" name="question_ids[]" value="{{ $q->id_tryout_question }}"
                                                               {{ in_array($q->id_tryout_question, $selected_ids) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                                                    </div>
                                                </td>
                                                <td class="text-center fw-bold text-dark">#{{ $q->nomor_soal }}</td>
                                                <td>
                                                    <div class="fw-medium text-dark" style="max-height: 48px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                        {{ strip_tags($q->pertanyaan) }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-success">Opsi {{ $q->jawaban_benar }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ===== BUTTON SIMPAN ===== --}}
        <div class="mb-5">
            <button type="submit" class="btn btn-success btn-lg w-100 fw-bold shadow" style="border-radius: 12px; padding: 14px;">
                <i class="bi bi-cloud-arrow-up-fill me-2"></i>Simpan & Rilis Paket Tryout
            </button>
        </div>
    </form>
</div>
@endsection

@section('styles')
<style>
    .nav-tabs .nav-link {
        color: #64748b;
        background: #f8fafc;
        border-bottom: 1px solid #dee2e6!important;
    }
    .nav-tabs .nav-link:hover {
        background: #f1f5f9;
        color: #0f172a;
    }
    .nav-tabs .nav-link.active {
        color: #071739!important;
        background: #ffffff!important;
        border-bottom: 3px solid #071739!important;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.question-checkbox');
        const counterSpan = document.getElementById('checked-counter');
        const limit = {{ $tryout->jumlah_soal }};

        function updateCounter() {
            const checkedCount = document.querySelectorAll('.question-checkbox:checked').length;
            counterSpan.textContent = checkedCount;

            // Warn if over limit
            if (checkedCount > limit) {
                counterSpan.className = 'text-danger fw-extrabold';
            } else if (checkedCount === limit) {
                counterSpan.className = 'text-success fw-bold';
            } else {
                counterSpan.className = 'text-primary';
            }
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateCounter);
        });

        // Initialize counter
        updateCounter();
    });
</script>
@endsection
