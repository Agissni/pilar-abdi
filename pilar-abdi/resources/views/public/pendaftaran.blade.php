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

            <div class="card-header text-white py-4 text-center" style="background: #071739;">
                <h4 class="mb-0 fw-bold">DAFTAR SEKARANG</h4>
            </div>

            <div class="card-body p-5 bg-white">

                @php
                    $currentUser = session('user_id') ? \App\Models\User::find(session('user_id')) : null;
                @endphp

                <!-- FORM PENDAFTARAN -->
                <div id="formPendaftaran" class="{{ session('success') ? 'd-none' : '' }}">

                    <form method="POST" action="/register">
                        @csrf

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Nama Lengkap</label>
                                <input type="text" name="name" id="nama" value="{{ old('name') }}" class="form-control form-control-lg" placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Nomor WhatsApp</label>
                                <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" class="form-control form-control-lg" placeholder="0812xxxxxxxx" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color: #071739;">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="emailkamu@gmail.com" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Password</label>
                                <input type="password" name="password" class="form-control form-control-lg" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-lg" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold" style="color: #071739;">Pilih Paket</label>

                                    <select id="paket" name="package" class="form-select form-select-lg" required>
                                        <option value="">-- Pilih Paket --</option>
                                        <option value="reguler">Paket Reguler - Rp 1.250.000 (3 Bulan)</option>
                                        <option value="intensif">Paket Intensif - Rp 2.150.000 (6 Bulan) ⭐ Rekomendasi</option>
                                        <option value="tahunan">Paket Tahunan - Rp 3.750.000 (12 Bulan)</option>
                                    </select>

                                </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Sekolah Kedinasan Tujuan</label>

                                <select class="form-select form-select-lg" name="sekdin" required>
                                    <option value="">-- Pilih Sekolah --</option>
                                    <option value="stan">PKN STAN</option>
                                    <option value="ipdn">IPDN</option>
                                    <option value="stis">STIS</option>
                                    <option value="stmkg">STMKG</option>
                                    <option value="poltek-ssn">Poltek SSN</option>
                                    <option value="stin">STIN</option>
                                    <option value="poltekip">Poltekip</option>
                                    <option value="poltekim">Poltekim</option>
                                    <option value="ptdi-sttd">PTDI-STTD</option>
                                    <option value="stip-jakarta">STIP Jakarta</option>
                                    <option value="pip-semarang">PIP Semarang</option>
                                    <option value="pip-makassar">PIP Makassar</option>
                                    <option value="poltekbang">Poltekbang</option>
                                    <option value="poltektrans-sdp">Poltektrans SDP</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>

                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color: #071739;">Alamat Lengkap</label>
                            <textarea name="address" class="form-control form-control-lg" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                        </div>

                        <button type="submit"
                            class="btn w-100 py-4 fw-bold fs-5"
                            style="background: #f5b93b; color: #071739; border-radius: 16px;">
                            DAFTAR SEKARANG
                        </button>

                    </form>

                </div>

                <!-- RINGKASAN PENDAFTARAN -->
                <div id="ringkasanDaftar" class="{{ session('success') ? '' : 'd-none' }}">
                    @if($currentUser && $currentUser->status === 'pending')
                        <div class="alert alert-warning">
                            Akun Anda sedang menunggu verifikasi admin. Silakan lanjutkan pembayaran jika belum.
                        </div>
                    @elseif($currentUser && $currentUser->status === 'active')
                        <div class="alert alert-success">
                            Akun Anda sudah aktif. Silakan login untuk membuka Dashboard Siswa.
                        </div>
                    @endif

                    <div class="text-center">

                        <h2 class="fw-bold text-success mb-4">
                            ✅ Pendaftaran Berhasil
                        </h2>

                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-start" id="isiRingkasan">
                                @php
                                    $registered = session('registered_data', []);
                                    $package = $registered['package'] ?? old('package');
                                    $packageName = 'Paket';
                                    if ($package === 'reguler') {
                                        $packageName = 'Paket Reguler - Rp 1.250.000 (3 Bulan)';
                                    } elseif ($package === 'intensif') {
                                        $packageName = 'Paket Intensif - Rp 2.150.000 (6 Bulan) ⭐ Rekomendasi';
                                    } elseif ($package === 'tahunan') {
                                        $packageName = 'Paket Tahunan - Rp 3.750.000 (12 Bulan)';
                                    }
                                @endphp

                                <p><strong>Nama :</strong> {{ $registered['name'] ?? old('name') }}</p>
                                <p><strong>Email :</strong> {{ $registered['email'] ?? old('email') }}</p>
                                @if(!empty($registered['password_raw']))
                                    <p><strong>Password (satu kali tampil):</strong> {{ $registered['password_raw'] }}</p>
                                    <p class="text-muted"><small>Silakan simpan email dan password Anda. Password ini tidak akan ditampilkan lagi.</small></p>
                                @endif
                                <p><strong>Paket :</strong> {{ $packageName }}</p>
                                <p><strong>Total Pembayaran :</strong> {{ $package === 'reguler' ? 'Rp 1.250.000' : ($package === 'intensif' ? 'Rp 2.150.000' : ($package === 'tahunan' ? 'Rp 3.750.000' : '-')) }}</p>
                                <p><strong>Status :</strong> Menunggu Pembayaran</p>
                                <hr>
                                <p>Silakan lanjut ke pembayaran untuk mengaktifkan akun bimbingan.</p>
                            </div>
                        </div>

                        <a href="/pembayaran" class="btn btn-warning mt-4 px-4 py-3 fw-bold">
                           Lanjut ke Pembayaran
                        </a>

                    </div>

                </div>

            </div>

            <div class="card-footer text-center py-4" style="background: #f8f9fd; color: #555;">
                Admin akan menghubungi kamu via WhatsApp dalam 1x24 jam
            </div>

        </div>

    </div>
</div>

<script>
function daftarBerhasil(event) {
    event.preventDefault();

    let nama = document.getElementById("nama").value;
    let paket = document.getElementById("paket").value;

    let harga = "";

    if (paket.includes("Reguler")) {
        harga = "Rp 1.250.000";
    } else if (paket.includes("Intensif")) {
        harga = "Rp 2.150.000";
    } else if (paket.includes("Tahunan")) {
        harga = "Rp 3.750.000";
    }

    document.getElementById("formPendaftaran").classList.add("d-none");

    document.getElementById("ringkasanDaftar").classList.remove("d-none");

    document.getElementById("isiRingkasan").innerHTML = `
        <p><strong>Nama :</strong> ${nama}</p>
        <p><strong>Paket :</strong> ${paket}</p>
        <p><strong>Total Pembayaran :</strong> ${harga}</p>
        <p><strong>Status :</strong> Menunggu Pembayaran</p>
        <hr>
        <p>Silakan lanjut ke pembayaran untuk mengaktifkan akun bimbingan.</p>
    `;

    return false;
}
function setPaketFromQuery() {
    const params = new URLSearchParams(window.location.search);
    const paketParam = params.get('paket');
    if (!paketParam) return;

    const paketSelect = document.getElementById('paket');
    const paketOptions = {
        reguler: 'Paket Reguler - Rp 1.250.000 (3 Bulan)',
        intensif: 'Paket Intensif - Rp 2.150.000 (6 Bulan) ⭐ Rekomendasi',
        tahunan: 'Paket Tahunan - Rp 3.750.000 (12 Bulan)'
    };
    const selectedText = paketOptions[paketParam.toLowerCase()];
    if (!selectedText) return;

    for (const option of paketSelect.options) {
        if (option.text === selectedText) {
            option.selected = true;
            break;
        }
    }
}

document.addEventListener('DOMContentLoaded', setPaketFromQuery);
</script>

@endsection
