<?php

namespace App\Livewire\Forms;
use Livewire\WithFileUploads;

use Livewire\Component;
use App\Http\Controllers\Auth\WebsiteControllers\ContentControllers\ContentController;
use App\Http\Controllers\Auth\WebsiteControllers\ImagesControllers\ImagesController;
use App\Models\Images;
use Auth;
use App\Models\Content;

class EditPostForm extends Component
{
    use WithFileUploads;
    public $content = '';
    public $postId;
    public $files = [];
    public $uploads = [];
    public $oldUploads = [];
    public $returnMessage = [];

    public $unwantedOldUploads = [];

    public function updatedFiles()
    {

        $this->validate([
            'files.*' => 'file|mimes:jpg,jpeg,png,gif,svg|max:8192',
        ]);

        if ($this->files) {
            $this->uploads = $this->files;
        }

        $this->files = [];
    }
    public function removeUploads(int $index)
    {

        if (isset($this->uploads[$index])) {

            unset($this->uploads[$index]);
            $this->uploads = array_values($this->uploads);

        }

    }

    public function removeOldUploads(int $index)
    {

        if (isset($this->oldUploads[$index])) {

            $this->unwantedOldUploads[] = $this->oldUploads[$index];

            unset($this->oldUploads[$index]);

            $this->unwantedOldUploads = array_values($this->unwantedOldUploads);

        }

    }

    public function mount($postId)
    {

        $this->postId = $postId;
        $post = Content::where('id', $this->postId)->first();

        $this->content = $post->content;
        $this->oldUploads = $post->images;

    }
    public function update()
    {

        $content_controller = app(ContentController::class)->saveContent([

            'id' => $this->postId,
            'user_id' => Auth::user()->id,
            'content_id' => null,
            'content_type' => 'Post',
            'content' => $this->content,

        ]);

        $contentId = $content_controller['contentId'];

        if ($this->uploads) {

            $images_controller = app(ImagesController::class)->save_content_file(

                $this->uploads,
                $contentId

            );

        }

        if ($this->unwantedOldUploads) {

            foreach ($this->unwantedOldUploads as $upload) {

                Images::Where('id', $upload['id'])->delete();

            }

        }

        if (Content::find($contentId)) {
            redirect()->to('/post' . '/' . $contentId)->with('returnMessage', $this->returnMessage);
        }


    }
    public function render()
    {
        return view('livewire..forms.edit-post-form');
    }
}
