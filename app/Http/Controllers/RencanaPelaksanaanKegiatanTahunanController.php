<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\ItemRencanaPelaksanaanKegiatanTahunan;
use App\RencanaPelaksanaanKegiatanTahunan;
use App\UnitPuskesmas;
use App\UpayaKesehatan;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RencanaPelaksanaanKegiatanTahunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $rencana_pelaksanaan_kegiatan_tahunan_list = RencanaPelaksanaanKegiatanTahunan::query()
            ->where("puskesmas_id", auth()->user()->puskesmas->id)
            ->orderByDesc("tahun")
            ->paginate();

        return response()->view("puskesmas.rpk-tahunan.index", compact(
            "rencana_pelaksanaan_kegiatan_tahunan_list"
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $unit_puskesmas_list = UnitPuskesmas::query()
            ->with([
                "upaya_kesehatan_list",
            ])
            ->get();

        return \response()->view("puskesmas.rpk-tahunan.create", compact(
            "unit_puskesmas_list"
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $puskesmas_id = auth()->user()->puskesmas->id;

        $data = $request->validate([
            "tahun" => [
                "required",
                "numeric",
                Rule::unique(RencanaPelaksanaanKegiatanTahunan::class)
                    ->where("puskesmas_id", $puskesmas_id)
            ]
        ]);

        $rpk_tahunan = RencanaPelaksanaanKegiatanTahunan::query()->create(array_merge($data, [
            "puskesmas_id" => $puskesmas_id
        ]));

        return redirect()->route(
            "puskesmas.rpk-tahunan.item-rpk-tahunan.index",
            $rpk_tahunan
        )->with("messages", [
            [
                "content" => __("messages.delete.success"),
                "state" => MessageState::STATE_SUCCESS
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param RencanaPelaksanaanKegiatanTahunan $rpk_tahunan
     * @return Response
     */
    public function show(RencanaPelaksanaanKegiatanTahunan $rpk_tahunan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RencanaPelaksanaanKegiatanTahunan $rpk_tahunan
     * @return Response
     */
    public function edit(RencanaPelaksanaanKegiatanTahunan $rpk_tahunan)
    {
        $unit_puskesmas_list = UnitPuskesmas::query()
            ->with([
                "upaya_kesehatan_list",
                "upaya_kesehatan_list.item_rencana_pelaksanaan_kegiatan_tahunan" => function (HasOne $hasOne) use ($rpk_tahunan) {
                    $hasOne->where("rencana_pelaksanaan_kegiatan_tahunan_id", $rpk_tahunan->id);
                },
            ])
            ->get();

        return response()->view("puskesmas.rpk-tahunan.edit", compact(
            "rpk_tahunan",
            "unit_puskesmas_list"
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RencanaPelaksanaanKegiatanTahunan $rpk_tahunan
     * @return RedirectResponse
     */
    public function update(Request $request, RencanaPelaksanaanKegiatanTahunan $rpk_tahunan)
    {
        $puskesmas_id = auth()->user()->puskesmas->id;

        $data = collect($request->validate([
            "tahun" => [
                "required",
                "numeric",
                Rule::unique(RencanaPelaksanaanKegiatanTahunan::class)
                    ->ignoreModel($rpk_tahunan)
                    ->where("puskesmas_id", $puskesmas_id)
            ]
        ]));

        DB::beginTransaction();

        $rpk_tahunan->update($data->except("item_rencana_pelaksanaan_kegiatan_tahunan_list")->toArray());

        foreach ($data["item_rencana_pelaksanaan_kegiatan_tahunan_list"] as $data_item_rencana_pelaksanaan_kegiatan_tahunan) {
            ItemRencanaPelaksanaanKegiatanTahunan::query()
                ->where("id", $data_item_rencana_pelaksanaan_kegiatan_tahunan["id"])
                ->update(collect($data_item_rencana_pelaksanaan_kegiatan_tahunan)->except("id")->toArray());
        }

        DB::commit();

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
     * @param RencanaPelaksanaanKegiatanTahunan $rpk_tahunan
     * @return Response
     */
    public function destroy(RencanaPelaksanaanKegiatanTahunan $rpk_tahunan)
    {
        //
    }
}
