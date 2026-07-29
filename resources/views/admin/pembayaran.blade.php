@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')
@section('page-title', 'Verifikasi Pembayaran')

@section('content')
<div class="container-fluid px-0">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <h5 class="fw-bold mb-1" style="color:#071739;">Verifikasi Pembayaran</h5>
            <p class="text-muted mb-0" style="font-size:13px;">
                Tinjau bukti transfer dan aktifkan akun siswa
            </p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert border-0 mb-4 d-flex align-items-center gap-2"
             style="background:#d1fae5;color:#065f46;border-radius:12px;padding:14px 18px;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert border-0 mb-4 d-flex align-items-center gap-2"
             style="background:#fee2e2;color:#991b1b;border-radius:12px;padding:14px 18px;">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
        </div>
    @endif

    {{-- ===== FILTER TABS ===== --}}
    <div class="d-flex mb-3 gap-2 flex-wrap">
        <a href="/admin/pembayaran?status=pending" 
           class="btn btn-sm px-3 py-2 fw-semibold"
           style="border-radius:10px; font-size:13px; {{ $status === 'pending' ? 'background:#071739; color:white; border:none;' : 'background:white; color:#64748b; border:1px solid #e2e8f0;' }}">
            Menunggu Verifikasi
            @php $pendingCount = \App\Models\Payment::where('status', 'pending')->count(); @endphp
            @if($pendingCount > 0)
                <span class="badge ms-1" style="background:#f5b93b; color:#071739;">{{ $pendingCount }}</span>
            @endif
        </a>
        <a href="/admin/pembayaran?status=lunas" 
           class="btn btn-sm px-3 py-2 fw-semibold"
           style="border-radius:10px; font-size:13px; {{ $status === 'lunas' ? 'background:#071739; color:white; border:none;' : 'background:white; color:#64748b; border:1px solid #e2e8f0;' }}">
            Lunas
        </a>
        <a href="/admin/pembayaran?status=ditolak" 
           class="btn btn-sm px-3 py-2 fw-semibold"
           style="border-radius:10px; font-size:13px; {{ $status === 'ditolak' ? 'background:#071739; color:white; border:none;' : 'background:white; color:#64748b; border:1px solid #e2e8f0;' }}">
            Ditolak
        </a>
        <a href="/admin/pembayaran?status=all" 
           class="btn btn-sm px-3 py-2 fw-semibold"
           style="border-radius:10px; font-size:13px; {{ $status === 'all' ? 'background:#071739; color:white; border:none;' : 'background:white; color:#64748b; border:1px solid #e2e8f0;' }}">
            Semua
        </a>
    </div>

    {{-- Content Card --}}
    <div class="content-card">
        <div class="content-card-header">
            <div class="content-card-title">
                <i class="bi bi-credit-card-2-front-fill"></i>
                Antrean Pembayaran (Status: {{ ucfirst($status === 'all' ? 'Semua' : ($status === 'pending' ? 'Menunggu Verifikasi' : $status)) }})
            </div>
        </div>
        <div class="content-card-body">
            @if($payments->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-credit-card" style="font-size:48px;opacity:.2;"></i>
                    <p class="mt-3 mb-1 fw-semibold">Tidak ada data pembayaran</p>
                    <p class="mb-0 text-muted" style="font-size:13px;">Semua data pembayaran berstatus ini telah diproses.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table admin-table align-middle">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 25%">Siswa</th>
                                <th style="width: 20%">Paket & Nominal</th>
                                <th style="width: 20%">Pengirim & Bank</th>
                                <th style="width: 15%">Status</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $idx => $payment)
                                <tr>
                                    <td style="color:#94a3b8;font-size:13px;">{{ $idx + 1 }}</td>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar-sm">
                                                {{ strtoupper(substr(optional($payment->user)->name ?? '?', 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="user-name">{{ optional($payment->user)->name ?? '-' }}</div>
                                                <div class="user-email">{{ optional($payment->user)->email ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="color:#071739; font-size:14px;">
                                            {{ ucfirst(optional($payment->user)->package ?? '-') }}
                                        </div>
                                        <span class="text-muted fw-semibold" style="font-size:13px;">
                                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="font-size:13px; font-weight:600; color:#071739;">
                                            {{ $payment->sender_name ?? '-' }}
                                        </div>
                                        <small class="text-muted" style="font-size:11px;">
                                            {{ strtoupper($payment->bank ?? '-') }} — {{ $payment->account_number ?? '-' }}
                                        </small>
                                    </td>
                                    <td>
                                        @if($payment->status === 'pending')
                                            <span class="status-badge pending">
                                                <i class="bi bi-clock"></i> Pending
                                            </span>
                                        @elseif($payment->status === 'lunas')
                                            <span class="status-badge lunas">
                                                <i class="bi bi-check-circle"></i> Lunas
                                            </span>
                                        @else
                                            <span class="status-badge ditolak">
                                                <i class="bi bi-x-circle"></i> Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            @if($payment->proof_path)
                                                <button type="button" 
                                                        class="btn btn-sm btn-primary fw-semibold"
                                                        style="border-radius:8px; padding:6px 12px; font-size:12px; background:#071739; border:none;"
                                                        onclick="showProofModal({
                                                            name: '{{ addslashes(optional($payment->user)->name ?? '-') }}',
                                                            email: '{{ addslashes(optional($payment->user)->email ?? '-') }}',
                                                            amount: 'Rp {{ number_format($payment->amount, 0, ',', '.') }}',
                                                            bank: '{{ addslashes(strtoupper($payment->bank ?? '-')) }}',
                                                            sender: '{{ addslashes($payment->sender_name ?? '-') }}',
                                                            accNumber: '{{ addslashes($payment->account_number ?? '-') }}',
                                                            date: '{{ $payment->transfer_date ? \Carbon\Carbon::parse($payment->transfer_date)->format('d F Y') : '-' }}',
                                                            time: '{{ $payment->transfer_time ?? '-' }}',
                                                            note: '{{ addslashes($payment->note ?? '-') }}',
                                                            image: '{{ asset('storage/' . $payment->proof_path) }}'
                                                        })">
                                                    <i class="bi bi-eye-fill me-1"></i>Bukti
                                                </button>
                                            @endif

                                            @if($payment->status === 'pending')
                                                <form action="/admin/pembayaran/{{ $payment->id_pembayaran }}/verify" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" name="action" value="accept" 
                                                            class="btn btn-sm btn-success fw-semibold"
                                                            style="border-radius:8px; padding:6px 12px; font-size:12px;"
                                                            data-confirm="Siswa akan diaktifkan setelah pembayaran ini diterima."
                                                            data-confirm-title="Terima Pembayaran?"
                                                            data-confirm-button="Ya, Terima"
                                                            data-confirm-color="#198754"
                                                            data-confirm-type="question">
                                                        Terima
                                                    </button>
                                                </form>

                                                <form action="/admin/pembayaran/{{ $payment->id_pembayaran }}/verify" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" name="action" value="reject" 
                                                            class="btn btn-sm btn-danger fw-semibold"
                                                            style="border-radius:8px; padding:6px 12px; font-size:12px;"
                                                            data-confirm="Siswa harus mengunggah ulang bukti transfer jika pembayaran ditolak."
                                                            data-confirm-title="Tolak Pembayaran?"
                                                            data-confirm-button="Ya, Tolak"
                                                            data-confirm-color="#dc3545"
                                                            data-confirm-type="warning">
                                                        Tolak
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- ===== MODAL PREVIEW BUKTI PEMBAYARAN ===== --}}
<div class="modal fade" id="modalBuktiPembayaran" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius:16px; border:none; overflow:hidden;">
            <div class="modal-header border-0 text-white p-4" style="background:#071739;">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-file-earmark-image me-2 text-warning"></i>Detail & Bukti Pembayaran
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    {{-- Detail Form --}}
                    <div class="col-12 col-md-5">
                        <h6 class="fw-bold mb-3 border-bottom pb-2" style="color:#071739;">Data Siswa & Transfer</h6>
                        <table class="table table-borderless table-sm" style="font-size:13px;">
                            <tr>
                                <td class="text-muted p-1" style="width:40%;">Siswa</td>
                                <td class="fw-bold p-1" style="color:#071739;" id="modal_siswa_name"></td>
                            </tr>
                            <tr>
                                <td class="text-muted p-1">Email</td>
                                <td class="fw-semibold p-1" id="modal_siswa_email"></td>
                            </tr>
                            <tr>
                                <td class="text-muted p-1">Jumlah Transfer</td>
                                <td class="fw-bold p-1 text-success" style="font-size:14px;" id="modal_amount"></td>
                            </tr>
                            <tr>
                                <td class="text-muted p-1">Bank</td>
                                <td class="fw-bold p-1" id="modal_bank"></td>
                            </tr>
                            <tr>
                                <td class="text-muted p-1">Pengirim</td>
                                <td class="fw-semibold p-1" id="modal_sender"></td>
                            </tr>
                            <tr>
                                <td class="text-muted p-1">No. Rekening</td>
                                <td class="p-1" id="modal_acc_number"></td>
                            </tr>
                            <tr>
                                <td class="text-muted p-1">Tanggal</td>
                                <td class="p-1" id="modal_date"></td>
                            </tr>
                            <tr>
                                <td class="text-muted p-1">Waktu</td>
                                <td class="p-1" id="modal_time"></td>
                            </tr>
                            <tr>
                                <td class="text-muted p-1">Catatan</td>
                                <td class="p-1 text-secondary" id="modal_note"></td>
                            </tr>
                        </table>
                    </div>
                    
                    {{-- Proof Image --}}
                    <div class="col-12 col-md-7 text-center">
                        <h6 class="fw-bold mb-3 text-start border-bottom pb-2" style="color:#071739;">Foto Bukti Transfer</h6>
                        <div class="p-2 border rounded bg-light d-flex align-items-center justify-content-center" style="min-height:300px;">
                            <img id="modal_proof_img" src="" alt="Bukti Transfer" class="img-fluid" style="max-height:350px; object-fit:contain; border-radius:8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        </div>
                        <a id="modal_download_link" href="" target="_blank" class="btn btn-sm btn-outline-secondary mt-3 fw-semibold">
                            <i class="bi bi-box-arrow-up-right me-1"></i>Buka Gambar Asli
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light p-3">
                <button type="button" class="btn fw-semibold px-4" data-bs-dismiss="modal"
                        style="border-radius:10px; border:1px solid #e2e8f0; background:white; color:#64748b; font-size:14px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function showProofModal(data) {
    document.getElementById('modal_siswa_name').textContent = data.name;
    document.getElementById('modal_siswa_email').textContent = data.email;
    document.getElementById('modal_amount').textContent = data.amount;
    document.getElementById('modal_bank').textContent = data.bank;
    document.getElementById('modal_sender').textContent = data.sender;
    document.getElementById('modal_acc_number').textContent = data.accNumber;
    document.getElementById('modal_date').textContent = data.date;
    document.getElementById('modal_time').textContent = data.time + ' WIB';
    document.getElementById('modal_note').textContent = data.note ? data.note : '-';
    
    // Tampilkan gambar bukti transfer dan tautan unduhan
    const imgEl = document.getElementById('modal_proof_img');
    imgEl.src = data.image;
    
    const linkEl = document.getElementById('modal_download_link');
    linkEl.href = data.image;

    // Tampilkan modal bukti pembayaran
    new bootstrap.Modal(document.getElementById('modalBuktiPembayaran')).show();
}
</script>
@endsection