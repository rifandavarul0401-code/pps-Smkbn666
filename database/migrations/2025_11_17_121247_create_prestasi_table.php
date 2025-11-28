<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id('prestasi_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('guru_pencatat');
            $table->unsignedBigInteger('jenis_prestasi_id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->string('tingkat')->nullable();
            $table->integer('poin');
            $table->text('keterangan')->nullable();
            $table->enum('status_verifikasi', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
