<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ModalRegister extends Component
{
    public $name;
    public $email;
    public $username;
    public $password;
    public $password_confirm;

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

    public  function frontEndRegister  ()
    {

        $user = User::create([
            'name' => $this->name,
            'username' => $$this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password)
           ]);

            return $this->frontEndLogin();

    }

    public function render()
    {
        return view('livewire.modal-register');
    }
}
