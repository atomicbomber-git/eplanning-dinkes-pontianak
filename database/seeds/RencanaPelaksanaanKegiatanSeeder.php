<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RencanaPelaksanaanKegiatanSeeder extends Seeder
{
    const N_RENCANA_PER_PUSKESMAS = 30;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $puskesmases = \App\Puskesmas::query()->get();
        $upaya_kesehatan_list = \App\UpayaKesehatan::query()
            ->orderBy("unit_puskesmas_id")
            ->get();

        foreach ($puskesmases as $puskesmas) {
            $rencana_pelaksanaan_kegiatan_list = factory(\App\RencanaPelaksanaanKegiatan::class, static::N_RENCANA_PER_PUSKESMAS)
                ->create([
                    "puskesmas_id" => $puskesmas->id,
                ]);

            foreach ($rencana_pelaksanaan_kegiatan_list as $rencana_pelaksanaan_kegiatan) {
                foreach ($upaya_kesehatan_list as $upaya_kesehatan) {
                    factory(\App\ItemRencanaPelaksanaanKegiatan::class)->create([
                        "rencana_pelaksanaan_kegiatan_id" => $rencana_pelaksanaan_kegiatan->id,
                        "upaya_kesehatan_id" => $upaya_kesehatan->id,
                    ]);
                }
            }
        }

        DB::commit();
    }
}
