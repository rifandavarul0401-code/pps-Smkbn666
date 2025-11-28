<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kategori_pelanggaran', function (Blueprint $table) {
            $table->id('kategori_id');
            $table->string('nama_kategori');
            $table->text('deskripsi')->nullable();
            $table->string('warna', 7)->default('#6c757d'); // Hex color
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_pelanggaran');
    }
};
