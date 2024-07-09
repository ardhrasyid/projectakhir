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
    Schema::create('pendaftaran_ekskul', function (Blueprint $table) {
        $table->id('id_pendaftaran');
        $table->unsignedBigInteger('id_ekskul');
        $table->unsignedBigInteger('id_siswa');
        $table->date('tanggal_daftar');
        $table->string('status_pendaftaran', 255);
        
        $table->foreign('id_ekskul')->references('id_ekskul')->on('ekstrakurikuler')->onDelete('cascade');
        $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade');
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_ekskul');
    }
};
