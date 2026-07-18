<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('tryout_questions', function (Blueprint $table) {
            $table->increments('id_tryout_question');
            $table->unsignedInteger('id_tryout')->nullable();
            $table->integer('nomor_soal');
            $table->enum('kategori', ['TIU', 'TWK', 'TKP']);
            $table->text('pertanyaan');
            $table->text('pilihan_a');
            $table->text('pilihan_b');
            $table->text('pilihan_c');
            $table->text('pilihan_d');
            $table->text('pilihan_e');
            $table->char('jawaban_benar', 1);
            $table->text('pembahasan')->nullable();
            $table->timestamps();

            $table->foreign('id_tryout')->references('id_tryout')->on('tryouts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tryout_questions');
    }
};
