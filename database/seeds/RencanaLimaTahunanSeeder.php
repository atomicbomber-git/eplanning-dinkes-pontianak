<?php

use App\ItemRencanaLimaTahunan;
use App\Puskesmas;
use App\RencanaLimaTahunan;
use App\UpayaKesehatan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RencanaLimaTahunanSeeder extends Seeder
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

        $puskesmases = Puskesmas::query()->get();
        $upaya_kesehatan_list = UpayaKesehatan::query()
            ->orderBy("unit_puskesmas_id")
            ->get();

        foreach ($puskesmases as $puskesmas) {
            $rencana_lima_tahunan_list = factory(RencanaLimaTahunan::class, static::N_RENCANA_PER_PUSKESMAS)
                ->create([
                    "waktu_pembuatan" => Carbon::now()->subMinutes(rand(0, 60 * 24 * 30)),
                    "puskesmas_id" => $puskesmas->id,
                ]);

            foreach ($rencana_lima_tahunan_list as $rencana_lima_tahunan) {
                foreach ($upaya_kesehatan_list as $upaya_kesehatan) {
                    factory(ItemRencanaLimaTahunan::class)->create([
                        "rencana_lima_tahunan_id" => $rencana_lima_tahunan->id,
                        "upaya_kesehatan_id" => $upaya_kesehatan->id,
                    ]);
                }
            }
        }

        DB::commit();
    }
}
