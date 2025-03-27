<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use App\Models\Interactions;
use App\Models\User;
use Auth;

class Follow extends Component
{

    public $user_followed_id;
    public $currentUserId;

    public function mount($user_followed_id)
    {
        $this->currentUserId = Auth::check() ? Auth::id() : null;
        $this->user_followed_id = $user_followed_id;
    }

    public function follow($user_following_id, $user_followed_id)
    {

        if (!$user_following_id) {
            return redirect()->to('/login');
        }

        $user = User::where('id',$user_following_id)->first();

        if ($user->isFollowing($user_followed_id)) {

            $interaction = User::find($user_followed_id)->followers->where('user_id', $user_following_id)->first();
            $interaction->delete();


        } else {

            Interactions::create([

                'user_id' => $user_following_id,
                'interaction_type' => 'User',
                'interaction_id' => $user_followed_id,

            ]);
        }


    }
    public function render()
    {
        return view('livewire.actions.follow');
    }
}
