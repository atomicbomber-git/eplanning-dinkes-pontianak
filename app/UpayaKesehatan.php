<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UpayaKesehatan extends Model
{
    protected $table = "upaya_kesehatan";
    protected $guarded = [];

    public function unit_puskesmas(): BelongsTo
    {
        return $this->belongsTo(UnitPuskesmas::class);
    }
}
