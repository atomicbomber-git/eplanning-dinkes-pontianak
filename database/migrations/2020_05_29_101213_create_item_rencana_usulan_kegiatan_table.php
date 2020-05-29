<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemRencanaUsulanKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_rencana_usulan_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rencana_usulan_kegiatan_id')->index();
            $table->unsignedInteger('upaya_kesehatan_id')->index();
            $table->text('kegiatan')->nullable();
            $table->text('tujuan')->nullable();
            $table->text('sasaran')->nullable();
            $table->text('target_sasaran')->nullable();
            $table->text('penanggung_jawab')->nullable();
            $table->text('kebutuhan_sumber_daya')->nullable();
            $table->text('mitra_kerja')->nullable();
            $table->text('waktu_pelaksanaan')->nullable();
            $table->decimal('kebutuhan_anggaran', 19, 4)->nullable();
            $table->text('indikator_kinerja')->nullable();
            $table->text('sumber_pembiayaan')->nullable();
            $table->timestamps();

            $table->unique(['rencana_usulan_kegiatan_id', 'upaya_kesehatan_id'], 'rukid_ukid_unique');

            $table->foreign('rencana_usulan_kegiatan_id')->references('id')->on('rencana_usulan_kegiatan')
                ->cascadeOnDelete();
            $table->foreign('upaya_kesehatan_id')->references('id')->on('upaya_kesehatan')
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
        Schema::dropIfExists('item_rencana_usulan_kegiatan');
    }
}
