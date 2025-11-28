<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pelanggaran', function (Blueprint $table) {
            $table->id('pelanggaran_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('guru_pencatat');
            $table->unsignedBigInteger('jenis_pelanggaran_id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->integer('poin');
            $table->text('keterangan')->nullable();
            $table->string('bukti_foto')->nullable();
            $table->enum('status_verifikasi', ['pending', 'verified', 'rejected'])->default('pending');
            $table->unsignedBigInteger('guru_verifikator')->nullable();
            $table->text('catatan_verifikasi')->nullable();
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggaran');
    }
};
