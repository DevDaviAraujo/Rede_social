<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\Content;
use App\Http\Controllers\Auth\WebsiteControllers\ContentControllers\ContentController;
use Auth;

class MakeComent extends Component
{

    public $content = '';
    public $returnMessage = [];
    public $postId; 

    public function mount($postId) {

        $this->postId = $postId;

    }

    public function makeComent() {

        $content_controller = app(ContentController::class)->registerContent([

            'users_id' => Auth::user()->id,
            'content_id' => $this->postId,
            'content_type' => 'Coments',
            'content' => $this->content,

        ]);

        $this->returnMessage = $content_controller;

    }
    public function render()
    {
        return view('livewire..forms.make-coment');
    }
}
