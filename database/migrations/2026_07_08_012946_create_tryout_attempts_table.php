<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tryout_attempts', function (Blueprint $table) {
            $table->increments('id_tryout_attempt');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_tryout');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_tryout')->references('id_tryout')->on('tryouts')->onDelete('cascade');
            $table->integer('score_twk');
            $table->integer('score_tiu');
            $table->integer('score_tkp');
            $table->integer('score_total');
            $table->enum('status', ['lulus', 'tidak_lulus']);
            $table->json('answers')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tryout_attempts');
    }
};
