<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemRencanaPelaksanaanKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_rencana_pelaksanaan_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rencana_pelaksanaan_kegiatan_id')->index('rpk-id-index');
            $table->unsignedInteger('upaya_kesehatan_id')->index();

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

            $table->foreign('rencana_pelaksanaan_kegiatan_id', "irpk-rpk-foreign")
                ->references('id')
                ->on('rencana_pelaksanaan_kegiatan')
                ->cascadeOnDelete();

            $table->foreign('upaya_kesehatan_id')->references('id')
                ->on('upaya_kesehatan')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_rencana_pelaksanaan_kegiatan');
    }
}
