<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use App\Models\Content;
use App\Http\Controllers\Auth\WebsiteControllers\ContentControllers\ContentController;
use Auth;
class DeletePost extends Component
{

    public $postId;

    public function mount($postId)
    {

        $this->postId = $postId;

    }

    public function delete()
    {

        $controller = app(ContentController::class)
        ->deleteContent([ 'id' => $this->postId ]);

        return redirect()->to('/user/' . Auth::user()->nick_name);

    }
    public function render()
    {
        return view('livewire.actions.delete-post');
    }
}
