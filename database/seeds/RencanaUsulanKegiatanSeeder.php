<?php

use App\ItemRencanaUsulanKegiatan;
use App\Puskesmas;
use App\RencanaUsulanKegiatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RencanaUsulanKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $puskesmas_list = Puskesmas::query()->get();
        $rencana_usulan_kegiatan_list = [];

        foreach ($puskesmas_list as $puskesmas) {
             $rencana_usulan_kegiatan_list[] = factory(RencanaUsulanKegiatan::class)
                ->create([
                    "puskesmas_id" => $puskesmas->id,
                ]);
        }

        $upaya_kesehatan_list = \App\UpayaKesehatan::query()->get();

        foreach ($rencana_usulan_kegiatan_list as $rencana_usulan_kegiatan) {
            foreach ($upaya_kesehatan_list as $upaya_kesehatan) {
                factory(ItemRencanaUsulanKegiatan::class)
                    ->create([
                        "upaya_kesehatan_id" => $upaya_kesehatan->id,
                        "rencana_usulan_kegiatan_id" => $rencana_usulan_kegiatan->id,
                    ]);
            }
        }

        DB::commit();
    }
}
