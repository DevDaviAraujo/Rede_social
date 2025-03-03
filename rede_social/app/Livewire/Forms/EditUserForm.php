<?php
namespace App\Livewire\Forms;

use App\Http\Controllers\Auth\WebsiteControllers\ImagesControllers\ImagesController;
use Livewire\Component;
use App\Models\Users;
use App\Http\Controllers\Auth\WebsiteControllers\UsersControllers\UsersController;
use Livewire\WithFileUploads;

class EditUserForm extends Component
{
    use WithFileUploads; // Required to handle file uploads

    public $user;
    public $image;  // File input for image
    public $bio;
    public $email;
    public $name;
    public $last_name;
    public $gender;
    public $phone_number;
    public $returnMessage = [];

    public function mount($user)
    {
        $this->user = $user;
        $this->email = $user->email;
        $this->bio = $user->bio;
        $this->name = $user->user_info->name;
        $this->last_name = $user->user_info->last_name;
        $this->gender = $user->user_info->gender;
        $this->phone_number = $user->user_info->phone_number;
    }

    public function update_user()
    {
        $validatedData = $this->validate([
            'image' => 'nullable|file|mimes:svg,png,jpg,jpeg,gif,jfif|max:5120',
            'email' => 'required|email|unique:users,email,' . $this->user->id . '|max:40',
            'bio' => 'required',
            'name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'phone_number' => 'required|unique:users_info,phone_number,'.$this->user->user_info->id.'|min:13'
        ], [
            'required' => 'Preencha o campo.',
            'email' => 'E-mail inválido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'phone_number.min' => 'Número inválido.',
            'phone_number.unique' => 'Telefone já cadastrado.',
        ]);


        $user_controller = app(UsersController::class)->saveUser([
            'id' => $this->user->id,
            'email' => trim($this->email),
            'bio' => $this->bio,
            'name' => ucfirst(trim($this->name)),
            'last_name' => trim($this->last_name),
            'gender' => $this->gender,
            'phone_number' => $this->phone_number,
        ]);



        if ($this->image) {

            $user = Users::find($this->user->id);
            
            if ($user->avatar) {

                $user_avatar_image = app(ImagesController::class)->update_avatar_image(
                    $this->image,
                    $this->user->id
                );

            } else {
                $user_avatar_image = app(ImagesController::class)->save_avatar_image(
                    $this->image,
                    $this->user->id, 
                    false
                );
            }

        }

        if (isset($user_avatar_image)) {
            $this->returnMessage = [$user_controller, $user_avatar_image];
        } else {
            $this->returnMessage = [$user_controller];
        }

    }

    public function render()
    {
        return view('livewire.forms.edit-user-form', ['user' => $this->user]);
    }
}
