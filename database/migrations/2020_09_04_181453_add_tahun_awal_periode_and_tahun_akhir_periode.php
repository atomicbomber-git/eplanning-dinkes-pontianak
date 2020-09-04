<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddTahunAwalPeriodeAndTahunAkhirPeriode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rencana_lima_tahunan', function (Blueprint $table) {
            $table->unsignedInteger("tahun_awal_periode")->index();
            $table->unsignedInteger("tahun_akhir_periode");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rencana_lima_tahunan', function (Blueprint $table) {
            $table->dropColumn("tahun_awal_periode");
            $table->dropColumn("tahun_akhir_periode");
        });
    }
}
