<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Providers\AuthServiceProvider;
use App\RencanaPelaksanaanKegiatanTahunan ;
use App\Support\SessionHelper;
use App\UnitPuskesmas;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RpkTahunanForAdminController extends Controller
{
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize(AuthServiceProvider::APPROVE_RPK_TAHUNAN);
        return $this->responseFactory->view("rpk-tahunan-for-admin.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RencanaPelaksanaanKegiatanTahunan  $rpkTahunan
     * @return \Illuminate\Http\Response
     */
    public function edit(RencanaPelaksanaanKegiatanTahunan $rpkTahunan)
    {
        return $this->responseFactory->view("rpk-tahunan-for-admin.edit", [
            "rpk_tahunan" => $rpkTahunan,
            "items" => $rpkTahunan->items()
                ->get()
                ->keyBy("upaya_kesehatan_id"),
            "unit_puskesmases" => UnitPuskesmas::query()
                ->with("upaya_kesehatan_list")
                ->whereHas("upaya_kesehatan_list", function (Builder $builder) use ($rpkTahunan) {
                    $builder->whereIn(
                        "id",
                        $rpkTahunan
                            ->items()
                            ->distinct()
                            ->pluck("upaya_kesehatan_id"),
                    );
                })
                ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RencanaPelaksanaanKegiatanTahunan  $rpkTahunan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, RencanaPelaksanaanKegiatanTahunan $rpkTahunan)
    {
        $data = $request->validate([
            "diterima" => ["required", "boolean"]
        ]);

        $rpkTahunan->update([
            "waktu_penerimaan" =>
                $data["diterima"] ?
                    now() : null,
        ]);

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory->redirectToRoute("rpk-tahunan-for-admin.edit", $rpkTahunan);
    }
}
