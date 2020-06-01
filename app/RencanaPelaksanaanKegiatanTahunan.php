<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RencanaPelaksanaanKegiatanTahunan extends Model
{
    protected $table = "rencana_pelaksanaan_kegiatan_tahunan";
    protected $guarded = [];
    protected $dates = [
      "waktu_pembuatan"
    ];

    public function items(): HasMany
    {
        return $this->hasMany(ItemRencanaPelaksanaanKegiatanTahunan::class);
    }
}
