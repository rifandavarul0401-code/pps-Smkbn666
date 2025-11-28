<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_sanksi', function (Blueprint $table) {
            $table->id('jenis_sanksi_id');
            $table->string('nama_sanksi');
            $table->text('deskripsi')->nullable();
            $table->integer('min_poin')->default(1);
            $table->integer('max_poin')->default(100);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_sanksi');
    }
};