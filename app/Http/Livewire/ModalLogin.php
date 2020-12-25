<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ModalLogin extends Component
{

    public $email;
    public $password;


    public  function frontEndLogin  ()
    {
         $credentials = [
             'email'=> $this->email,
             'password'=> $this->password,
         ];

        if (Auth::attempt($credentials)) {
            $token = Auth::guard()->attempt($credentials);
            setcookie('token', $token, time() + 24 * 60 * 60, '/');
            return redirect()->route('page.home');
        }

    }


    public function render()
    {
        return view('livewire.modal-login');
    }
}
