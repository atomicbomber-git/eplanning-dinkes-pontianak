<?php

namespace App\Http\Livewire;

use App\Constants\MessageState;
use App\Support\SessionHelper;
use App\UnitPuskesmas;
use Livewire\Component;

class UnitPuskesmasForAdminIndex extends Component
{
    protected $listeners = [
        "unit-puskesmas:delete" => "deleteUnitPuskesmas",
    ];

    public function deleteUnitPuskesmas($unitPuskesmasId)
    {
        try {
            /** @var UnitPuskesmas $unitPuskesmas */
            $unitPuskesmas = UnitPuskesmas::query()
                ->findOrFail($unitPuskesmasId);

            throw_if(
                $unitPuskesmas->upaya_kesehatan_list()->count() > 0,
                new \Exception("Unit puskesmas telah memiliki data terkait."),
            );

            $unitPuskesmas->delete();

            SessionHelper::flashMessage(
                __("messages.delete.success"),
                MessageState::STATE_SUCCESS,
            );
        } catch (\Throwable $throwable) {
            SessionHelper::flashMessage(
                __("messages.delete.failure") . " " . $throwable->getMessage(),
                MessageState::STATE_DANGER,
            );
        }
    }

    public function render()
    {
        return view('livewire.unit-puskesmas-for-admin-index', [
            "unit_puskesmas_list" => UnitPuskesmas::query()
                ->orderBy("id")
                ->paginate()
        ]);
    }
}
