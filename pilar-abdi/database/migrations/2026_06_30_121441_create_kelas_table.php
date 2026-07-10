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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->string('nama_kelas');
            $table->string('materi');         // TIU, TWK, TKP, dll
            $table->unsignedBigInteger('id_guru')->nullable();
            $table->string('hari')->nullable();   // Senin, Selasa, dll
            $table->string('jam')->nullable();    // 19.00 WIB
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('id_guru')->references('id_guru')->on('guru')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
