<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RencanaLimaTahunan extends Model
{
    protected $table = "rencana_lima_tahunan";
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
        return $this->hasMany(ItemRencanaLimaTahunan::class);
    }

    public function item_rencana_lima_tahunan_list(): HasMany
    {
        return $this->hasMany(ItemRencanaLimaTahunan::class);
    }
}
