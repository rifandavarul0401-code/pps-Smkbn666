<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->string('nisn')->nullable()->after('nis');
            $table->date('tanggal_lahir')->nullable()->after('nama_siswa');
            $table->string('tempat_lahir')->nullable()->after('tanggal_lahir');
            $table->text('alamat')->nullable()->after('tempat_lahir');
            $table->string('no_telp')->nullable()->after('alamat');
            $table->string('foto')->nullable()->after('no_telp');
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn(['nisn', 'tanggal_lahir', 'tempat_lahir', 'alamat', 'no_telp', 'foto']);
        });
    }
};