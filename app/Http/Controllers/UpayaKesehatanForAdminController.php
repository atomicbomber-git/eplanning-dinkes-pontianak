<?php

namespace App\Http\Controllers;

use App\Providers\AuthServiceProvider;
use App\UnitPuskesmas;
use App\UpayaKesehatan;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UpayaKesehatan  $upayaKesehatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UpayaKesehatan $upayaKesehatan)
    {
        //
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
