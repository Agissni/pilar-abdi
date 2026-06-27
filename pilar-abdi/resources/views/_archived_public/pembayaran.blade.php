@extends('layouts.app')
@section('title', 'Pembayaran - Pilar Abdi')

@section('content')

<div class="container py-5">

```
<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card shadow-lg border-0">

            <div class="card-header text-white text-center py-4"
                 style="background:#071739;">
                <h3 class="mb-0">Pembayaran Pendaftaran</h3>
            </div>

            <div class="card-body p-5">

                <div class="alert alert-warning">
                    <strong>Status:</strong> Menunggu Pembayaran
                </div>

                <h5 class="mb-3">Informasi Pembayaran</h5>

                <table class="table">
                    <tr>
                        <th>Bank</th>
                        <td>BCA</td>
                    </tr>

                    <tr>
                        <th>No Rekening</th>
                        <td>1234567890</td>
                    </tr>

                    <tr>
                        <th>Atas Nama</th>
                        <td>Pilar Abdi</td>
                    </tr>

                    <tr>
                        <th>Total Pembayaran</th>
                        <td>
                            <strong class="text-danger">
                                Rp 2.150.000
                            </strong>
                        </td>
                    </tr>
                </table>

                <hr>

                <h5 class="mb-3">Upload Bukti Pembayaran</h5>

                <form onsubmit="return kirimBukti(event)">

                    <div class="mb-4">
                        <input type="file"
                               class="form-control"
                               required>
                    </div>

                    <button type="submit"
                            class="btn btn-success w-100">
                        Kirim Bukti Pembayaran
                    </button>

                    <div id="statusPembayaran" class="mt-4"></div>

                </form>

            </div>

        </div>

    </div>

</div>
```

</div>

<script>
function kirimBukti(event){
    event.preventDefault();

    document.getElementById("statusPembayaran").innerHTML = `
        <div class="alert alert-info">
            <h5>✅ Bukti Pembayaran Berhasil Dikirim</h5>
            <p class="mb-1">
                Bukti pembayaran Anda telah diterima sistem.
            </p>
            <p class="mb-0">
                <strong>Status:</strong> Menunggu Verifikasi Admin
            </p>
        </div>
    `;

    return false;
}
</script>

@endsection
