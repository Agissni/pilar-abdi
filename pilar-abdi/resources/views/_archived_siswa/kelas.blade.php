@extends('layouts.app')
@section('title', 'Kelas Saya')

@section('content')

<div class="container py-5">

    <h2 class="mb-4 fw-bold">
        Kelas Saya
    </h2>

    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card shadow border-0">

                <div class="card-header text-white"
                     style="background:#071739;">
                    TWK
                </div>

                <div class="card-body">

                    <p><strong>Guru:</strong> Budi Santoso</p>

                    <p><strong>Jadwal:</strong><br>
                    Senin & Rabu<br>
                    19.00 WIB</p>

                    <button class="btn btn-primary">
                        Masuk Kelas
                    </button>

                </div>

            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow border-0">

                <div class="card-header text-white"
                     style="background:#071739;">
                    TIU
                </div>

                <div class="card-body">

                    <p><strong>Guru:</strong> Andi Saputra</p>

                    <p><strong>Jadwal:</strong><br>
                    Selasa & Kamis<br>
                    19.00 WIB</p>

                    <button class="btn btn-primary">
                        Masuk Kelas
                    </button>

                </div>

            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow border-0">

                <div class="card-header text-white"
                     style="background:#071739;">
                    TKP
                </div>

                <div class="card-body">

                    <p><strong>Guru:</strong> Rina Putri</p>

                    <p><strong>Jadwal:</strong><br>
                    Jumat<br>
                    19.00 WIB</p>

                    <button class="btn btn-primary">
                        Masuk Kelas
                    </button>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection
