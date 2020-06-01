<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemRencanaPelaksanaanKegiatanTahunan extends Model
{
    protected $table = "item_rencana_pelaksanaan_kegiatan_tahunan";
    protected $guarded = [];

    public function upaya_kesehatan(): BelongsTo
    {
        return $this->belongsTo(UpayaKesehatan::class);
    }
}
