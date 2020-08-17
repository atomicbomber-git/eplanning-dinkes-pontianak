<?php

namespace App\Http\Livewire;

use App\Constants\MessageState;
use App\Puskesmas;
use App\Support\SessionHelper;
use Livewire\Component;
use Livewire\WithPagination;

class PuskesmasForAdminIndex extends Component
{
    use WithPagination;

    protected $listeners = [
        "puskesmas:delete" => "deletePuskesmas",
    ];

    public function deletePuskesmas($puskesmasId)
    {
        try {
            Puskesmas::query()
                ->where("id", $puskesmasId)
                ->delete();

            SessionHelper::flashMessage(
                __("messages.delete.success"),
                MessageState::STATE_SUCCESS,
            );
        } catch (\Throwable $exception) {
            SessionHelper::flashMessage(
                __("messages.delete.failure"),
                MessageState::STATE_DANGER,
            );
        }
    }

    public function getPuskesmasListProperty()
    {
        return Puskesmas::query()
            ->with("user")
            ->orderBy("nama")
            ->paginate();
    }

    public function render()
    {
        return view('livewire.puskesmas-for-admin-index');
    }
}
