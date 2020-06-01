<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\ItemRencanaPelaksanaanKegiatanTahunan;
use App\RencanaPelaksanaanKegiatanTahunan;
use App\UnitPuskesmas;
use App\UpayaKesehatan;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemRencanaPelaksanaanKegiatanTahunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\RencanaPelaksanaanKegiatanTahunan  $rpk_tahunan
     * @return \Illuminate\Http\Response
     */
    public function index(RencanaPelaksanaanKegiatanTahunan $rpk_tahunan)
    {
        $unit_puskesmas_list = UnitPuskesmas::query()
            ->with([
                "upaya_kesehatan_list",
                "upaya_kesehatan_list.item_rencana_pelaksanaan_kegiatan_tahunan_list" => function (HasMany $hasMany) use($rpk_tahunan) {
                    $hasMany->where("rencana_pelaksanaan_kegiatan_tahunan_id", $rpk_tahunan->id);
                }
            ])
            ->get();

        return response()->view(
            "puskesmas.rpk-tahunan.item-rpk-tahunan.index", compact(
                "rpk_tahunan",
                "unit_puskesmas_list"
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\RencanaPelaksanaanKegiatanTahunan  $rpk_tahunan
     * @return \Illuminate\Http\Response
     */
    public function create(RencanaPelaksanaanKegiatanTahunan $rpk_tahunan)
    {
        $unit_puskesmas_list = $this->getUnitPuskesmasSelectList();

        return response()->view("puskesmas.rpk-tahunan.item-rpk-tahunan.create", compact(
            "rpk_tahunan",
            "unit_puskesmas_list"
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RencanaPelaksanaanKegiatanTahunan  $rpk_tahunan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, RencanaPelaksanaanKegiatanTahunan $rpk_tahunan)
    {
        $data = $request->validate([
            "upaya_kesehatan_id" => ["required", Rule::exists(UpayaKesehatan::class, "id")],
            "kegiatan" => ["nullable", "string"],
            "tujuan" => ["nullable", "string"],
            "sasaran" => ["nullable", "string"],
            "target_sasaran" => ["nullable", "string"],
            "penanggung_jawab" => ["nullable", "string"],
            "volume_kegiatan" => ["nullable", "string"],
            "jadwal" => ["nullable", "string"],
            "rincian_pelaksanaan" => ["nullable", "string"],
            "lokasi_pelaksanaan" => ["nullable", "string"],
            "biaya" => ["nullable", "numeric", "gte:0"],
        ]);

        $rpk_tahunan->items()->create($data);

        return redirect()->route("puskesmas.rpk-tahunan.item-rpk-tahunan.index", $rpk_tahunan)
            ->with("messages", [
                [
                    "content" => __("messages.create.success"),
                    "state" => MessageState::STATE_SUCCESS
                ]
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RencanaPelaksanaanKegiatanTahunan  $rpk_tahunan
     * @param  \App\ItemRencanaPelaksanaanKegiatanTahunan  $item_rpk_tahunan
     * @return \Illuminate\Http\Response
     */
    public function show(RencanaPelaksanaanKegiatanTahunan $rpk_tahunan, ItemRencanaPelaksanaanKegiatanTahunan $item_rencana_pelaksanaan_kegiatan_tahunan)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RencanaPelaksanaanKegiatanTahunan  $rpk_tahunan
     * @param  \App\ItemRencanaPelaksanaanKegiatanTahunan  $item_rpk_tahunan
     * @return \Illuminate\Http\Response
     */
    public function edit(RencanaPelaksanaanKegiatanTahunan $rpk_tahunan, ItemRencanaPelaksanaanKegiatanTahunan $item_rpk_tahunan)
    {
        $unit_puskesmas_list = $this->getUnitPuskesmasSelectList();

        return response()->view("puskesmas.rpk-tahunan.item-rpk-tahunan.edit", compact(
            "item_rpk_tahunan",
            "unit_puskesmas_list"
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RencanaPelaksanaanKegiatanTahunan  $rpk_tahunan
     * @param  \App\ItemRencanaPelaksanaanKegiatanTahunan  $item_rpk_tahunan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, RencanaPelaksanaanKegiatanTahunan $rpk_tahunan, ItemRencanaPelaksanaanKegiatanTahunan $item_rpk_tahunan)
    {
        $data = $request->validate([
            "kegiatan" => ["nullable", "string"],
            "tujuan" => ["nullable", "string"],
            "sasaran" => ["nullable", "string"],
            "target_sasaran" => ["nullable", "string"],
            "penanggung_jawab" => ["nullable", "string"],
            "volume_kegiatan" => ["nullable", "string"],
            "jadwal" => ["nullable", "string"],
            "rincian_pelaksanaan" => ["nullable", "string"],
            "lokasi_pelaksanaan" => ["nullable", "string"],
            "biaya" => ["nullable", "numeric", "gte:0"],
        ]);

        $item_rpk_tahunan->update($data);

        return redirect()->back()
            ->with("messages", [
                [
                    "content" => __("messages.update.success"),
                    "state" => MessageState::STATE_SUCCESS
                ]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RencanaPelaksanaanKegiatanTahunan  $rpk_tahunan
     * @param  \App\ItemRencanaPelaksanaanKegiatanTahunan  $item_rpk_tahunan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(RencanaPelaksanaanKegiatanTahunan $rpk_tahunan, ItemRencanaPelaksanaanKegiatanTahunan $item_rpk_tahunan)
    {
        $item_rpk_tahunan->forceDelete();

        return redirect()->back()
            ->with("messages", [
                [
                    "content" => __("messages.delete.success"),
                    "state" => MessageState::STATE_SUCCESS
                ]
            ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private function getUnitPuskesmasSelectList()
    {
        $unit_puskesmas_list = UnitPuskesmas::query()
            ->select("id", "nama")
            ->with([
                "upaya_kesehatan_list:id,nama,unit_puskesmas_id"
            ])
            ->get();
        return $unit_puskesmas_list;
    }
}
