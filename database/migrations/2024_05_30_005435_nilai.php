<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
            public function up()
            {
                Schema::create('nilai', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('siswa_id');
                    $table->unsignedBigInteger('mata_pelajaran_id');
                    $table->integer('semester');
                    $table->decimal('nilai_pertemuan_1', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_2', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_3', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_4', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_5', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_6', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_7', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_8', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_9', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_10', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_11', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_12', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_13', 5, 2)->nullable();
                    $table->decimal('nilai_pertemuan_14', 5, 2)->nullable();
                    $table->decimal('nilai_uts', 5, 2)->nullable();
                    $table->decimal('nilai_uas', 5, 2)->nullable();
                    $table->string('keterangan')->nullable();
                    $table->timestamps();
        
                    $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
                    $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajaran')->onDelete('cascade');
                });
            }
        
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
