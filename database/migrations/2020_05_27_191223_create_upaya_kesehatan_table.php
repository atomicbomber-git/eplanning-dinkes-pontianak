<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpayaKesehatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upaya_kesehatan', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('unit_puskesmas_id')->index();
            $table->foreign('unit_puskesmas_id')->references('id')->on('unit_puskesmas')
                ->cascadeOnDelete();

            $table->string('nama')->comment('Nama Upaya Kesehatan. Contoh: KIA / KB, Promkes');

            $table->unique(['unit_puskesmas_id', 'nama']);
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
        Schema::dropIfExists('sub_unit_puskesmas');
    }
}
