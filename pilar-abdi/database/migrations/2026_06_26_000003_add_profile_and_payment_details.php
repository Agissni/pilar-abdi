<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// NOTE: Semua kolom profil user (whatsapp, package, sekdin, address)
// dan kolom detail pembayaran (sender_name, transfer_date, dst)
// sudah ditambahkan langsung di migration utama masing-masing.
// Migration ini dikosongkan untuk menghindari duplikasi kolom.
return new class extends Migration
{
    public function up(): void
    {
        // Sudah ditangani di migration utama
    }

    public function down(): void
    {
        // Tidak ada yang perlu di-rollback
    }
};
