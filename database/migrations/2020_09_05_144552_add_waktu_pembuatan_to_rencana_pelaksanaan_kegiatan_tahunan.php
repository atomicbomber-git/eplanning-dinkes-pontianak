<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWaktuPembuatanToRencanaPelaksanaanKegiatanTahunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rencana_pelaksanaan_kegiatan_tahunan', function (Blueprint $table) {
            $table->dateTime('waktu_penerimaan')
                ->after('tahun')
                ->nullable()
                ->index();

            $table->dateTime('waktu_pembuatan')
                ->after('waktu_penerimaan')
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
        Schema::table('rencana_pelaksanaan_kegiatan_tahunan', function (Blueprint $table) {
            $table->dropColumn('waktu_penerimaan');
            $table->dropColumn('waktu_pembuatan');
        });
    }
}
