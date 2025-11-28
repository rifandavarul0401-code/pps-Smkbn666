<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('siswa', function (Blueprint $table) {
            $table->id('siswa_id');
            $table->string('nis', 20)->unique();
            $table->string('nama_siswa');
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('status', ['aktif', 'lulus', 'pindah', 'drop_out', 'cuti'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};