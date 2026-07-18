<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->increments('id_guru');
            $table->string('nama');
            $table->string('spesialisasi');   // TIU, TWK, TKP, dll
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
