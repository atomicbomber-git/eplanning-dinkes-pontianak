<?php

namespace App\Http\Controllers;

use App\Providers\AuthServiceProvider;
use App\RencanaLimaTahunan;
use Illuminate\Contracts\Routing\ResponseFactory;

class PenerimaanRencanaLimaTahunanController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function store(RencanaLimaTahunan $rencanaLimaTahunan)
    {
        $this->authorize(AuthServiceProvider::VIEW_ANY_RENCANA_LIMA_TAHUNAN);
        return $rencanaLimaTahunan;
    }

    public function destroy(RencanaLimaTahunan $rencanaLimaTahunan)
    {
        $this->authorize(AuthServiceProvider::VIEW_ANY_RENCANA_LIMA_TAHUNAN);
        return $rencanaLimaTahunan;
    }
}
