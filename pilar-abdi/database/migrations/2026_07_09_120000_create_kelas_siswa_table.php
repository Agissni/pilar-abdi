<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('kelas_siswa', function (Blueprint $table) {
            $table->increments('id_kelas_siswa');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_kelas');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('kelas_siswa');
    }
};
