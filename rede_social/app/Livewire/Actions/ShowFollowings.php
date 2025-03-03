<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use App\Models\Users;
use App\Models\Interactions;

class ShowFollowings extends Component
{

    public $search = "";
    public $user;
    public $followings = [];

    public function mount($user)
    {

        $followings = $this->user->followings;

        $userFollowings = [];

        foreach ($followings as $following) {

            $user = Users::where('id',$following->interaction_id)->first();

            if ($user) {
                $userFollowings[] = $user;
            }

        }

        $this->followings = $userFollowings;

    }

    public function search_followings($user)
    {

        $user = Users::find($user['id']);

        if ($user) {

            $followings = $user->followings;

            $userFollowings = [];

            foreach($followings as $following) {

                $user = Users::where('id',$following->interaction_id)
                ->where('nick_name', 'LIKE', '%' . $this->search . '%')
                ->limit(10)
                ->first();
                
                if ($user) {
                    $userFollowings[] = $user;
                }

            }

            if(!isset($followers)) {

                return $this->mount($user);
            }

            $this->followings = $userFollowings;
        }

    }
    public function render()
    {
        return view('livewire.actions.show-followings');
    }
}
