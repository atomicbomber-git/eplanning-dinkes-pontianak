<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubItemRencanaPelaksanaanKegiatanTahunanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_item_rencana_pelaksanaan_kegiatan_tahunan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_rencana_pelaksanaan_kegiatan_tahunan_id')->index('irpkt-id');
            $table->text('volume_kegiatan');
            $table->decimal('biaya', 19, 4);

            $table->foreign('item_rencana_pelaksanaan_kegiatan_tahunan_id', 'sirpkt-irpkt')
                ->references('id')
                ->on('item_rencana_pelaksanaan_kegiatan_tahunan')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('sub_item_rencana_pelaksanaan_kegiatan_tahunan');
    }
}
