@extends('layouts.app')

@section('title', 'Kelola Kelas')

@section('content')

<div class="container mt-5">

    <h2 class="mb-4">Kelola Kelas</h2>

    <div class="mb-3">
        <button class="btn btn-primary">
            Tambah Kelas
        </button>
    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Kelas</th>
                        <th>Materi</th>
                        <th>Guru</th>
                        <th>Jadwal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Kelas TIU A</td>
                        <td>TIU</td>
                        <td>Andi Saputra</td>
                        <td>Senin, 19.00 WIB</td>
                        <td>
                            <button class="btn btn-warning btn-sm">
                                Edit
                            </button>

                            <button class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Kelas TWK A</td>
                        <td>TWK</td>
                        <td>Rina Wulandari</td>
                        <td>Rabu, 19.00 WIB</td>
                        <td>
                            <button class="btn btn-warning btn-sm">
                                Edit
                            </button>

                            <button class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Kelas TKP A</td>
                        <td>TKP</td>
                        <td>Dodi Pratama</td>
                        <td>Jumat, 19.00 WIB</td>
                        <td>
                            <button class="btn btn-warning btn-sm">
                                Edit
                            </button>

                            <button class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection