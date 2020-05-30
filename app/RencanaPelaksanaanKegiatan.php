<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RencanaPelaksanaanKegiatan extends Model
{
    protected $table = "rencana_pelaksanaan_kegiatan";
    protected $guarded = [];
    protected $dates = [
      "waktu_pembuatan"
    ];
}
