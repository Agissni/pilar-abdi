@extends('layouts.app')
@section('title', 'Pembayaran Berhasil - Pilar Abdi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body text-center p-5">
                    <h2 class="text-success">✅ Bukti pembayaran berhasil dikirim.</h2>
                    <p class="lead mt-3">Kami akan memverifikasi pembayaran Anda. Silakan tunggu konfirmasi dari admin.</p>

                    <hr>

                    <h5 class="mt-4">Data Akun</h5>
                    <p><strong>Nama:</strong> {{ optional($user)->name }}</p>
                    <p><strong>Email:</strong> {{ optional($user)->email }}</p>
                    <p><strong>Program yang dipilih:</strong> {{ ucfirst(optional($user)->package ?? '-') }}</p>

                    <h5 class="mt-4">Status Akun</h5>
                    <p class="fw-bold">Pending Verifikasi Admin</p>

                    <p class="text-muted">Silakan login menggunakan email dan password yang Anda buat saat pendaftaran. Akun akan aktif setelah admin memverifikasi pembayaran.</p>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="/login" class="btn btn-primary px-4">Login Sekarang</a>
                        <a href="/" class="btn btn-outline-secondary px-4">Kembali ke Beranda</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
