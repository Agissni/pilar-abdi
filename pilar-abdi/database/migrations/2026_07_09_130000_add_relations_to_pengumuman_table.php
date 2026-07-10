<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            // Tambahkan id_user setelah id utama (nullable untuk ON DELETE SET NULL)
            $table->unsignedBigInteger('id_user')->nullable()->after('id_pengumuman');
            
            // Tambahkan target_role setelah kolom isi
            $table->enum('target_role', ['semua', 'siswa', 'guru'])->default('semua')->after('isi');

            // Tambahkan relasi foreign key
            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            // Drop foreign key & columns
            $table->dropForeign(['id_user']);
            $table->dropColumn(['id_user', 'target_role']);
        });
    }
};
