@extends('layouts.app')
@section('title', 'Tryout - Pilar Abdi')

@section('content')

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold" style="color:#071739;">
            Tryout Online
        </h1>

        <p class="text-muted">
            Kerjakan soal berikut dengan teliti
        </p>
    </div>

    <div class="card shadow-lg border-0">

        <div class="card-header text-white"
             style="background:#071739;">
            <h4 class="mb-0">
                Soal Tryout TIU
            </h4>
        </div>

        <div class="card-body p-4">

            <form onsubmit="return selesaiTryout(event)">

                <!-- SOAL 1 -->
                <div class="mb-5">

                    <h5>
                        1. Jika 2 + 3 × 4 = ?
                    </h5>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="radio"
                               name="soal1"
                               value="A">

                        <label class="form-check-label">
                            A. 20
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="radio"
                               name="soal1"
                               value="B">

                        <label class="form-check-label">
                            B. 14
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="radio"
                               name="soal1"
                               value="C">

                        <label class="form-check-label">
                            C. 10
                        </label>
                    </div>

                </div>

                <!-- SOAL 2 -->
                <div class="mb-5">

                    <h5>
                        2. Anton lebih tinggi dari Budi. Budi lebih tinggi dari Cici. Maka...
                    </h5>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="radio"
                               name="soal2"
                               value="A">

                        <label class="form-check-label">
                            A. Cici lebih tinggi dari Anton
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="radio"
                               name="soal2"
                               value="B">

                        <label class="form-check-label">
                            B. Anton lebih tinggi dari Cici
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="radio"
                               name="soal2"
                               value="C">

                        <label class="form-check-label">
                            C. Tidak dapat disimpulkan
                        </label>
                    </div>

                </div>

                <button class="btn btn-success w-100 py-3">
                    Selesai Tryout
                </button>

            </form>

        </div>

    </div>

    <div id="hasilTryout"
         class="alert alert-info mt-4 d-none">
    </div>

</div>

<script>

function selesaiTryout(event){

    event.preventDefault();

    document.getElementById("hasilTryout")
            .classList.remove("d-none");

    document.getElementById("hasilTryout")
            .innerHTML = `
        <h4>✅ Tryout Berhasil Diselesaikan</h4>

        <hr>

        <p><strong>TWK :</strong> 80</p>
        <p><strong>TIU :</strong> 85</p>
        <p><strong>TKP :</strong> 90</p>

        <h5>Total Nilai : 255</h5>
    `;

    return false;
}

</script>

@endsection
