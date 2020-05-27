<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaLimaTahunanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_lima_tahunan', function (Blueprint $table) {
            $table->increments('id');

            $table->dateTime('waktu_pembuatan');
            $table->unsignedInteger('puskesmas_id')->index();
            $table->foreign('puskesmas_id')->references('id')->on('puskesmas')
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
        Schema::dropIfExists('rencana_lima_tahunans');
    }
}
