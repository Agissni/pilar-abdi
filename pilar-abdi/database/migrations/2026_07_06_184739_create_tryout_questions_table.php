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
        Schema::create('tryout_questions', function (Blueprint $table) {
            $table->id('id_tryout_question');
            $table->foreignId('id_tryout')->nullable()->constrained('tryouts', 'id_tryout')->onDelete('cascade');
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout_questions');
    }
};
