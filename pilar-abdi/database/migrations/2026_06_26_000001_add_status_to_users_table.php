<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// NOTE: Kolom 'status' dan 'role' sudah ditambahkan langsung di
// migration utama (0001_01_01_000000_create_users_table.php).
// Migration ini dikosongkan untuk menghindari duplikasi kolom.
return new class extends Migration
{
    public function up()
    {
        // Sudah ditangani di migration create_users_table
    }

    public function down()
    {
        // Tidak ada yang perlu di-rollback
    }
};
