@extends('layouts.app')
@section('title', 'Pembayaran - Pilar Abdi')

@section('styles')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@endsection

@section('content')

<div class="container py-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white py-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="mb-0">Pembayaran Pendaftaran</h3>
                            <p class="mb-0 text-white-75">Lengkapi bukti transfer agar admin dapat memverifikasi akun Anda.</p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <span class="badge bg-warning text-dark fs-6">Akun: {{ optional($user)->status ? strtoupper($user->status) : 'TIDAK TERDAFTAR' }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
                            <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        Terjadi kesalahan saat mengirim bukti pembayaran. Periksa kembali data dan coba lagi.
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('success') }}<br>
                            Silakan tunggu verifikasi admin. Setelah akun Anda aktif, login menggunakan email dan password yang dibuat saat pendaftaran.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
                            <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        Bukti pembayaran berhasil dikirim. Tunggu konfirmasi admin.
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @endif

                   @if(optional($user)->id_user)

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Informasi Siswa</h5>
                                        <div class="mb-2"><strong>Nama Siswa:</strong> {{ $user->name }}</div>
                                        <div class="mb-2"><strong>Email:</strong> {{ $user->email }}</div>
                                        <div class="mb-2"><strong>Program yang dipilih:</strong> {{ ucfirst($user->package ?? 'Belum dipilih') }}</div>
                                        <div class="mb-2"><strong>Sekolah Tujuan:</strong> {{ strtoupper($user->sekdin ?? 'Belum dipilih') }}</div>
                                        <div class="mb-2"><strong>Total Pembayaran:</strong> 
                                            @if($user->package === 'reguler')
                                                Rp 890.000
                                            @elseif($user->package === 'intensif')
                                                Rp 1.650.000
                                            @elseif($user->package === 'tahunan')
                                                Rp 2.750.000
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Rekening Tujuan</h5>
                                        <div class="mb-2"><strong>Bank Tujuan:</strong> BCA</div>
                                        <div class="mb-2"><strong>Nomor Rekening:</strong> 1234 5678 9012</div>
                                        <div class="mb-2"><strong>Atas Nama:</strong> Pilar Abdi</div>
                                        <div class="text-muted small">Pastikan nominal transfer sesuai jumlah pembayaran.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($payment && $payment->status === 'pending')
                            <div class="alert alert-info">
                                Bukti transfer Anda sedang dalam proses verifikasi admin. Mohon tunggu hingga status berubah.
                            </div>
                        @elseif($payment && $payment->status === 'ditolak')
                            <div class="alert alert-danger">
                                Bukti transfer sebelumnya ditolak. Silakan unggah ulang bukti pembayaran.
                            </div>
                        @elseif($payment && $payment->status === 'lunas')
                            <div class="alert alert-success">
                                Pembayaran sudah diverifikasi. Akun Anda aktif dan dapat mengakses Dashboard Siswa.
                            </div>
                        @endif

                        @if(!$payment || $payment->status === 'ditolak')
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4">Form Bukti Transfer</h5>

                                            <form method="POST" action="/pembayaran/upload" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id_user" value="{{ $user->id_user }}">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Bank Pengirim <span class="text-danger">*</span></label>
                                                        <select name="bank" class="form-select" required>
                                                            <option value="">Pilih Bank Pengirim</option>
                                                            @foreach(['BCA','BRI','BNI','Mandiri','CIMB','BTN','Lainnya'] as $bank)
                                                                <option value="{{ $bank }}" {{ old('bank') === $bank ? 'selected' : '' }}>{{ $bank }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Nama Pemilik Rekening Pengirim <span class="text-danger">*</span></label>
                                                        <input type="text" name="account_name" class="form-control" placeholder="Nama pemilik rekening" value="{{ old('account_name') }}" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Nomor Rekening Pengirim <span class="text-danger">*</span></label>
                                                        <input type="text" name="account_number" class="form-control" placeholder="Nomor rekening pengirim" value="{{ old('account_number') }}" required>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="form-label">Tanggal Transfer <span class="text-danger">*</span></label>
                                                        <input type="date" name="transfer_date" class="form-control" value="{{ old('transfer_date') }}" required>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="form-label">Jam Transfer <span class="text-danger">*</span></label>
                                                        <input type="time" name="transfer_time" class="form-control" value="{{ old('transfer_time') }}" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Nominal Transfer <span class="text-danger">*</span></label>
                                                        <input type="number" name="amount" class="form-control" placeholder="Jumlah transfer" value="{{ old('amount') }}" min="1000" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Upload Bukti Transfer <span class="text-danger">*</span></label>
                                                        <input type="file" name="proof" class="form-control" accept="image/png,image/jpeg,image/jpg,application/pdf" required>
                                                        <div class="form-text">Format: JPG, PNG, JPEG, PDF. Maksimal 5 MB.</div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label">Catatan (Opsional)</label>
                                                        <textarea name="note" class="form-control" rows="3" placeholder="Contoh: transfer atas nama orang tua, kode 1234">{{ old('note') }}</textarea>
                                                    </div>

                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary px-5 py-3">
                                                            Kirim Bukti Pembayaran
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @else
                        <div class="alert alert-info">
                            Silakan daftar terlebih dahulu untuk mengakses halaman pembayaran.
                        </div>
                        <a href="/pendaftaran" class="btn btn-warning">Daftar Sekarang</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('successToast');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
        var errorToastEl = document.getElementById('errorToast');
        if (errorToastEl) {
            var errToast = new bootstrap.Toast(errorToastEl);
            errToast.show();
        }
    });
</script>
@endsection
