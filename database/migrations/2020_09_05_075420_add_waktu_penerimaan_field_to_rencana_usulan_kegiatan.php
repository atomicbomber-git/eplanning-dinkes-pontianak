<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWaktuPenerimaanFieldToRencanaUsulanKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rencana_usulan_kegiatan', function (Blueprint $table) {
            $table->dateTime('waktu_penerimaan')
                ->after('waktu_pembuatan')
                ->nullable()
                ->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rencana_usulan_kegiatan', function (Blueprint $table) {
            $table->dropColumn('waktu_penerimaan');
        });
    }
}
