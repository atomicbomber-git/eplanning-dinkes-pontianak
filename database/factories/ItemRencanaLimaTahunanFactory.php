<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ItemRencanaLimaTahunan;
use Faker\Generator as Faker;

$factory->define(ItemRencanaLimaTahunan::class, function (Faker $faker) {
    return [
        "tujuan" => $faker->paragraph,
        "indikator_kinerja" => $faker->paragraph,
        "cara_perhitungan" => $faker->paragraph,
        "target_tahun_1" => rand(0, 100),
        "target_tahun_2" => rand(0, 100),
        "target_tahun_3" => rand(0, 100),
        "target_tahun_4" => rand(0, 100),
        "target_tahun_5" => rand(0, 100),
        "rincian_kegiatan" => $faker->paragraph,
        "kebutuhan_anggaran" => rand(10, 100) * 500000,
    ];
});
