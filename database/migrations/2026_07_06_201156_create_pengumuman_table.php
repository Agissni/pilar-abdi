<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->increments('id_pengumuman');
            $table->string('judul');
            $table->text('isi');
            $table->dateTime('tanggal_publikasi');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
