<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaPelaksanaanKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_pelaksanaan_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('waktu_pembuatan');
            $table->text('kegiatan');
            $table->text('tujuan');
            $table->text('sasaran');
            $table->text('target_sasaran');
            $table->text('penanggung_jawab');
            $table->text('volume_kegiatan');
            $table->text('jadwal');
            $table->text('rincian_pelaksanaan');
            $table->text('lokasi_pelaksanaan');
            $table->decimal('biaya', 19, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rencana_pelaksanaan_kegiatan');
    }
}
