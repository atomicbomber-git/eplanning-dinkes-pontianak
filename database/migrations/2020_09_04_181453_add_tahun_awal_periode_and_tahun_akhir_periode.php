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

        DB::unprepared("ALTER TABLE rencana_lima_tahunan ADD CONSTRAINT period_must_be_5_years_long CHECK ((tahun_akhir_periode - tahun_awal_periode) = 4)");
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
