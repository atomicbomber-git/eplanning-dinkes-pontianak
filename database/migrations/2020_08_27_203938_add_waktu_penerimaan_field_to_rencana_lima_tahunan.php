<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWaktuPenerimaanFieldToRencanaLimaTahunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rencana_lima_tahunan', function (Blueprint $table) {
            $table->dateTime("waktu_penerimaan")
                ->nullable()
                ->after("waktu_pembuatan");
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
            $table->dropColumn("waktu_penerimaan");
        });
    }
}
