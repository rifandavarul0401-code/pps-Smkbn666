<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('kelas_id');
            $table->string('nama_kelas');
            $table->string('jurusan');
            $table->integer('kapasitas');
            $table->unsignedBigInteger('wali_kelas_id')->nullable();
            $table->timestamps();
            
            // $table->foreign('wali_kelas_id')->references('guru_id')->on('guru')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};