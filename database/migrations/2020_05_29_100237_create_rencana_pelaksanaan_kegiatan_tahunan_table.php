<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaPelaksanaanKegiatanTahunanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_pelaksanaan_kegiatan_tahunan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('puskesmas_id')->index();
            $table->integer('tahun');
            $table->timestamps();

            $table->unique(['puskesmas_id', 'tahun']);

            $table->foreign('puskesmas_id')->references('id')->on('puskesmas')
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
        Schema::dropIfExists('rencana_pelaksanaan_kegiatan_tahunan');
    }
}
