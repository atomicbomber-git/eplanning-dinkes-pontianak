<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemRencanaLimaTahunanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_rencana_lima_tahunan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rencana_lima_tahunan_id')->index();
            $table->unsignedInteger('upaya_kesehatan_id')->index();
            $table->text('tujuan')->nullable();
            $table->text('indikator_kinerja')->nullable();
            $table->text('cara_perhitungan')->nullable();
            $table->double('target_tahun_1')->nullable();
            $table->double('target_tahun_2')->nullable();
            $table->double('target_tahun_3')->nullable();
            $table->double('target_tahun_4')->nullable();
            $table->double('target_tahun_5')->nullable();
            $table->text('rincian_kegiatan')->nullable();
            $table->decimal('kebutuhan_anggaran', 19, 4)->nullable();
            $table->timestamps();

            $table->foreign('upaya_kesehatan_id')->references('id')->on('upaya_kesehatan')
                ->cascadeOnDelete();

            $table->foreign('rencana_lima_tahunan_id')->references('id')->on('rencana_lima_tahunan')
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
        Schema::dropIfExists('item_rencana_lima_tahunan');
    }
}
