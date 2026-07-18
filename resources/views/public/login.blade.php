@extends('layouts.app')
@section('title', 'Login')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-5">

            <div class="card shadow-lg border-0">

                <div class="card-header text-center text-white py-4"
                     style="background:#071739;">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="/login">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="emailkamu@gmail.com" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                        </div>

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div></div>
                            <a href="/forgot-password" class="text-decoration-none" style="color: #071739; font-size: 14px; font-weight: 500;">Forgot Password?</a>
                        </div>

                        <button class="btn w-100 py-3 fw-bold" style="background:#071739; color: #fff;">MASUK</button>
                    </form>
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
            Mengarahkan ke Dashboard...
        </div>
    `;

    return false;
}
</script>

@endsection
