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
            $table->unsignedInteger('puskesmas_id')->index();
            $table->dateTime('waktu_pembuatan');
            $table->timestamps();

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
        Schema::dropIfExists('rencana_pelaksanaan_kegiatan');
    }
}
