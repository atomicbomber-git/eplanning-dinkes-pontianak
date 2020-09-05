<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\ItemRencanaUsulanKegiatan;
use App\Providers\AuthServiceProvider;
use App\RencanaUsulanKegiatan;
use App\UnitPuskesmas;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RencanaUsulanKegiatanController extends Controller
{
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->authorize(AuthServiceProvider::MANAGE_RENCANA_USULAN_KEGIATAN);

        $rencana_usulan_kegiatan_list = RencanaUsulanKegiatan::query()
            ->where("puskesmas_id", auth()->user()->puskesmas->id)
            ->orderByDesc("tahun")
            ->paginate();

        return response()->view("puskesmas.rencana-usulan-kegiatan.index", compact(
            "rencana_usulan_kegiatan_list"
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

        return response()->view("puskesmas.rencana-usulan-kegiatan.create", compact(
            "unit_puskesmas_list"
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "waktu_pembuatan" => ["required", "date"],
            "tahun" => [
                "required",
                "integer",
                "gte:0",
                Rule::unique(RencanaUsulanKegiatan::class)
                    ->where("puskesmas_id", auth()->user()->puskesmas->id)
            ],
            "item_rencana_usulan_kegiatan_list.*.upaya_kesehatan_id" => ["required", "exists:upaya_kesehatan,id"],
            "item_rencana_usulan_kegiatan_list.*.kegiatan" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.tujuan" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.sasaran" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.target_sasaran" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.penanggung_jawab" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.kebutuhan_sumber_daya" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.mitra_kerja" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.waktu_pelaksanaan" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.kebutuhan_anggaran" => ["required", "numeric", "gte:0"],
            "item_rencana_usulan_kegiatan_list.*.indikator_kinerja" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.sumber_pembiayaan" => ["nullable", "string"],
        ]);

        DB::beginTransaction();

        $rencana_usulan_kegiatan = RencanaUsulanKegiatan::query()->create([
            "tahun" => $data["tahun"],
            "puskesmas_id" => auth()->user()->puskesmas->id,
            "waktu_pembuatan" => $data["waktu_pembuatan"],
        ]);

        foreach ($data["item_rencana_usulan_kegiatan_list"] as $data_item_rencana_usulan_kegiatan) {
            ItemRencanaUsulanKegiatan::query()
                ->create(array_merge($data_item_rencana_usulan_kegiatan, [
                    "rencana_usulan_kegiatan_id" => $rencana_usulan_kegiatan->id,
                ]));
        }

        DB::commit();

        return redirect()->route("puskesmas.rencana-usulan-kegiatan.index")
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
     * @param RencanaUsulanKegiatan $rencana_usulan_kegiatan
     *
     * @return Response
     */
    public function show(RencanaUsulanKegiatan $rencana_usulan_kegiatan)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RencanaUsulanKegiatan $rencana_usulan_kegiatan
     *
     * @return Response
     */
    public function edit(RencanaUsulanKegiatan $rencana_usulan_kegiatan
    )
    {
        $unit_puskesmas_list = UnitPuskesmas::query()
            ->with([
                "upaya_kesehatan_list",
                "upaya_kesehatan_list.item_rencana_usulan_kegiatan" => function (HasOne $hasOne) use($rencana_usulan_kegiatan) {
                    $hasOne->where("rencana_usulan_kegiatan_id", $rencana_usulan_kegiatan->id);
                },
            ])
            ->get();

        return response()->view("puskesmas.rencana-usulan-kegiatan.edit", compact(
            "rencana_usulan_kegiatan",
            "unit_puskesmas_list"
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RencanaUsulanKegiatan $rencana_usulan_kegiatan
     *
     * @return RedirectResponse|Response
     */
    public function update(Request $request, RencanaUsulanKegiatan $rencana_usulan_kegiatan
    )
    {
        $data = $request->validate([
            "waktu_pembuatan" => ["required", "date"],
            "tahun" => [
                "required",
                "integer",
                "gte:0",
                Rule::unique(RencanaUsulanKegiatan::class)
                    ->where("puskesmas_id", auth()->user()->puskesmas->id)
                    ->ignoreModel($rencana_usulan_kegiatan)
            ],
            "item_rencana_usulan_kegiatan_list.*.id" => ["required", "exists:item_rencana_usulan_kegiatan,id"],
            "item_rencana_usulan_kegiatan_list.*.kegiatan" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.tujuan" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.sasaran" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.target_sasaran" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.penanggung_jawab" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.kebutuhan_sumber_daya" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.mitra_kerja" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.waktu_pelaksanaan" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.kebutuhan_anggaran" => ["required", "numeric", "gte:0"],
            "item_rencana_usulan_kegiatan_list.*.indikator_kinerja" => ["nullable", "string"],
            "item_rencana_usulan_kegiatan_list.*.sumber_pembiayaan" => ["nullable", "string"],
        ]);

        DB::beginTransaction();

        $rencana_usulan_kegiatan->update([
            "tahun" => $data["tahun"],
            "waktu_pembuatan" => $data["waktu_pembuatan"],
        ]);

        foreach ($data["item_rencana_usulan_kegiatan_list"] as $data_item_rencana_usulan_kegiatan) {
            ItemRencanaUsulanKegiatan::query()
                ->where("id", $data_item_rencana_usulan_kegiatan["id"])
                ->update(
                    collect($data_item_rencana_usulan_kegiatan)->except("id")->toArray()
                );
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
     * @param RencanaUsulanKegiatan $rencana_usulan_kegiatan
     *
     * @return Response
     */
    public function destroy(RencanaUsulanKegiatan $rencana_usulan_kegiatan
    )
    {
        $rencana_usulan_kegiatan->forceDelete();

        return redirect()->back()
            ->with("messages", [
                [
                    "content" => __("messages.delete.success"),
                    "state" => MessageState::STATE_SUCCESS
                ]
            ]);
    }
}
