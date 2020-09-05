<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RencanaUsulanKegiatan;
use Faker\Generator as Faker;

$factory->define(RencanaUsulanKegiatan::class, function (Faker $faker) {
    $index = $faker->index();
    $year = 2000 + $index;

    return [
        "tahun" => $year,
        "waktu_pembuatan" => now()
            ->addDays(rand(0, 365))
            ->setYear($year)
    ];
});
