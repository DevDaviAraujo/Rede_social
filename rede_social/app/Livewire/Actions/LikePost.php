<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use App\Models\Content;
use App\Models\Interactions;
use Auth;

class LikePost extends Component
{

    public $postId;

    public function mount($postId) {
        $this->postId = $postId;
    }

    public function removeLike($postId) {

        Interactions::where('interaction_type','Posts')
        ->where('interaction_id',$postId)
        ->where('Users_id',Auth::user()->id)
        ->delete();

    }
    public function addLike($postId) {

        if(!Auth::check()) {
           return redirect()->to('/login');
        }

        Interactions::create([
            'users_id' => Auth::user()->id,
            'interaction_type' => 'Posts',
            'interaction_id' => $postId

        ]);
        
    }
    public function render()
    {
        return view('livewire..actions.like-post');
    }
}
