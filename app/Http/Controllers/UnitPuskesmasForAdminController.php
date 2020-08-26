<?php

namespace App\Http\Controllers;

use App\Providers\AuthServiceProvider;
use App\UnitPuskesmas;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize(AuthServiceProvider::MANAGE_UNIT_PUSKESMAS);
        return $this->responseFactory->view("unit-puskesmas-for-admin.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UnitPuskesmas  $unitPuskesmas
     * @return \Illuminate\Http\Response
     */
    public function show(UnitPuskesmas $unitPuskesmas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UnitPuskesmas  $unitPuskesmas
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitPuskesmas $unitPuskesmas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UnitPuskesmas  $unitPuskesmas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitPuskesmas $unitPuskesmas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UnitPuskesmas  $unitPuskesmas
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitPuskesmas $unitPuskesmas)
    {
        //
    }
}
