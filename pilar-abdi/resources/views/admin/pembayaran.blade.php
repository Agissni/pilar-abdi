@extends('layouts.app')
@section('title', 'Admin - Verifikasi Pembayaran')

@section('content')

<div class="container py-5">

    <h2 class="fw-bold mb-4" style="color:#071739;">
        Data Pembayaran Siswa
    </h2>

    <div class="card shadow border-0">

        <div class="card-header text-white"
             style="background:#071739;">
            Verifikasi Pembayaran
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <table class="table table-bordered align-middle">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Paket</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                        <?php $__currentLoopData = $payments ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($idx + 1); ?></td>
                                <td>
                                    <?php echo e(optional($payment->user)->name ?? '-'); ?>
                                    <br>
                                    <small><?php echo e(optional($payment->user)->email ?? '-'); ?></small>
                                </td>
                                <td><?php echo e(ucfirst(optional($payment->user)->package ?? '-')); ?></td>
                                <td>
                                    <?php if($payment->status === 'pending'): ?>
                                        <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                                    <?php elseif($payment->status === 'lunas'): ?>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if($payment->proof_path): ?>
                                        <a href="<?php echo e(asset('storage/' . $payment->proof_path)); ?>" target="_blank" class="btn btn-primary btn-sm">Lihat Bukti</a>
                                    <?php endif; ?>

                                    <form action="/admin/pembayaran/<?php echo e($payment->id); ?>/verify" method="POST" style="display:inline-block; margin-left:6px;">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" name="action" value="accept" class="btn btn-success btn-sm">Terima</button>
                                    </form>

                                    <form action="/admin/pembayaran/<?php echo e($payment->id); ?>/verify" method="POST" style="display:inline-block; margin-left:6px;">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>

function lihatBukti(){
    alert("Di sini nanti admin melihat foto bukti pembayaran.");
}

function terimaPembayaran(btn){

    let row = btn.closest("tr");

    row.cells[3].innerHTML =
        '<span class="badge bg-success">Lunas</span>';

    alert(
        "Pembayaran berhasil diverifikasi.\n\n" +
        "Status akun siswa menjadi AKTIF."
    );
}

function tolakPembayaran(btn){

    let row = btn.closest("tr");

    row.cells[3].innerHTML =
        '<span class="badge bg-danger">Ditolak</span>';

    alert(
        "Pembayaran ditolak.\n\n" +
        "Silakan siswa mengunggah ulang bukti pembayaran."
    );
}

</script>

@endsection