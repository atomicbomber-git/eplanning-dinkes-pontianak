<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(PuskesmasSeeder::class);
         $this->call(UnitPuskesmasSeeder::class);
         $this->call(RencanaLimaTahunanSeeder::class);
         $this->call(RencanaUsulanKegiatanSeeder::class);
         $this->call(RencanaPelaksanaanKegiatanTahunanSeeder::class);
    }
}
