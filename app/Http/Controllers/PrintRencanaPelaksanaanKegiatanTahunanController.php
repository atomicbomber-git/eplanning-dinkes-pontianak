<?php

namespace App\Http\Controllers;

use App\ItemRencanaPelaksanaanKegiatanTahunan;
use App\RencanaPelaksanaanKegiatanTahunan;
use App\UnitPuskesmas;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class PrintRencanaPelaksanaanKegiatanTahunanController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, RencanaPelaksanaanKegiatanTahunan $rpk_tahunan)
    {
        $unit_puskesmas_list = UnitPuskesmas::query()
            ->whereHas("upaya_kesehatan_list", function (Builder $builder) use($rpk_tahunan) {
                $builder->whereHas("item_rencana_pelaksanaan_kegiatan_tahunan_list", function (Builder $builder) use($rpk_tahunan) {
                    $builder->where("rencana_pelaksanaan_kegiatan_tahunan_id", $rpk_tahunan->id);
                });
            })
            ->with([
                "upaya_kesehatan_list",
                "upaya_kesehatan_list.item_rencana_pelaksanaan_kegiatan_tahunan_list" => function (HasMany $hasMany) use($rpk_tahunan) {
                    $hasMany->where("rencana_pelaksanaan_kegiatan_tahunan_id", $rpk_tahunan->id);
                }
            ])
            ->get();

        $biaya_sum = ItemRencanaPelaksanaanKegiatanTahunan::query()
            ->where("rencana_pelaksanaan_kegiatan_tahunan_id", $rpk_tahunan->id)
            ->sum("biaya");

        return response()->view("puskesmas.print-rpk-tahunan.show", compact(
            "rpk_tahunan",
            "unit_puskesmas_list",
            "biaya_sum"
        ));
    }
}
