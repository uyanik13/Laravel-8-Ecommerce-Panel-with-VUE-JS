<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class Cart extends Component
{

    public $quantity;
    public $cart;
    public $cartTotal;
    public $currency;
    public $user;
    public $type;

    public function __construct()
    {
        $this->user = Auth::user() ? Auth::user() : session()->getId();
        $this->type = Auth::user() ? 'user' : 'guest';

    }


    public function removeFromCart ($id)
    {



        $deleted = deleteFromCart($id,$this->user,$this->type);
        if($deleted){
            $this->cartTotal = cartTotal($this->user,$this->type);
            $this->emit('addToCart', true);
           return $this->cart =cart($this->user,$this->type);
        }



    }
    public function mount ($cart,$cartTotal,$currency)
    {
        $this->cart = $cart;
        $this->cartTotal = $cartTotal;
        $this->currency = $currency;
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
