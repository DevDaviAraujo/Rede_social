<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\Content;
use App\Http\Controllers\Auth\WebsiteControllers\ContentControllers\ContentController;
use Auth;

class MakeComment extends Component
{

    public $content = '';
    public $returnMessage = [];
    public $postId; 

    public function mount($postId) {

        $this->postId = $postId;

    }

    public function makeComment() {

        $content_controller = app(ContentController::class)->saveContent([

            'user_id' => Auth::user()->id,
            'content_id' => $this->postId,
            'content_type' => 'Comment',
            'content' => $this->content,

        ]);

        $this->returnMessage = $content_controller;

        

            $content = content::where('id',$this->postId)->first();

            
            if($content->content_type == "Comment") {

                do{

                $content = content::where('id',$content->content_id)->first();

                }while($content->content_type == 'Comment');
            }
                

        return redirect()->to('/post/'.$content->id);

    }
    public function render()
    {
        return view('livewire.forms.make-comment');
    }
}
