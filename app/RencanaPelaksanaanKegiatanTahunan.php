<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeWithTotalBiaya(Builder $builder)
    {
        return $builder
            ->select("*")
            ->addSelect([
                "total_biaya" => ItemRencanaPelaksanaanKegiatanTahunan::query()
                    ->selectRaw("SUM(biaya)")
                    ->whereColumn(
                        "rencana_pelaksanaan_kegiatan_tahunan_id",
                        "=",
                        "rencana_pelaksanaan_kegiatan_tahunan.id"
                    )
            ]);
    }

    public function puskesmas(): BelongsTo
    {
        return $this->belongsTo(Puskesmas::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ItemRencanaPelaksanaanKegiatanTahunan::class);
    }
}
