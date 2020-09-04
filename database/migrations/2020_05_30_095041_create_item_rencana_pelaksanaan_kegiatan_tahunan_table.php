<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemRencanaPelaksanaanKegiatanTahunanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_rencana_pelaksanaan_kegiatan_tahunan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rencana_pelaksanaan_kegiatan_tahunan_id')->index('rpk-id-index');
            $table->unsignedInteger('upaya_kesehatan_id')->index('irpk-up-index');

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

            $table->foreign('rencana_pelaksanaan_kegiatan_tahunan_id', "irpk-rpk-foreign")
                ->references('id')
                ->on('rencana_pelaksanaan_kegiatan_tahunan');

            $table->foreign('upaya_kesehatan_id', 'irpk-up-foreign')
                ->references('id')
                ->on('upaya_kesehatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_rencana_pelaksanaan_kegiatan_tahunan');
    }
}
