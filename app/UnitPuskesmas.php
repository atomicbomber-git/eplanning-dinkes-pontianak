<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitPuskesmas extends Model
{
    protected $guarded = [];

    public function upaya_kesehatan_list()
    {
        return $this->hasMany(UpayaKesehatan::class);
    }
}
