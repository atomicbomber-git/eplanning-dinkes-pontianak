<?php

namespace App\Http\Livewire;

use App\Http\Controllers\RencanaUsulanKegiatanForAdminController;
use App\RencanaUsulanKegiatan;
use App\UnitPuskesmas;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class RencanaUsulanKegiatanForAdminIndex extends Component
{
    public function render()
    {
        return view('livewire.rencana-usulan-kegiatan-for-admin-index', [
            "rencana_usulan_kegiatans" => RencanaUsulanKegiatan::query()
                ->orderByDesc("tahun")
                ->paginate()
        ]);
    }
}
