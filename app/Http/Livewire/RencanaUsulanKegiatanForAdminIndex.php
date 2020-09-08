<?php

namespace App\Http\Livewire;

use App\RencanaUsulanKegiatan;
use Livewire\Component;

class RencanaUsulanKegiatanForAdminIndex extends Component
{
    public function render()
    {
        return view('livewire.rencana-usulan-kegiatan-for-admin-index', [
            "rencana_usulan_kegiatans" => RencanaUsulanKegiatan::query()
                ->withTotalKebutuhanAnggaran()
                ->with("puskesmas:id,nama")
                ->orderByDesc("tahun")
                ->paginate()
        ]);
    }
}
