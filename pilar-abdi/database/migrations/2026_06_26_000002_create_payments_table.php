<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('id_user');
            $table->string('bank')->nullable();
            $table->string('account_number')->nullable();
            $table->string('sender_name')->nullable();
            $table->date('transfer_date')->nullable();
            $table->time('transfer_time')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->text('note')->nullable();
            $table->string('proof_path')->nullable();
            $table->enum('status', ['pending', 'lunas', 'ditolak'])->default('pending');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
