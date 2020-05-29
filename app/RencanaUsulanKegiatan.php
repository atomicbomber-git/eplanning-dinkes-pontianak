<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RencanaUsulanKegiatan extends Model
{
    protected $table = "rencana_usulan_kegiatan";
    protected $guarded = [];

    public function items(): HasMany
    {
        return $this->hasMany(ItemRencanaUsulanKegiatan::class);
    }
}
