<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\Users;

class SearchUsers extends Component
{

    public $search = "";
    public $users = [];
    public function search_user() {

        $this->users = Users::where('nick_name', 'like','%' . $this->search . "%")->limit(10)->get();

    }
    public function render()
    {
        return view('livewire.forms.search-users');
    }
}
