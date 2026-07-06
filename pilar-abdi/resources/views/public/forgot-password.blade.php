@extends('layouts.app')
@section('title', 'Reset Password')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-5">

            <div class="card shadow-lg border-0">

                <div class="card-header text-center text-white py-4"
                     style="background:#071739;">
                    <h3>Reset Password</h3>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="/forgot-password">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Email Terdaftar</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="emailkamu@gmail.com" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Password Baru</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Minimal 6 karakter" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Ulangi password baru" required>
                        </div>

                        <button class="btn w-100 py-3 fw-bold mb-3" style="background:#071739; color: #fff;">RESET PASSWORD</button>

                        <div class="text-center">
                            <a href="/login" class="text-decoration-none" style="color: #071739; font-weight: 500;">Kembali ke Halaman Login</a>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
