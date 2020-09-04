<?php

use App\Http\Controllers\ItemRencanaPelaksanaanKegiatanTahunanController;
use App\Http\Controllers\PrintRencanaPelaksanaanKegiatanTahunanController;
use App\Http\Controllers\PuskesmasForAdminController;
use App\Http\Controllers\RencanaLimaTahunanController;
use App\Http\Controllers\RencanaLimaTahunanForAdminController;
use App\Http\Controllers\RencanaPelaksanaanKegiatanTahunanController;
use App\Http\Controllers\RencanaUsulanKegiatanController;
use App\Http\Controllers\UnitPuskesmasForAdminController;
use App\Http\Controllers\UpayaKesehatanForAdminController;
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

Route::resource("puskesmas-for-admin", class_basename(PuskesmasForAdminController::class))
    ->parameter("puskesmas-for-admin", "puskesmas");

Route::resource("unit-puskesmas-for-admin", class_basename(UnitPuskesmasForAdminController::class))
    ->parameter("unit-puskesmas-for-admin", "unit-puskesmas");

Route::resource("unit-puskesmas-for-admin.upaya-kesehatan", class_basename(UpayaKesehatanForAdminController::class))
    ->parameter("unit-puskesmas-for-admin", "unit-puskesmas")
    ->shallow();

Route::resource("rencana-lima-tahunan-for-admin", class_basename(RencanaLimaTahunanForAdminController::class))
    ->parameter("rencana-lima-tahunan-for-admin", "rencana-lima-tahunan");

Route::resource("rencana-lima-tahunan-for-admin.penerimaan", class_basename(RencanaLimaTahunanForAdminController::class))
    ->parameters([
        "rencana-lima-tahunan-for-admin" => "rencana-lima-tahunan",
        "penerimaan" => "rencana-lima-tahunan",
    ])
    ->only(["store", "destroy"])
    ->shallow();

Route::group([
    "prefix" => "puskesmas",
    "as" => "puskesmas."
], function () {
    Route::resource("rencana-lima-tahunan", class_basename(RencanaLimaTahunanController::class));
    Route::resource("rencana-usulan-kegiatan", class_basename(RencanaUsulanKegiatanController::class));
    Route::resource("rpk-tahunan", class_basename(RencanaPelaksanaanKegiatanTahunanController::class));
    Route::resource("rpk-tahunan.item-rpk-tahunan", class_basename(ItemRencanaPelaksanaanKegiatanTahunanController::class))->shallow();
    Route::get("print-rpk-tahunan/{rpk_tahunan}", class_basename(PrintRencanaPelaksanaanKegiatanTahunanController::class))->name("print-rpk-tahunan") ;
});
