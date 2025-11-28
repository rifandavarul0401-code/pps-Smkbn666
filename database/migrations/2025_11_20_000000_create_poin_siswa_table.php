<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poin_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->foreign('siswa_id')->references('siswa_id')->on('siswa')->onDelete('cascade');
            $table->integer('total_poin')->default(100); // Poin awal 100
            $table->integer('poin_pelanggaran')->default(0);
            $table->integer('poin_prestasi')->default(0);
            $table->timestamps();
            
            $table->unique('siswa_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poin_siswa');
    }
};