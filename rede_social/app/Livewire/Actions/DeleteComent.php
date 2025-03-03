<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use App\Models\Content;
class DeleteComent extends Component
{

    public $comentId;

    public function mount($comentId) {

        $this->comentId = $comentId;

    }

    public function deleteComent() {

        Content::where('id',$this->comentId)->update(['content' => '<deleted>']);

    }

    public function render()
    {
        return view('livewire.actions.delete-coment');
    }
}
