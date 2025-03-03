<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LogoutSession extends Component
{

    public function logoutSession() {

        Auth::user()->update(['logout_at' => now()]);
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->to('/home');

    }
    public function render()
    {
        return view('livewire.actions.logout-session');
    }
}
