<?php

namespace App\Http\Livewire;

use App\UpayaKesehatan;
use Livewire\Component;

class UpayaKesehatanForAdminIndex extends Component
{
    public function render()
    {
        return view('livewire.upaya-kesehatan-for-admin-index', [
            "upaya_kesehatan_list" => UpayaKesehatan::query()
                ->orderBy("id")
                ->paginate()
        ]);
    }
}
