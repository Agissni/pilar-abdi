<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tryouts', function (Blueprint $table) {
            $table->increments('id_tryout');
            $table->string('nama_tryout');
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_soal');
            $table->integer('durasi'); // in minutes
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_berakhir');
            $table->enum('status', ['aktif', 'belum_dimulai', 'selesai'])->default('belum_dimulai');
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('tryouts');
    }
};
