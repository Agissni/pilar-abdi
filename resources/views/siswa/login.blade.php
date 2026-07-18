@extends('layouts.app')
@section('title', 'Login')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-5">

            <div class="card shadow-lg border-0">

                <div class="card-header text-center text-white py-4"
                     style="background:#071739;">
                    <h3>Login Siswa</h3>
                </div>

                <div class="card-body p-5">

                    <form onsubmit="return loginBerhasil(event)">

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label>Password</label>
                            <input type="password"
                                   class="form-control"
                                   required>
                        </div>

                        <button class="btn btn-warning w-100">
                            Login
                        </button>

                    </form>

                    <div id="hasilLogin" class="mt-4"></div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
function loginBerhasil(event){

    event.preventDefault();

    document.getElementById("hasilLogin").innerHTML = `
        <div class="alert alert-success">
            Login berhasil.
            Mengarahkan ke Dashboard Siswa...
        </div>
    `;

    return false;
}
</script>

@endsection
