<?php

namespace App\Http\Livewire;

use App\ItemRencanaLimaTahunan;
use App\RencanaLimaTahunan;
use Livewire\Component;
use Livewire\WithPagination;

class RencanaLimaTahunanForAdminIndex extends Component
{
    use WithPagination;

    public $query;

    protected $updatesQueryString = [
        "query" => ["except" => ""],
    ];

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.rencana-lima-tahunan-for-admin-index', [
            "rencana_lima_tahunans" => RencanaLimaTahunan::query()
                ->withTotalKebutuhanAnggaran()
                ->with("puskesmas")
                ->orderByDesc("tahun_awal_periode")
                ->paginate()
        ]);
    }
}
