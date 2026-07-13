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
        Schema::table('kelas', function (Blueprint $table) {
            $table->string('gmeet_link')->nullable();
            $table->string('materi_pdf_path')->nullable();
            $table->string('materi_pdf_name')->nullable();
            $table->string('link_rekaman')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn(['gmeet_link', 'materi_pdf_path', 'materi_pdf_name', 'link_rekaman']);
        });
    }
};
