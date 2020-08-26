<?php

namespace App\Http\Livewire;

use App\UnitPuskesmas;
use Livewire\Component;

class UnitPuskesmasForAdminIndex extends Component
{
    public function render()
    {
        return view('livewire.unit-puskesmas-for-admin-index', [
            "unit_puskesmas_list" => UnitPuskesmas::query()
                ->orderBy("id")
                ->paginate()
        ]);
    }
}
