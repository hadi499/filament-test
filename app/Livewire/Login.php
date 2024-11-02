<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('Login')]
class Login extends Component
{
    #[Rule('required', 'name')]
    public string $name = '';

    #[Rule('required')]
    public string $password = '';


    public function login()
    {

        if (Auth::attempt($this->validate())) {
            return redirect()->route('home');
        } else {
            session()->flash('message', 'The provided credentials do not match.');
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}
