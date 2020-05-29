<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RencanaLimaTahunan extends Model
{
    protected $table = "rencana_lima_tahunan";
    protected $guarded = [];

    protected $dates = [
        "waktu_pembuatan"
    ];

    public function item_rencana_lima_tahunan_list(): HasMany
    {
        return $this->hasMany(ItemRencanaLimaTahunan::class);
    }
}
