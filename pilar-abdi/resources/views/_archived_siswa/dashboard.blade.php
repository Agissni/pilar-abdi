@extends('layouts.app')
@section('title', 'Dashboard Siswa')

@section('content')

<div class="container py-5">

    <h2 class="mb-4">
        Dashboard Siswa
    </h2>

    <div class="alert alert-success">
        Status Akun : AKTIF
    </div>

    <div class="row">

        <div class="col-md-3">
            <div class="card p-4 text-center">
                Kelas Saya
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4 text-center">
                Tryout
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4 text-center">
                Hasil Tryout
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4 text-center">
                Profil
            </div>
        </div>

    </div>

</div>

@endsection
