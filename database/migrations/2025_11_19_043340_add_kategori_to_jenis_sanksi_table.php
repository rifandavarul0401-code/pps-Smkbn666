<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jenis_sanksi', function (Blueprint $table) {
            $table->string('kategori')->after('deskripsi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('jenis_sanksi', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};