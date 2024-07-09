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
        Schema::create('ekstrakulikuler', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama', 255);
            $table->unsignedBigInteger('user_id');
            $table->text('deskripsi')->nullable();
            $table->text('status')->nullable();
            $table->integer('kuota')->nullable();
            $table->string('status_pendaftaran', 255)->nullable();
            $table->date('tgl_dibuka')->nullable();
            $table->date('tgl_ditutup')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakulikuler');
    }
};
