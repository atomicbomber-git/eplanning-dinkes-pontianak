<?php

use App\Http\Controllers\ItemRencanaPelaksanaanKegiatanTahunanController;
use App\Http\Controllers\RencanaLimaTahunanController;
use App\Http\Controllers\RencanaPelaksanaanKegiatanTahunanController;
use App\Http\Controllers\RencanaUsulanKegiatanController;
use App\RencanaPelaksanaanKegiatanTahunan;
use App\RencanaUsulanKegiatan;
use App\UnitPuskesmas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::redirect("/", "/login");

Route::group([
    "prefix" => "puskesmas",
    "as" => "puskesmas."
], function () {
    Route::resource("rencana-lima-tahunan", class_basename(RencanaLimaTahunanController::class));
    Route::resource("rencana-usulan-kegiatan", class_basename(RencanaUsulanKegiatanController::class));
    Route::resource("rpk-tahunan", class_basename(RencanaPelaksanaanKegiatanTahunanController::class));
    Route::resource("rpk-tahunan.item-rpk-tahunan", class_basename(ItemRencanaPelaksanaanKegiatanTahunanController::class))->shallow();
});


Route::get('/rencana', function () {
    $unit_puskesmas_list = UnitPuskesmas::query()
        ->with([
            "upaya_kesehatan_list",
        ])
        ->get();

    return view("home", compact(
        "unit_puskesmas_list"
    ));
});
