<?php
namespace App\Livewire\Forms;

use Livewire\Component;
use App\Http\Controllers\Auth\WebsiteControllers\UsersControllers\UsersController;

class RegisterUserForm extends Component
{
    public $nick_name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $name = '';
    public $last_name = '';
    public $gender = '';
    public $phone_number = '';
    public $returnMessage;

    public function register()
    {        
        
        $validatedData = $this->validate([
            'nick_name' => 'required|unique:users,nick_name|max:20',
            'email' => 'required|email|unique:users,email|max:40',
            'password' => 'required|same:password_confirmation|max:20|min:3',
            'name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'phone_number' => 'required|min:13|unique:users_info,phone_number'
        ], [
            'required' => 'Preencha o campo.',
            'email' => 'E-mail inválido.',
            'nick_name.unique' => 'Este @ já está em uso.',
            'email.unique' => 'Este e-mail já está em uso.',
            'phone_number.unique' => 'Este número já foi cadastrado.',
            'same' => 'As senhas não coincidem.',
            'phone_number.min' => 'Número inválido.',
            'password.min' => 'A senha é muito curta.'
        ]);

        
        $controller = app(UsersController::class);
        $response = $controller->saveUser([
            'nick_name' => trim($this->nick_name),
            'email' => trim($this->email),
            'password' => ucfirst(trim($this->password)),
            'name' => ucfirst(trim($this->name)),
            'last_name' => trim($this->last_name),
            'gender' => $this->gender,
            'phone_number' => $this->phone_number,
        ]);

        $this->returnMessage = $response;
        
        redirect()->to('/login')->with('returnMessage',$this->returnMessage);
    }

    public function render()
    {
        return view('livewire.forms.register-user-form');
    }
}
