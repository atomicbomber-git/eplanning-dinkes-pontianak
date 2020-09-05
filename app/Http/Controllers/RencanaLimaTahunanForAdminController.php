<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Providers\AuthServiceProvider;
use App\RencanaLimaTahunan;
use App\Support\SessionHelper;
use App\UnitPuskesmas;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RencanaLimaTahunanForAdminController extends Controller
{
    private ResponseFactory $responseFactory;

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
        $this->authorize(AuthServiceProvider::VIEW_ANY_RENCANA_LIMA_TAHUNAN);
        return $this->responseFactory->view("rencana-lima-tahunan-for-admin.index");
    }

    /**
     * Display the specified resource.
     *
     * @param RencanaLimaTahunan $rencanaLimaTahunan
     * @return Response
     */
    public function edit(RencanaLimaTahunan $rencanaLimaTahunan)
    {
        $unit_puskesmas_list = UnitPuskesmas::query()
            ->with("upaya_kesehatan_list")
            ->whereHas("upaya_kesehatan_list", function (Builder $builder) use ($rencanaLimaTahunan) {
                $builder->whereIn(
                    "id",
                    $rencanaLimaTahunan
                        ->items()
                        ->distinct()
                        ->pluck("upaya_kesehatan_id"),
                );
            })
            ->get();

        return $this->responseFactory->view("rencana-lima-tahunan-for-admin.edit", [
            "rencana_lima_tahunan" => $rencanaLimaTahunan,
            "item_rencana_lima_tahunan" => $rencanaLimaTahunan->items()
                ->get()
                ->keyBy("upaya_kesehatan_id"),
            "unit_puskesmas_list" => $unit_puskesmas_list,
        ]);
    }

    public function update(Request $request, RencanaLimaTahunan $rencanaLimaTahunan)
    {
        $data = $request->validate([
            "diterima" => ["required", "boolean"]
        ]);

        $rencanaLimaTahunan->update([
            "waktu_penerimaan" =>
                $data["diterima"] ?
                    now() : null,
        ]);

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory->redirectToRoute(
            "rencana-lima-tahunan-for-admin.edit",
            $rencanaLimaTahunan,
        );
    }
}
