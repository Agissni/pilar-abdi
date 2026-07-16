<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('bimbingan_privat', function (Blueprint $table) {
            $table->id('id_bimbingan_privat');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_guru');
            $table->date('tgl_konsultasi');
            $table->time('jam_konsultasi');
            $table->text('topik');
            $table->enum('status', ['pending', 'disetujui', 'selesai', 'dibatalkan'])->default('pending');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_guru')->references('id_guru')->on('guru')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bimbingan_privat');
    }
};
