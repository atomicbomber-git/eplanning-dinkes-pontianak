<?php

namespace App\Http\Livewire;

use App\RencanaPelaksanaanKegiatanTahunan;
use Livewire\Component;

class RpkTahunanForAdminIndex extends Component
{
    public function render()
    {
        return view('livewire.rpk-tahunan-for-admin-index', [
            "rpk_tahunans" => RencanaPelaksanaanKegiatanTahunan::query()
                ->withTotalBiaya()
                ->with("puskesmas:id,nama")
                ->orderByDesc("tahun")
                ->paginate()
        ]);
    }
}
