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
            $table->id();
            $table->string('nama_kelas');
            $table->string('materi');         // TIU, TWK, TKP, dll
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->string('hari')->nullable();   // Senin, Selasa, dll
            $table->string('jam')->nullable();    // 19.00 WIB
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('set null');
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
