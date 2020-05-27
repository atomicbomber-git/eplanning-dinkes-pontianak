<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\RencanaLimaTahunan;
use Illuminate\Http\Request;

class RencanaLimaTahunanController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            "auth"
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rencana_lima_tahunan_list = RencanaLimaTahunan::query()
            ->orderByDesc("waktu_pembuatan")
            ->get();

        return response()->view("puskesmas.rencana-lima-tahunan.index", compact(
            "rencana_lima_tahunan_list"
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
     * @param  \App\RencanaLimaTahunan  $rencana_lima_tahunan
     * @return \Illuminate\Http\Response
     */
    public function show(RencanaLimaTahunan $rencana_lima_tahunan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RencanaLimaTahunan  $rencana_lima_tahunan
     * @return \Illuminate\Http\Response
     */
    public function edit(RencanaLimaTahunan $rencana_lima_tahunan)
    {
        $rencana_lima_tahunan->load([
           "item_rencana_lima_tahunan_list",
           "item_rencana_lima_tahunan_list.upaya_kesehatan",
        ]);

        return $rencana_lima_tahunan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RencanaLimaTahunan  $rencana_lima_tahunan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RencanaLimaTahunan $rencana_lima_tahunan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RencanaLimaTahunan  $rencana_lima_tahunan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RencanaLimaTahunan $rencana_lima_tahunan)
    {
        $rencana_lima_tahunan->forceDelete();

        return redirect()->back()
            ->with("messages", [
                [
                    "content" => __("messages.delete.success"),
                    "state" => MessageState::STATE_SUCCESS
                ]
            ]);
    }
}
