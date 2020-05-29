<?php

namespace App\Http\Controllers;

use App\RencanaUsulanKegiatan;
use App\UnitPuskesmas;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;

class RencanaUsulanKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rencana_usulan_kegiatan_list = RencanaUsulanKegiatan::query()
            ->get();

        return response()->view("puskesmas.rencana-usulan-kegiatan.index", compact(
            "rencana_usulan_kegiatan_list"
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
     * @param  \App\RencanaUsulanKegiatan  $rencana_usulan_kegiatan
     *
     * @return \Illuminate\Http\Response
     */
    public function show(RencanaUsulanKegiatan $rencana_usulan_kegiatan
    )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RencanaUsulanKegiatan  $rencana_usulan_kegiatan
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(RencanaUsulanKegiatan $rencana_usulan_kegiatan
    )
    {
        $unit_puskesmas_list = UnitPuskesmas::query()
            ->with([
                "upaya_kesehatan_list",
                "upaya_kesehatan_list.item_rencana_usulan_kegiatan" => function (HasOne $hasOne) use($rencana_usulan_kegiatan) {
                    $hasOne->where("rencana_usulan_kegiatan_id", $rencana_usulan_kegiatan->id);
                },
            ])
            ->get();

        return response()->view("puskesmas.rencana-usulan-kegiatan.edit", compact(
            "rencana_usulan_kegiatan",
            "unit_puskesmas_list"
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RencanaUsulanKegiatan  $rencana_usulan_kegiatan
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RencanaUsulanKegiatan $rencana_usulan_kegiatan
    )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RencanaUsulanKegiatan  $rencana_usulan_kegiatan
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(RencanaUsulanKegiatan $rencana_usulan_kegiatan
    )
    {
        $rencana_usulan_kegiatan->forceDelete();

        return redirect()->back()
            ->with("messages", [
                [
                    "content" => __("messages.delete.success"),
                    "state" => MessageState::STATE_SUCCESS
                ]
            ]);
    }
}
