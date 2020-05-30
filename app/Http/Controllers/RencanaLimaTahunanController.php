<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\ItemRencanaLimaTahunan;
use App\RencanaLimaTahunan;
use App\UnitPuskesmas;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RencanaLimaTahunanController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            "auth"
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $rencana_lima_tahunan_list = RencanaLimaTahunan::query()
            ->where("puskesmas_id", auth()->user()->puskesmas->id)
            ->orderByDesc("waktu_pembuatan")
            ->paginate();

        return response()->view("puskesmas.rencana-lima-tahunan.index", compact(
            "rencana_lima_tahunan_list"
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

        return response()->view("puskesmas.rencana-lima-tahunan.create", compact(
            "unit_puskesmas_list"
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "waktu_pembuatan" => ["required", "date"],
            "item_rencana_lima_tahunan_list.*.upaya_kesehatan_id" => ["required", "exists:upaya_kesehatan,id"],
            "item_rencana_lima_tahunan_list.*.tujuan" => ["nullable", "string"],
            "item_rencana_lima_tahunan_list.*.indikator_kinerja" => ["nullable", "string"],
            "item_rencana_lima_tahunan_list.*.cara_perhitungan" => ["nullable", "string"],
            "item_rencana_lima_tahunan_list.*.target_tahun_1" => ["nullable", "numeric", "gte:0", "lte:100"],
            "item_rencana_lima_tahunan_list.*.target_tahun_2" => ["nullable", "numeric", "gte:0", "lte:100"],
            "item_rencana_lima_tahunan_list.*.target_tahun_3" => ["nullable", "numeric", "gte:0", "lte:100"],
            "item_rencana_lima_tahunan_list.*.target_tahun_4" => ["nullable", "numeric", "gte:0", "lte:100"],
            "item_rencana_lima_tahunan_list.*.target_tahun_5" => ["nullable", "numeric", "gte:0", "lte:100"],
            "item_rencana_lima_tahunan_list.*.rincian_kegiatan" => ["nullable", "string"],
            "item_rencana_lima_tahunan_list.*.kebutuhan_anggaran" => ["nullable", "string"],
        ]);

        $rencana_lima_tahunan = RencanaLimaTahunan::query()->create([
            "puskesmas_id" => auth()->user()->puskesmas->id,
            "waktu_pembuatan" => $data["waktu_pembuatan"],
        ]);

        foreach ($data["item_rencana_lima_tahunan_list"] as $data_item_rencana_lima_tahunan) {
            ItemRencanaLimaTahunan::query()->create(array_merge($data_item_rencana_lima_tahunan, [
                "rencana_lima_tahunan_id" => $rencana_lima_tahunan->id,
            ]));
        }

        DB::commit();

        return redirect()->route("puskesmas.rencana-lima-tahunan.index")
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
     * @param RencanaLimaTahunan $rencana_lima_tahunan
     * @return Response
     */
    public function show(RencanaLimaTahunan $rencana_lima_tahunan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RencanaLimaTahunan $rencana_lima_tahunan
     * @return Response
     */
    public function edit(RencanaLimaTahunan $rencana_lima_tahunan)
    {
        $rencana_lima_tahunan->load([
            "item_rencana_lima_tahunan_list",
            "item_rencana_lima_tahunan_list.upaya_kesehatan:id,nama,unit_puskesmas_id",
        ]);

        $unit_puskesmas_list = UnitPuskesmas::query()
            ->with([
                "upaya_kesehatan_list",
                "upaya_kesehatan_list.item_rencana_lima_tahunan" => function (HasOne $hasOne) use ($rencana_lima_tahunan) {
                    $hasOne->where("rencana_lima_tahunan_id", $rencana_lima_tahunan->id);
                },
            ])
            ->get();

        return response()->view("puskesmas.rencana-lima-tahunan.edit", compact(
            "rencana_lima_tahunan",
            "unit_puskesmas_list"
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RencanaLimaTahunan $rencana_lima_tahunan
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function update(Request $request, RencanaLimaTahunan $rencana_lima_tahunan)
    {
        $data = $request->validate([
            "waktu_pembuatan" => ["required", "date"],
            "item_rencana_lima_tahunan_list.*.id" => ["required"],
            "item_rencana_lima_tahunan_list.*.tujuan" => ["nullable", "string"],
            "item_rencana_lima_tahunan_list.*.indikator_kinerja" => ["nullable", "string"],
            "item_rencana_lima_tahunan_list.*.cara_perhitungan" => ["nullable", "string"],
            "item_rencana_lima_tahunan_list.*.target_tahun_1" => ["nullable", "numeric", "gte:0", "lte:100"],
            "item_rencana_lima_tahunan_list.*.target_tahun_2" => ["nullable", "numeric", "gte:0", "lte:100"],
            "item_rencana_lima_tahunan_list.*.target_tahun_3" => ["nullable", "numeric", "gte:0", "lte:100"],
            "item_rencana_lima_tahunan_list.*.target_tahun_4" => ["nullable", "numeric", "gte:0", "lte:100"],
            "item_rencana_lima_tahunan_list.*.target_tahun_5" => ["nullable", "numeric", "gte:0", "lte:100"],
            "item_rencana_lima_tahunan_list.*.rincian_kegiatan" => ["nullable", "string"],
            "item_rencana_lima_tahunan_list.*.kebutuhan_anggaran" => ["nullable", "string"],
        ]);

        DB::beginTransaction();

        $rencana_lima_tahunan->update([
            "waktu_pembuatan" => $data["waktu_pembuatan"],
        ]);

        foreach ($data["item_rencana_lima_tahunan_list"] as $data_item_rencana_lima_tahunan) {
            ItemRencanaLimaTahunan::query()->where([
                "id" => $data_item_rencana_lima_tahunan["id"],
            ])->update(collect($data_item_rencana_lima_tahunan)->except(["id"])->toArray());
        }

        DB::commit();

        return redirect()->back()
            ->with("messages", [
                [
                    "content" => __("messages.create.success"),
                    "state" => MessageState::STATE_SUCCESS
                ]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RencanaLimaTahunan $rencana_lima_tahunan
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function destroy(RencanaLimaTahunan $rencana_lima_tahunan)
    {
        $rencana_lima_tahunan->forceDelete();

        return redirect()->back()
            ->with("messages", [
                [
                    "content" => __("messages.delete.success"),
                    "state" => MessageState::STATE_SUCCESS
                ]
            ]);
    }
}
