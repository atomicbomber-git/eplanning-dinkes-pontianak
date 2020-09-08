<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RencanaUsulanKegiatan extends Model
{
    protected $table = "rencana_usulan_kegiatan";
    protected $guarded = [];

    protected $dates = [
        "waktu_pembuatan",
    ];

    public function puskesmas(): BelongsTo
    {
        return $this->belongsTo(Puskesmas::class);
    }

    public function scopeWithTotalKebutuhanAnggaran(Builder $query)
    {
        return $query
            ->select("*")
            ->addSelect([
                "total_kebutuhan_anggaran" =>
                    ItemRencanaUsulanKegiatan::query()
                        ->selectRaw("SUM(kebutuhan_anggaran)")
                        ->whereColumn(
                            "item_rencana_usulan_kegiatan.rencana_usulan_kegiatan_id",
                            "=",
                            "rencana_usulan_kegiatan.id"
                        )
            ]);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ItemRencanaUsulanKegiatan::class);
    }
}
