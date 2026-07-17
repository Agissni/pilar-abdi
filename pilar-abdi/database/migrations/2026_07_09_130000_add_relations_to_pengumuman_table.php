<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->unsignedInteger('id_user')->nullable()->after('id_pengumuman');
            
            $table->enum('target_role', ['semua', 'siswa', 'guru'])->default('semua')->after('isi');

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    
    public function down(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropColumn(['id_user', 'target_role']);
        });
    }
};
