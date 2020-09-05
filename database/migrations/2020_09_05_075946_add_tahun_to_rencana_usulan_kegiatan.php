<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTahunToRencanaUsulanKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rencana_usulan_kegiatan', function (Blueprint $table) {
            $table->unsignedInteger('tahun')
                ->after('waktu_penerimaan')
                ->index();

            $table->unique(['puskesmas_id', 'tahun']);
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
            $table->dropColumn('tahun');
        });
    }
}
