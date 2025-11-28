<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('jenis_pelanggaran', function (Blueprint $table) {
            $table->dropColumn('kode_pelanggaran');
        });
    }

    public function down()
    {
        Schema::table('jenis_pelanggaran', function (Blueprint $table) {
            $table->string('kode_pelanggaran', 10)->after('jenis_pelanggaran_id');
        });
    }
};
