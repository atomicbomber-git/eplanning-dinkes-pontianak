<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ItemRencanaUsulanKegiatan;
use Faker\Generator as Faker;

$factory->define(ItemRencanaUsulanKegiatan::class, function (Faker $faker) {
    return [
        'kegiatan' => $faker->sentence,
        'tujuan' => $faker->sentence,
        'sasaran' => $faker->sentence,
        'target_sasaran' => $faker->sentence,
        'penanggung_jawab' => $faker->sentence,
        'kebutuhan_sumber_daya' => $faker->sentence,
        'mitra_kerja' => $faker->sentence,
        'waktu_pelaksanaan' => $faker->sentence,
        "kebutuhan_anggaran" => rand(10, 100) * 500000,
        'indikator_kinerja' => $faker->sentence,
        'sumber_pembiayaan' => $faker->company,
    ];
});
