@extends('layouts.app')
@section('title', 'Pendaftaran - Pilar Abdi')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

```
        <div class="text-center mb-5">
            <h1 class="fw-bold" style="color: #071739; font-size: 42px;">Form Pendaftaran</h1>
            <p class="lead text-muted">Isi data diri untuk bergabung dengan Pilar Abdi</p>
        </div>

        <div class="card shadow-lg border-0" style="border-radius: 24px; overflow: hidden;">

            <div class="card-header text-white py-4 text-center" style="background: #071739;">
                <h4 class="mb-0 fw-bold">DAFTAR SEKARANG</h4>
            </div>

            <div class="card-body p-5 bg-white">

                <!-- FORM PENDAFTARAN -->
                <div id="formPendaftaran">

                    <form onsubmit="return daftarBerhasil(event)">

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Nama Lengkap</label>
                                <input type="text" id="nama" class="form-control form-control-lg" placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Nomor WhatsApp</label>
                                <input type="text" class="form-control form-control-lg" placeholder="0812xxxxxxxx" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color: #071739;">Email</label>
                            <input type="email" class="form-control form-control-lg" placeholder="emailkamu@gmail.com" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Pilih Paket</label>

                                <select id="paket" class="form-select form-select-lg" required>
                                    <option value="">-- Pilih Paket --</option>
                                    <option>Paket Reguler - Rp 1.250.000 (3 Bulan)</option>
                                    <option>Paket Intensif - Rp 2.150.000 (6 Bulan) ⭐ Rekomendasi</option>
                                    <option>Paket Tahunan - Rp 3.750.000 (12 Bulan)</option>
                                </select>

                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold" style="color: #071739;">Sekolah Kedinasan Tujuan</label>

                                <select class="form-select form-select-lg" required>
                                    <option value="">-- Pilih Sekolah --</option>
                                    <option>IPDN</option>
                                    <option>STAN</option>
                                    <option>SSN</option>
                                    <option>STIN</option>
                                    <option>POLTEKIM</option>
                                    <option>Lainnya</option>
                                </select>

                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color: #071739;">Alamat Lengkap</label>
                            <textarea class="form-control form-control-lg" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                        </div>

                        <button type="submit"
                            class="btn w-100 py-4 fw-bold fs-5"
                            style="background: #f5b93b; color: #071739; border-radius: 16px;">
                            DAFTAR SEKARANG
                        </button>

                    </form>

                </div>

                <!-- RINGKASAN PENDAFTARAN -->
                <div id="ringkasanDaftar" class="d-none">

                    <div class="text-center">

                        <h2 class="fw-bold text-success mb-4">
                            ✅ Pendaftaran Berhasil
                        </h2>

                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-start" id="isiRingkasan">

                            </div>
                        </div>

                        <a href="/pembayaran"
                           class="btn btn-warning mt-4 px-4 py-3 fw-bold">
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
```

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
