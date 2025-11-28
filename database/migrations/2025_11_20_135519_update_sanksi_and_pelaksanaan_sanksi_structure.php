<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update tabel sanksi sesuai diagram
        Schema::table('sanksi', function (Blueprint $table) {
            $table->dropColumn('catatan_pelaksanaan');
            $table->dropForeign(['guru_penangungjawab']);
            $table->dropColumn('guru_penangungjawab');
        });
        
        // Update tabel pelaksanaan_sanksi sesuai diagram
        Schema::table('pelaksanaan_sanksi', function (Blueprint $table) {
            $table->renameColumn('pelaksanaan_sanksi_id', 'pelaksanaan_id');
            $table->renameColumn('catatan', 'deskripsi_pelaksanaan');
            $table->unsignedBigInteger('guru_pengawas')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback perubahan
        Schema::table('sanksi', function (Blueprint $table) {
            $table->text('catatan_pelaksanaan')->nullable();
            $table->unsignedBigInteger('guru_penangungjawab')->nullable();
        });
        
        Schema::table('pelaksanaan_sanksi', function (Blueprint $table) {
            $table->renameColumn('pelaksanaan_id', 'pelaksanaan_sanksi_id');
            $table->renameColumn('deskripsi_pelaksanaan', 'catatan');
            $table->dropColumn('guru_pengawas');
        });
    }
};
