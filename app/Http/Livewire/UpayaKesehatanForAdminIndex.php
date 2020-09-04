<?php

namespace App\Http\Livewire;

use App\Constants\MessageState;
use App\Support\SessionHelper;
use App\UnitPuskesmas;
use App\UpayaKesehatan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class UpayaKesehatanForAdminIndex extends Component
{
    public $unitPuskesmasId;

    protected $listeners = [
        "upaya-kesehatan:delete" => "deleteUpayaKesehatan",
    ];

    public function deleteUpayaKesehatan($upaya_kesehatan_id)
    {
        try {
             UpayaKesehatan::query()
                ->whereKey($upaya_kesehatan_id)
                ->delete();

            UpayaKesehatan::query()
                ->whereKey($upaya_kesehatan_id)
                ->delete();

            SessionHelper::flashMessage(
                __("messages.delete.success"),
                MessageState::STATE_SUCCESS,
            );
        } catch (\Throwable $throwable) {
            SessionHelper::flashMessage(
                __("messages.delete.failure"),
                MessageState::STATE_DANGER,
            );
        }
    }

    public function mount($unitPuskesmasId)
    {
        $this->unitPuskesmasId = $unitPuskesmasId;
    }

    /**
     * @return Builder|Builder[]|Collection|Model|UnitPuskesmas|null
     */
    public function getUnitPuskesmasProperty()
    {
        return UnitPuskesmas::query()
            ->findOrFail($this->unitPuskesmasId);
    }



    public function render()
    {
        return view('livewire.upaya-kesehatan-for-admin-index', [
            "unit_puskesmas" => $this->getUnitPuskesmasProperty(),
            "upaya_kesehatan_list" => $this->getUnitPuskesmasProperty()
                ->upaya_kesehatan_list()
                ->orderBy("id")
                ->paginate()
        ]);
    }
}
