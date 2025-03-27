<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use App\Models\User;

class SearchUsers extends Component
{

    public $search = "";
    public $users = [];


    public function eraseSearch() {
        $this->search = "";
        $this->search_user();
    }
    public function search_user()
    {

        $this->users = User::where('nick_name', 'like', '%' . $this->search . "%")->limit(6)->get();

        if ($this->search == "") {
            $this->users = [];
        }
        
    }
    public function render()
    {
        return view('livewire.actions.search-users');
    }
}
