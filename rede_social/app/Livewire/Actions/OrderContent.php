<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use App\Models\Contents;
use App\Models\User;
use Livewire\Attributes\Computed;

class OrderContent extends Component
{

    public $contents;
    public $sortBy = 'latest';
    public function mount($user)
    {

        $this->contents = $user->posts->sortByDesc('created_at')->values();
        
    }

    public function setSortOrder($type)
    {
        $this->sortBy = $type;
        $this->order();
    }
    
    #[Computed]
    public function order()
    {

        if ($this->sortBy == 'latest') {

            $this->contents = $this->contents->sortByDesc('created_at')->values();

        }

        if ($this->sortBy == 'oldest') {

            $this->contents = $this->contents->sortBy('created_at')->values();

        }

        if ($this->sortBy == 'relevance') {

            foreach ($this->contents as &$content) {
                $content['relevance'] = $content->getRelevance();
            }

            $this->contents = $this->contents->sortByDesc('relevance')->values();

        }

    }

    public function render()
    {
        return view('livewire.actions.order-content');
    }
}
