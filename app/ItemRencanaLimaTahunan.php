<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemRencanaLimaTahunan extends Model
{
    protected $table = "item_rencana_lima_tahunan";
    protected $guarded = [];

    public function upaya_kesehatan(): BelongsTo
    {
        return $this->belongsTo(UpayaKesehatan::class);
    }

    public function rencana_lima_tahunan(): BelongsTo
    {
        return $this->belongsTo(RencanaLimaTahunan::class);
    }
}
