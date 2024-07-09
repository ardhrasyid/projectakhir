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
        Schema::create('pendaftaran_ekstra', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_ekskul');
            $table->unsignedBigInteger('id_user');
            $table->date('tanggal_daftar');
            $table->string('status_pendaftaran', 255);
            
            $table->foreign('id_ekskul')->references('id')->on('ekstrakulikuler')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_ekstra');
    }
};
