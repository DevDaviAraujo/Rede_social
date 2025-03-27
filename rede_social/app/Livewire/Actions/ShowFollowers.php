<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use App\Models\User;
use App\Models\Interactions;

class ShowFollowers extends Component
{

    public $search = "";
    public $user;
    public $followers = [];

    public function mount($user)
    {

        $followings = $this->user->followers;

        $followers = [];

        foreach ($followings as $following) {

            $user = User::where('id', $following->user_id)->first(); 
            if ($user) {
                $followers[] = $user; 
            }

        }

        $this->followers = $followers;

    }

    public function search_followers($user)
    {

        $user = User::find($user['id']);

        if ($user) {

            $followings = $user->followers;

            $followers = [];

            foreach ($followings as $following) {

                $user = User::where('id', $following->user_id)
                    ->where('nick_name', 'LIKE', '%' . $this->search . '%')
                    ->limit(10)
                    ->first();

                if ($user) {
                    $followers[] = $user; 
                }

            }

            if(!isset($followers)) {

                return $this->mount($user);
            }

            $this->followers = $followers;

        }

    }
    public function render()
    {
        return view('livewire.actions.show-followers');
    }
}
