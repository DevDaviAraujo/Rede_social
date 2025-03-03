<?php

namespace App\Livewire\Forms;
use Livewire\WithFileUploads;

use Livewire\Component;
use App\Http\Controllers\Auth\WebsiteControllers\ContentControllers\ContentController;
use App\Http\Controllers\Auth\WebsiteControllers\ImagesControllers\ImagesController;
use Auth;
use App\Models\Content;

class RegisterPost extends Component
{
    use WithFileUploads;

    public $content = '';
    public $files = [];
    public $uploads = [];
    public $returnMessage = [];

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
    public function register()
    {

        $content_controller = app(ContentController::class)->saveContent([

            'users_id' => Auth::user()->id,
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

        if (Content::find($contentId)) {
            redirect()->to('/post' . '/' . $contentId)->with('returnMessage', $this->returnMessage);
        }


    }
    public function render()
    {
        return view('livewire.forms.register-post');
    }
}
