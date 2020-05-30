<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RencanaPelaksanaanKegiatan;
use Faker\Generator as Faker;

$factory->define(RencanaPelaksanaanKegiatan::class, function (Faker $faker) {
    return [
        "waktu_pembuatan" => \Carbon\Carbon::now()->subMinutes(rand(0, 60 * 24 * 30)),
    ];
});
