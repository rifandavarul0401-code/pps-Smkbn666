<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orangtua', function (Blueprint $table) {
            $table->id('orangtua_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('siswa_id');
            $table->enum('hubungan', ['ayah', 'ibu', 'wali']);
            $table->string('nama_orangtua');
            $table->string('pekerjaan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('no_telp')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('siswa_id')->references('siswa_id')->on('siswa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orangtua');
    }
};