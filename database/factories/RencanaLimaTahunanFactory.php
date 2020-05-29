<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RencanaLimaTahunan;
use Faker\Generator as Faker;

$factory->define(RencanaLimaTahunan::class, function (Faker $faker) {
    return [
        "waktu_pembuatan" => \Carbon\Carbon::now()->subMinutes(rand(0, 60 * 24 * 30)),
    ];
});
