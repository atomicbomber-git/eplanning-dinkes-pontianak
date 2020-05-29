<?php

use App\Http\Controllers\RencanaLimaTahunanController;
use App\Http\Controllers\RencanaUsulanKegiatanController;
use App\RencanaUsulanKegiatan;
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
    "prefix" => "/puskesmas",
    "as" => "puskesmas."
], function () {
    Route::resource("/rencana-lima-tahunan", class_basename(RencanaLimaTahunanController::class));
    Route::resource("/rencana-usulan-kegiatan", class_basename(RencanaUsulanKegiatanController::class));
});
