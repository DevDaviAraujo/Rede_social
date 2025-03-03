<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginAuthenticateForm extends Component
{

    public $email = '';
    public $password = '';
    public $returnMessage = [];

    public function authUserLogin()
    {

        // Perform validation using Livewire's built-in method
        $validated_credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required', 
        ], [
            'required' => 'Preencha o campo!',
            'email' => 'E-mail inválido!'
        ]);
    
        if(Auth::check()) {

            Auth::user()->update(['logout_at' => now()]);

        }

        // Attempt login with the provided credentials
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {

            Auth::user()->update(['logout_at' => null ]);           
            session()->regenerate();
            return redirect()->intended('/home');
        }

        $this->returnMessage = [

            'status' => 'error',
            'message' => 'Usuário inválido.'
    
        ];
    }
    public function render()
    {
        return view('livewire.forms.login-authenticate-form');
    }
}
