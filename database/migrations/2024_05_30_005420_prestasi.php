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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id('id_prestasi');
            $table->foreignId('id_siswa');
            $table->string('jenis_prestasi', 255);
            $table->string('nama_prestasi', 255);
            $table->string('tingkatan', 255);
            $table->string('tahun_prestasi', 255);
            $table->string('penyelenggara', 255);
            $table->string('bukti', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
