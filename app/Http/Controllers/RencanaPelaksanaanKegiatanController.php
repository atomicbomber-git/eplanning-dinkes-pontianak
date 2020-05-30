<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\ItemRencanaPelaksanaanKegiatan;
use App\RencanaPelaksanaanKegiatan;
use App\UnitPuskesmas;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RencanaPelaksanaanKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $rencana_pelaksanaan_kegiatan_list = RencanaPelaksanaanKegiatan::query()
            ->where("puskesmas_id", auth()->user()->puskesmas->id)
            ->orderByDesc("waktu_pembuatan")
            ->paginate();

        return response()->view("puskesmas.rencana-pelaksanaan-kegiatan.index", compact(
            "rencana_pelaksanaan_kegiatan_list"
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

        return \response()->view("puskesmas.rencana-pelaksanaan-kegiatan.create", compact(
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
        $data = collect($request->validate([
            "waktu_pembuatan" => ["required", "date"],
            "item_rencana_pelaksanaan_kegiatan_list.*.upaya_kesehatan_id" => ["required", "exists:upaya_kesehatan,id"],
            "item_rencana_pelaksanaan_kegiatan_list.*.kegiatan" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.tujuan" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.sasaran" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.target_sasaran" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.penanggung_jawab" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.volume_kegiatan" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.jadwal" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.rincian_pelaksanaan" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.lokasi_pelaksanaan" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.biaya" => ["nullable", "numeric"],
        ]));

        DB::beginTransaction();

        $rencana_pelaksanaan_kegiatan = RencanaPelaksanaanKegiatan::query()->create(
            $data->except("item_rencana_pelaksanaan_kegiatan_list")
                ->merge(["puskesmas_id" => auth()->user()->puskesmas->id])
                ->toArray()
        );

        foreach ($data["item_rencana_pelaksanaan_kegiatan_list"] as $item_rencana_pelaksanaan_kegiatan) {
            ItemRencanaPelaksanaanKegiatan::query()->create(array_merge([
                "rencana_pelaksanaan_kegiatan_id" => $rencana_pelaksanaan_kegiatan->id
            ], $item_rencana_pelaksanaan_kegiatan));
        }

        DB::commit();

        return redirect()->route("puskesmas.rencana-pelaksanaan-kegiatan.index")
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
     * @param RencanaPelaksanaanKegiatan $rencana_pelaksanaan_kegiatan
     * @return Response
     */
    public function show(RencanaPelaksanaanKegiatan $rencana_pelaksanaan_kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RencanaPelaksanaanKegiatan $rencana_pelaksanaan_kegiatan
     * @return Response
     */
    public function edit(RencanaPelaksanaanKegiatan $rencana_pelaksanaan_kegiatan)
    {
        $unit_puskesmas_list = UnitPuskesmas::query()
            ->with([
                "upaya_kesehatan_list",
                "upaya_kesehatan_list.item_rencana_pelaksanaan_kegiatan" => function (HasOne $hasOne) use ($rencana_pelaksanaan_kegiatan) {
                    $hasOne->where("rencana_pelaksanaan_kegiatan_id", $rencana_pelaksanaan_kegiatan->id);
                },
            ])
            ->get();

        return response()->view("puskesmas.rencana-pelaksanaan-kegiatan.edit", compact(
            "rencana_pelaksanaan_kegiatan",
            "unit_puskesmas_list"
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RencanaPelaksanaanKegiatan $rencana_pelaksanaan_kegiatan
     * @return RedirectResponse
     */
    public function update(Request $request, RencanaPelaksanaanKegiatan $rencana_pelaksanaan_kegiatan)
    {
        $data = collect($request->validate([
            "waktu_pembuatan" => ["required", "date"],
            "item_rencana_pelaksanaan_kegiatan_list.*.id" => ["required", "exists:item_rencana_pelaksanaan_kegiatan,id"],
            "item_rencana_pelaksanaan_kegiatan_list.*.kegiatan" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.tujuan" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.sasaran" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.target_sasaran" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.penanggung_jawab" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.volume_kegiatan" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.jadwal" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.rincian_pelaksanaan" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.lokasi_pelaksanaan" => ["nullable", "string"],
            "item_rencana_pelaksanaan_kegiatan_list.*.biaya" => ["nullable", "numeric"],
        ]));

        DB::beginTransaction();

        $rencana_pelaksanaan_kegiatan->update($data->except("item_rencana_pelaksanaan_kegiatan_list")->toArray());

        foreach ($data["item_rencana_pelaksanaan_kegiatan_list"] as $data_item_rencana_pelaksanaan_kegiatan) {
            ItemRencanaPelaksanaanKegiatan::query()
                ->where("id", $data_item_rencana_pelaksanaan_kegiatan["id"])
                ->update(collect($data_item_rencana_pelaksanaan_kegiatan)->except("id")->toArray());
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
     * @param RencanaPelaksanaanKegiatan $rencana_pelaksanaan_kegiatan
     * @return Response
     */
    public function destroy(RencanaPelaksanaanKegiatan $rencana_pelaksanaan_kegiatan)
    {
        //
    }
}
