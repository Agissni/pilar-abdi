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
        Schema::create('tryout_attempts', function (Blueprint $table) {
            $table->id('id_tryout_attempt');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->foreignId('id_tryout')->constrained('tryouts', 'id_tryout')->onDelete('cascade');
            $table->integer('score_twk');
            $table->integer('score_tiu');
            $table->integer('score_tkp');
            $table->integer('score_total');
            $table->enum('status', ['lulus', 'tidak_lulus']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout_attempts');
    }
};
