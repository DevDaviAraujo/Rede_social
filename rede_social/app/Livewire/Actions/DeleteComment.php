<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use App\Models\Content;
class DeleteComment extends Component
{

    public $commentId;

    public function mount($commentId)
    {

        $this->commentId = $commentId;

    }

    public function deleteComment()
    {

        $content = Content::where('id', $this->commentId)->first();

        $comment = $content;
        
        $comment = $comment->update([
     
                'content' => '</deleted>',
                'status' => false,

            ]);

        if($content->content_type == 'Comment') {

            do{

                $content = Content::where('id', $content->content_id)->first();

            }while($content->content_type == 'Comment');

        }

        return redirect()->to('/post/'. $content->id);

    }

    public function render()
    {
        return view('livewire.actions.delete-comment');
    }
}
