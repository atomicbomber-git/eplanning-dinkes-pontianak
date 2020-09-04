<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Providers\AuthServiceProvider;
use App\Support\SessionHelper;
use App\UnitPuskesmas;
use App\UpayaKesehatan;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpayaKesehatanForAdminController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UnitPuskesmas $unitPuskesmas)
    {
        $this->authorize(AuthServiceProvider::MANAGE_UPAYA_KESEHATAN);
        return $this->responseFactory->view("upaya-kesehatan-for-admin.index", [
            "unit_puskesmas" => $unitPuskesmas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UnitPuskesmas $unitPuskesmas)
    {
        return $this->responseFactory->view("upaya-kesehatan-for-admin.create", [
            "unit_puskesmas" => $unitPuskesmas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, UnitPuskesmas $unitPuskesmas)
    {
        $this->authorize(AuthServiceProvider::MANAGE_UPAYA_KESEHATAN);

        $data = $request->validate([
            "nama" => ["required", "string", Rule::unique(UpayaKesehatan::class)->where("unit_puskesmas_id", $unitPuskesmas->id)]
        ]);

        $unitPuskesmas->upaya_kesehatan_list()->create($data);

        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS,
        );

        return redirect()->route(
            "unit-puskesmas-for-admin.upaya-kesehatan.index",
            $unitPuskesmas
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UpayaKesehatan  $upayaKesehatan
     * @return \Illuminate\Http\Response
     */
    public function show(UpayaKesehatan $upayaKesehatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UpayaKesehatan  $upayaKesehatan
     * @return \Illuminate\Http\Response
     */
    public function edit(UpayaKesehatan $upayaKesehatan)
    {
        $this->authorize(AuthServiceProvider::MANAGE_UPAYA_KESEHATAN);

        return $this->responseFactory->view("upaya-kesehatan-for-admin.edit", [
            "upaya_kesehatan" => $upayaKesehatan
                ->load("unit_puskesmas")
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UpayaKesehatan  $upayaKesehatan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, UpayaKesehatan $upayaKesehatan)
    {
        $this->authorize(AuthServiceProvider::MANAGE_UPAYA_KESEHATAN);

        $data = $request->validate([
            "nama" => ["required", "string", Rule::unique(UpayaKesehatan::class)->ignoreModel($upayaKesehatan)]
        ]);

        $upayaKesehatan->update($data);

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return redirect()
            ->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UpayaKesehatan  $upayaKesehatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(UpayaKesehatan $upayaKesehatan)
    {
        //
    }
}
