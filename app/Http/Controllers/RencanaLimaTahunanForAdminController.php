<?php

namespace App\Http\Controllers;

use App\Providers\AuthServiceProvider;
use App\RencanaLimaTahunan;
use Illuminate\Contracts\Routing\ResponseFactory;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize(AuthServiceProvider::MANAGE_ANY_RENCANA_LIMA_TAHUNAN);
        return $this->responseFactory->view("rencana-lima-tahunan-for-admin.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RencanaLimaTahunan  $rencanaLimaTahunan
     * @return \Illuminate\Http\Response
     */
    public function show(RencanaLimaTahunan $rencanaLimaTahunan)
    {
        //
    }
}
