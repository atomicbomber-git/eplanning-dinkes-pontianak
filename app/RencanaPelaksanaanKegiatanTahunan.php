<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RencanaPelaksanaanKegiatanTahunan extends Model
{
    protected $table = "rencana_pelaksanaan_kegiatan_tahunan";
    protected $guarded = [];
    protected $dates = [
      "waktu_pembuatan"
    ];

    public function puskesmas(): BelongsTo
    {
        return $this->belongsTo(Puskesmas::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ItemRencanaPelaksanaanKegiatanTahunan::class);
    }
}
