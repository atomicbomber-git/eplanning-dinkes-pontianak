<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Providers\AuthServiceProvider;
use App\RencanaUsulanKegiatan;
use App\Support\SessionHelper;
use App\UnitPuskesmas;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RencanaUsulanKegiatanForAdminController extends Controller
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
        $this->authorize(AuthServiceProvider::APPROVE_RENCANA_USULAN_KEGIATAN);
        return $this->responseFactory->view("rencana-usulan-kegiatan-for-admin.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param RencanaUsulanKegiatan $rencanaUsulanKegiatan
     * @return Response
     */
    public function show(RencanaUsulanKegiatan $rencanaUsulanKegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RencanaUsulanKegiatan $rencanaUsulanKegiatan
     * @return Response
     */
    public function edit(RencanaUsulanKegiatan $rencanaUsulanKegiatan)
    {
        $this->authorize(AuthServiceProvider::APPROVE_RENCANA_USULAN_KEGIATAN);

        return $this->responseFactory->view("rencana-usulan-kegiatan-for-admin.edit", [
            "rencana_usulan_kegiatan" => $rencanaUsulanKegiatan,
            "unit_puskesmases" =>
                UnitPuskesmas::query()
                    ->with([
                        "upaya_kesehatan_list.item_rencana_usulan_kegiatan" => function (HasOne $hasOne) use ($rencanaUsulanKegiatan) {
                            $hasOne->where("rencana_usulan_kegiatan_id", $rencanaUsulanKegiatan->id);
                        }
                    ])
                    ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RencanaUsulanKegiatan $rencanaUsulanKegiatan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, RencanaUsulanKegiatan $rencanaUsulanKegiatan)
    {
        $data = $request->validate([
            "diterima" => ["required", "boolean"]
        ]);

        $rencanaUsulanKegiatan->update([
            "waktu_penerimaan" =>
                $data["diterima"] ?
                    now() : null,
        ]);

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory->redirectToRoute(
            "rencana-usulan-kegiatan-for-admin.edit",
            $rencanaUsulanKegiatan,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RencanaUsulanKegiatan $rencanaUsulanKegiatan
     * @return Response
     */
    public function destroy(RencanaUsulanKegiatan $rencanaUsulanKegiatan)
    {
        //
    }
}
