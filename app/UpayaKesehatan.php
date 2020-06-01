<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UpayaKesehatan extends Model
{
    protected $table = "upaya_kesehatan";
    protected $guarded = [];

    public function unit_puskesmas(): BelongsTo
    {
        return $this->belongsTo(UnitPuskesmas::class);
    }

    public function item_rencana_lima_tahunan(): HasOne
    {
        return $this->hasOne(ItemRencanaLimaTahunan::class);
    }

    public function item_rencana_usulan_kegiatan(): HasOne
    {
        return $this->hasOne(ItemRencanaUsulanKegiatan::class);
    }

    public function item_rencana_pelaksanaan_kegiatan_tahunan(): HasOne
    {
        return $this->hasOne(ItemRencanaPelaksanaanKegiatanTahunan::class);
    }

    public function item_rencana_pelaksanaan_kegiatan_tahunan_list(): HasMany
    {
        return $this->hasMany(ItemRencanaPelaksanaanKegiatanTahunan::class);
    }

    public function item_rencana_lima_tahunan_list(): HasMany
    {
        return $this->hasMany(ItemRencanaLimaTahunan::class);
    }
}
