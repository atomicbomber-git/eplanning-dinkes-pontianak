<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\ItemRencanaLimaTahunan;
use App\Providers\AuthServiceProvider;
use App\RencanaLimaTahunan;
use App\Support\SessionHelper;
use App\UnitPuskesmas;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Rule;

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
        $this->authorize(AuthServiceProvider::VIEW_OWN_RENCANA_LIMA_TAHUNAN);

        $rencana_lima_tahunan_list = RencanaLimaTahunan::query()
            ->where("puskesmas_id", auth()->user()->puskesmas->id)
            ->orderByDesc("tahun_awal_periode")
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
        $this->authorize(AuthServiceProvider::CREATE_RENCANA_LIMA_TAHUNAN);

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
        $data = ValidatorFacade::make($request->all(), [
            "waktu_pembuatan" => ["required", "date"],
            "tahun_awal_periode" => ["required", "numeric", "gte:0"],
            "tahun_akhir_periode" => ["required", "numeric", "gte:tahun_awal_periode"],
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
        ])->after(function (Validator $validator) {
            $data = $validator->validated();

            if ($data["tahun_akhir_periode"] - $data["tahun_awal_periode"] !== 4) {
                $validator->errors()->add(
                    "tahun_awal_periode",
                    "panjang periode wajib 5 (lima) tahun."
                );
            }

            $count = RencanaLimaTahunan::query()
                ->whereRaw(
                    "
                            (? > tahun_awal_periode AND ? < tahun_akhir_periode) OR
                            (? > tahun_awal_periode AND ? < tahun_akhir_periode) OR
                            (tahun_awal_periode > ? AND tahun_awal_periode < ?) OR
                            (tahun_akhir_periode > ? AND tahun_akhir_periode < ?)
                        ", [
                    $data["tahun_awal_periode"], $data["tahun_awal_periode"],
                    $data["tahun_akhir_periode"], $data["tahun_akhir_periode"],
                    $data["tahun_awal_periode"], $data["tahun_akhir_periode"],
                    $data["tahun_awal_periode"], $data["tahun_akhir_periode"],
                ])
                ->count();

            if ($count > 0) {
                $validator->errors()->add(
                    "tahun_awal_periode",
                    "Telah terdapat RLT yang mencakup periode ini."
                );
            }
        })->validate();

        DB::beginTransaction();

        $rencana_lima_tahunan = RencanaLimaTahunan::query()->create([
            "tahun_awal_periode" => $data["tahun_awal_periode"],
            "tahun_akhir_periode" => $data["tahun_akhir_periode"],
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
        $this->authorize(AuthServiceProvider::CREATE_RENCANA_LIMA_TAHUNAN);

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
        $data = ValidatorFacade::make($request->all(), [
            "waktu_pembuatan" => ["required", "date"],
            "tahun_awal_periode" => ["required", "numeric", "gte:0"],
            "tahun_akhir_periode" => ["required", "numeric", "gte:tahun_awal_periode"],

            "item_rencana_lima_tahunan_list.*.id" => ["nullable", Rule::exists(ItemRencanaLimaTahunan::class, "id")],
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
        ])->after(function (Validator $validator) {
            $data = $validator->validated();

            if ($data["tahun_akhir_periode"] - $data["tahun_awal_periode"] !== 4) {
                $validator->errors()->add(
                    "tahun_awal_periode",
                    "panjang periode wajib 5 (lima) tahun."
                );
            }

            $count = RencanaLimaTahunan::query()
                ->whereRaw(
                    "
                            (? > tahun_awal_periode AND ? < tahun_akhir_periode) OR
                            (? > tahun_awal_periode AND ? < tahun_akhir_periode) OR
                            (tahun_awal_periode > ? AND tahun_awal_periode < ?) OR
                            (tahun_akhir_periode > ? AND tahun_akhir_periode < ?) AND
                            NOT (tahun_awal_periode = ? AND tahun_akhir_periode = ?)
                        ", [
                    $data["tahun_awal_periode"], $data["tahun_awal_periode"],
                    $data["tahun_akhir_periode"], $data["tahun_akhir_periode"],
                    $data["tahun_awal_periode"], $data["tahun_akhir_periode"],
                    $data["tahun_awal_periode"], $data["tahun_akhir_periode"],
                    $data["tahun_awal_periode"], $data["tahun_akhir_periode"],
                ])
                ->count();

            if ($count > 0) {
                $validator->errors()->add(
                    "tahun_awal_periode",
                    "Telah terdapat RLT yang mencakup periode ini."
                );
            }
        })->validate();

        DB::beginTransaction();

        $rencana_lima_tahunan->update([
            "tahun_awal_periode" => $data["tahun_awal_periode"],
            "tahun_akhir_periode" => $data["tahun_akhir_periode"],
            "waktu_pembuatan" => $data["waktu_pembuatan"],
        ]);

        foreach ($data["item_rencana_lima_tahunan_list"] as $data_item_rencana_lima_tahunan) {
            ItemRencanaLimaTahunan::query()->where([
                "id" => $data_item_rencana_lima_tahunan["id"],
            ])->update(collect($data_item_rencana_lima_tahunan)->except(["id"])->toArray());
        }

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return redirect()->back();
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
