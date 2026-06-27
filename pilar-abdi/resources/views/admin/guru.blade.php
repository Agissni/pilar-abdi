@extends('layouts.app')

@section('title', 'Kelola Guru')

@section('content')

<div class="container mt-5">

    <h2 class="mb-4">Kelola Guru</h2>

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Guru</th>
                        <th>Spesialis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Andi Saputra</td>
                        <td>TIU</td>
                        <td>
                            <button class="btn btn-sm btn-warning">
                                Edit
                            </button>

                            <button class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Rina Wulandari</td>
                        <td>TWK</td>
                        <td>
                            <button class="btn btn-sm btn-warning">
                                Edit
                            </button>

                            <button class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Dodi Pratama</td>
                        <td>TKP</td>
                        <td>
                            <button class="btn btn-sm btn-warning">
                                Edit
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