<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bimbingan_konseling', function (Blueprint $table) {
            $table->id('bk_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('guru_konselor_id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->enum('jenis_layanan', ['konseling_individu', 'konseling_kelompok', 'bimbingan_klasikal', 'konsultasi']);
            $table->string('topik');
            $table->text('keluhan_masalah');
            $table->text('tindakan_solusi');
            $table->enum('status', ['proses', 'selesai', 'tindak_lanjut']);
            $table->date('tanggal_konseling');
            $table->date('tanggal_tindak_lanjut')->nullable();
            $table->text('hasil_evaluasi')->nullable();
            $table->timestamps();
            
            $table->foreign('siswa_id')->references('siswa_id')->on('siswa')->onDelete('cascade');
            $table->foreign('guru_konselor_id')->references('guru_id')->on('guru')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bimbingan_konseling');
    }
};