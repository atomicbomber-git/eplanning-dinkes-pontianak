<?php

use App\UpayaKesehatan;
use App\UnitPuskesmas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitPuskesmasSeeder extends Seeder
{
    const DATA = [
      "UKM ESENSIAL" => ["KIA & KB", "Promkes", "Kesling", "Pencegahan dan Pengendalian Penyakit"],
      "UKM PENGEMBANGAN" => ["Kestrad"],
      "UKP" => ["Rawat Jalan"],
      "PELAYANAN KEFARMASIAN" => ["Dst"],
      "PELAYANAN PERKESMAS" => ["Dst"],
      "PELAYANAN LABORATORIUM" => ["Dst"],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        foreach (static::DATA as $unit_puskesmas_name => $subunit_puskesmas_list) {
            $unit_puskesmas = UnitPuskesmas::query()->create([
                "nama" => $unit_puskesmas_name,
            ]);

            foreach ($subunit_puskesmas_list as $subunit_puskesmas_name) {
                UpayaKesehatan::query()->create([
                    "unit_puskesmas_id" => $unit_puskesmas->id,
                    "nama" => $subunit_puskesmas_name,
                ]);
            }
        }

        DB::commit();
    }
}
