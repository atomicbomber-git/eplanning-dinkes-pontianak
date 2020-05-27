<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitPuskesmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_puskesmas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')
                ->unique()
                ->comment("Nama unit puskesmas. Contoh: UKM Esensial, UKM Pengembangan, dst.");
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
        Schema::dropIfExists('unit_puskesmas');
    }
}
