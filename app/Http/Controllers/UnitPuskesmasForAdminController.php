<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Providers\AuthServiceProvider;
use App\Support\SessionHelper;
use App\UnitPuskesmas;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class UnitPuskesmasForAdminController extends Controller
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
        $this->authorize(AuthServiceProvider::MANAGE_UNIT_PUSKESMAS);
        return $this->responseFactory->view("unit-puskesmas-for-admin.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return $this->responseFactory->view("unit-puskesmas-for-admin.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "nama" => ["required", "string", Rule::unique(UnitPuskesmas::class)]
        ]);

        UnitPuskesmas::query()->create($data);

        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory
            ->redirectToRoute("unit-puskesmas-for-admin.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UnitPuskesmas $unitPuskesmas
     * @return Response
     */
    public function edit(UnitPuskesmas $unitPuskesmas)
    {
        $this->authorize(AuthServiceProvider::MANAGE_UNIT_PUSKESMAS);
        return $this->responseFactory->view("unit-puskesmas-for-admin.edit", [
            "unit_puskesmas" => $unitPuskesmas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param UnitPuskesmas $unitPuskesmas
     * @return RedirectResponse
     */
    public function update(Request $request, UnitPuskesmas $unitPuskesmas)
    {
        $this->authorize(AuthServiceProvider::MANAGE_UNIT_PUSKESMAS);
        $data = $request->validate([
            "nama" => ["required", Rule::unique(UnitPuskesmas::class)->ignoreModel($unitPuskesmas)],
        ]);

        $unitPuskesmas->update($data);

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory
            ->redirectToRoute("unit-puskesmas-for-admin.edit", $unitPuskesmas);
    }
}
