<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RencanaPelaksanaanKegiatanTahunanSeeder extends Seeder
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
            $rencana_pelaksanaan_kegiatan_tahunan_list = factory(\App\RencanaPelaksanaanKegiatanTahunan::class, static::N_RENCANA_PER_PUSKESMAS)
                ->make([
                    "puskesmas_id" => $puskesmas->id,
                ])->each(function (\App\RencanaPelaksanaanKegiatanTahunan $rencana_pelaksanaan_kegiatan_tahunan, $index) {
                    $rencana_pelaksanaan_kegiatan_tahunan->forceFill([
                        "tahun" => now()->subYears($index)->format("Y")
                    ])->save();
                });

            foreach ($rencana_pelaksanaan_kegiatan_tahunan_list as $rencana_pelaksanaan_kegiatan_tahunan) {
                foreach ($upaya_kesehatan_list as $upaya_kesehatan) {
                    factory(\App\ItemRencanaPelaksanaanKegiatanTahunan::class, rand(1, 5))->create([
                        "rencana_pelaksanaan_kegiatan_tahunan_id" => $rencana_pelaksanaan_kegiatan_tahunan->id,
                        "upaya_kesehatan_id" => $upaya_kesehatan->id,
                    ]);
                }
            }
        }

        DB::commit();
    }
}
