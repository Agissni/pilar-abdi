@extends('layouts.app')
@section('title', 'Pendaftaran - Pilar Abdi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            <div class="text-center mb-5">
                <h1 class="fw-bold" style="color: #071739; font-size: 42px;">Form Pendaftaran</h1>
                <p class="lead text-muted">Isi data diri untuk bergabung dengan Pilar Abdi</p>
            </div>

            <div class="card shadow-lg border-0" style="border-radius: 24px; overflow: hidden;">
                
                <!-- Header -->
                <div class="card-header text-white py-4 text-center" style="background: #071739;">
                    <h4 class="mb-0 fw-bold">DAFTAR SEKARANG</h4>
                </div>
                
                <div class="card-body p-5 bg-white">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-lg" placeholder="Masukkan nama lengkap">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Nomor WhatsApp</label>
                                <input type="text" class="form-control form-control-lg" placeholder="0812xxxxxxxx">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color: #071739;">Email</label>
                            <input type="email" class="form-control form-control-lg" placeholder="emailkamu@gmail.com">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Pilih Paket</label>
                                <select class="form-select form-select-lg">
                                    <option value="">-- Pilih Paket --</option>
                                    <option>Paket Reguler - Rp 1.250.000 (3 Bulan)</option>
                                    <option>Paket Intensif - Rp 2.150.000 (6 Bulan) ⭐ Rekomendasi</option>
                                    <option>Paket Tahunan - Rp 3.750.000 (12 Bulan)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Sekolah Kedinasan Tujuan</label>
                                <select class="form-select form-select-lg">
                                    <option value="">-- Pilih Sekolah --</option>
                                    <option>IPDN</option>
                                    <option>STAN</option>
                                    <option>AKPOL</option>
                                    <option>STIN</option>
                                    <option>POLTEKIM</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color: #071739;">Alamat Lengkap</label>
                            <textarea class="form-control form-control-lg" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                        </div>

                        <button type="submit" class="btn w-100 py-4 fw-bold fs-5" 
                                style="background: #f5b93b; color: #071739; border-radius: 16px;">
                            DAFTAR SEKARANG
                        </button>
                    </form>
                </div>

                <div class="card-footer text-center py-4" style="background: #f8f9fd; color: #555;">
                    Admin akan menghubungi kamu via WhatsApp dalam 1x24 jam
                </div>
            </div>
        </div>
    </div>
</div>
@endsection