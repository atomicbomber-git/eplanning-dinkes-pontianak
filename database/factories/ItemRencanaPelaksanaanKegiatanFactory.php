<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ItemRencanaPelaksanaanKegiatanFactory;
use Faker\Generator as Faker;

$factory->define(\App\ItemRencanaPelaksanaanKegiatan::class, function (Faker $faker) {
    return [
        'kegiatan' => $faker->sentence,
        'tujuan' => $faker->sentence,
        'sasaran' => $faker->sentence,
        'target_sasaran' => $faker->sentence,
        'penanggung_jawab' => $faker->sentence,
        'volume_kegiatan' => $faker->sentence,
        'jadwal' => $faker->sentence,
        'rincian_pelaksanaan' => $faker->sentence,
        'lokasi_pelaksanaan' => $faker->sentence,
        'biaya' => rand(10, 100) * 500000,
    ];
});
