@extends('layouts.app')

@section('title', 'Kelola Siswa')

@section('content')

<div class="container mt-5">

    <h2 class="mb-4">Kelola Siswa</h2>

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Paket</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Kayla Najwa</td>
                        <td>Intensif</td>
                        <td>
                            <span class="badge bg-success">
                                Aktif
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary">
                                Detail
                            </button>

                            <button class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Budi Santoso</td>
                        <td>Reguler</td>
                        <td>
                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-success">
                                Aktifkan
                            </button>

                            <button class="btn btn-sm btn-danger">
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