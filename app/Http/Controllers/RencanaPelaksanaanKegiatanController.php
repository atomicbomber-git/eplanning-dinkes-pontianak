<?php

namespace App\Http\Controllers;

use App\RencanaPelaksanaanKegiatan;
use Illuminate\Http\Request;

class RencanaPelaksanaanKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rencana_pelaksanaan_kegiatan_list = RencanaPelaksanaanKegiatan::query()
            ->get();

        return response()->view("puskesmas.rencana-pelaksanaan-kegiatan.index", compact(
            "rencana_pelaksanaan_kegiatan_list"
        ));
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
     * @param  \App\RencanaPelaksanaanKegiatan  $rencana_pelaksanaan_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(RencanaPelaksanaanKegiatan $rencana_pelaksanaan_kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RencanaPelaksanaanKegiatan  $rencana_pelaksanaan_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(RencanaPelaksanaanKegiatan $rencana_pelaksanaan_kegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RencanaPelaksanaanKegiatan  $rencana_pelaksanaan_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RencanaPelaksanaanKegiatan $rencana_pelaksanaan_kegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RencanaPelaksanaanKegiatan  $rencana_pelaksanaan_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RencanaPelaksanaanKegiatan $rencana_pelaksanaan_kegiatan)
    {
        //
    }
}
