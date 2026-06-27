@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container mt-5">

    <h2 class="mb-4">Dashboard Admin</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Total Siswa</h5>
                <h3>25</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Pembayaran Pending</h5>
                <h3>3</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Kelas Aktif</h5>
                <h3>5</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Guru</h5>
                <h3>3</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Paket Bimbel</h5>
                <h3>3</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Tryout Aktif</h5>
                <h3>2</h3>
            </div>
        </div>

    </div>

    <hr class="my-5">

    <h3 class="mb-4">Menu Admin</h3>

    <div class="row g-4">

        <div class="col-md-4">
            <a href="/admin/pembayaran" class="btn btn-warning w-100 py-4">
                Verifikasi Pembayaran
            </a>
        </div>

        <div class="col-md-4">
            <a href="/admin/siswa" class="btn btn-primary w-100 py-4">
                Kelola Siswa
            </a>
        </div>

        <div class="col-md-4">
            <a href="/admin/guru" class="btn btn-success w-100 py-4">
                Kelola Guru
            </a>
        </div>

        <div class="col-md-4">
            <a href="/admin/kelas" class="btn btn-info w-100 py-4">
                Kelola Kelas
            </a>
        </div>

        <div class="col-md-4">
            <a href="/admin/tryout" class="btn btn-danger w-100 py-4">
                Kelola Tryout
            </a>
        </div>

    </div>

</div>

@endsection