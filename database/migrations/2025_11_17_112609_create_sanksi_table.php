<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sanksi', function (Blueprint $table) {
            $table->id('sanksi_id');
            $table->unsignedBigInteger('pelanggaran_id');
            $table->foreign('pelanggaran_id')->references('pelanggaran_id')->on('pelanggaran')->onDelete('cascade');
            $table->string('jenis_sanksi');
            $table->text('deskripsi_sanksi')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['aktif', 'selesai', 'dibatalkan'])->default('aktif');
            $table->text('catatan_pelaksanaan')->nullable();
            $table->unsignedBigInteger('guru_penangungjawab')->nullable();
            $table->foreign('guru_penangungjawab')->references('guru_id')->on('guru')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sanksi');
    }
};