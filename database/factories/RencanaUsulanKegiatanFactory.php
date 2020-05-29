<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RencanaUsulanKegiatan;
use Faker\Generator as Faker;

$factory->define(RencanaUsulanKegiatan::class, function (Faker $faker) {
    return [
        "waktu_pembuatan" => now()->subMinutes(rand(0, 60 * 24 * 30))
    ];
});
