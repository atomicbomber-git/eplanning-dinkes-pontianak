<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\ItemRencanaPelaksanaanKegiatanTahunan;
use App\RencanaPelaksanaanKegiatanTahunan;
use App\Support\SessionHelper;
use App\UnitPuskesmas;
use App\UpayaKesehatan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
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
            ->withTotalBiaya()
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
        $unit_puskesmases = UnitPuskesmas::query()
            ->with([
                "upaya_kesehatan_list",
            ])
            ->get();

        return response()->view("puskesmas.rpk-tahunan.create", compact(
            "unit_puskesmases"
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
            "waktu_pembuatan" => ["required", "date"],
            "tahun" => [
                "required",
                "numeric",
                Rule::unique(RencanaPelaksanaanKegiatanTahunan::class)
                    ->where("puskesmas_id", $puskesmas_id)
            ],
            "item.*.upaya_kesehatan_id" => ["required", Rule::exists(UpayaKesehatan::class, "id")],
            "item.*.kegiatan" => ["nullable", "string"],
            "item.*.tujuan" => ["nullable", "string"],
            "item.*.sasaran" => ["nullable", "string"],
            "item.*.target_sasaran" => ["nullable", "string"],
            "item.*.penanggung_jawab" => ["nullable", "string"],
            "item.*.volume_kegiatan" => ["nullable", "string"],
            "item.*.jadwal" => ["nullable", "string"],
            "item.*.rincian_pelaksanaan" => ["nullable", "string"],
            "item.*.lokasi_pelaksanaan" => ["nullable", "string"],
            "item.*.biaya" => ["nullable", "numeric", "gte:0"],
        ]);
        
        DB::beginTransaction();
        
        /** @var RencanaPelaksanaanKegiatanTahunan $rpkTahunan */
        $rpkTahunan = RencanaPelaksanaanKegiatanTahunan::query()
            ->create(array_merge(
                Arr::only($data, [
                        "waktu_pembuatan",
                        "tahun",
                    ]),

                ["puskesmas_id" => $puskesmas_id]
            ));
        
        foreach ($data["item"] as $itemData) {
            $rpkTahunan->items()->create($itemData);
        }
        
        DB::commit();
        
        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS,
        );

        return \response()->redirectToRoute("puskesmas.rpk-tahunan.index");
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
            ->with("upaya_kesehatan_list")
            ->whereHas("upaya_kesehatan_list", function (Builder $builder) use ($rpk_tahunan) {
                $builder->whereIn(
                    "id",
                    $rpk_tahunan
                        ->items()
                        ->distinct()
                        ->pluck("upaya_kesehatan_id"),
                );
            })
            ->get();

        return response()->view("puskesmas.rpk-tahunan.edit", [
             "rpk_tahunan" => $rpk_tahunan,
             "items" => $rpk_tahunan->items()
                ->get()
                ->keyBy("upaya_kesehatan_id"),
             "unit_puskesmases" => $unit_puskesmas_list
        ]);
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
     * @return RedirectResponse
     */
    public function destroy(RencanaPelaksanaanKegiatanTahunan $rpk_tahunan)
    {
        try {
            $rpk_tahunan->items()->delete();
            $rpk_tahunan->delete();

            SessionHelper::flashMessage(
                __("messages.delete.success"),
                MessageState::STATE_SUCCESS,
            );
        } catch (\Throwable $throwable) {
            SessionHelper::flashMessage(
                __("messages.delete.failure"),
                MessageState::STATE_DANGER,
            );
        }

        return back();
    }
}
