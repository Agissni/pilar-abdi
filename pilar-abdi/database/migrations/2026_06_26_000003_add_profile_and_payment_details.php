<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->after('email');
            $table->string('package')->nullable()->after('status');
            $table->string('sekdin')->nullable()->after('package');
            $table->text('address')->nullable()->after('sekdin');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->string('sender_name')->nullable()->after('account_number');
            $table->date('transfer_date')->nullable()->after('sender_name');
            $table->time('transfer_time')->nullable()->after('transfer_date');
            $table->unsignedBigInteger('amount')->nullable()->after('transfer_time');
            $table->text('note')->nullable()->after('amount');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['whatsapp', 'package', 'sekdin', 'address']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['sender_name', 'transfer_date', 'transfer_time', 'amount', 'note']);
        });
    }
};
