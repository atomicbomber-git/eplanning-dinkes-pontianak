<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RencanaLimaTahunan;
use Faker\Generator as Faker;

$factory->define(RencanaLimaTahunan::class, function (Faker $faker) {
    $index = $faker->index();

    return [
        "waktu_pembuatan" => \Carbon\Carbon::now()
            ->subMinutes(rand(0, 60 * 24 * 30))
            ->setYear(1990 + ($index + 0) * 4)
        ,
        "tahun_awal_periode" => 1990 + ($index + 0) * 4,
        "tahun_akhir_periode" => 1990 + ($index + 1) * 4,
    ];
});
