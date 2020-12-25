<?php

namespace App\Http\Livewire;

use App\Models\Setting;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ShoppingCart extends Component
{
    public $cart;
    public $cartTotal;
    public $quantity;
    public $currency;
    public $user;
    public $type;
    public $setting;

    protected $listeners = ['addToCart'];

    public function __construct()
    {
        $this->user = Auth::user() ? Auth::user() : session()->getId();
        $this->type = Auth::user() ? 'user' : 'guest';
        $this->setting = namedSettings(Setting::all());

    }


    public function addToCart ($booelan)
    {


        if($booelan){
            $this->cartTotal = cartTotal($this->user,$this->type);
            $this->cart =cart($this->user,$this->type);
        }



    }

    public function removeFromCart ($id)
    {


        $deleted = deleteFromCart($id,$this->user,$this->type);
        if($deleted){
            $this->cartTotal = cartTotal($this->user,$this->type);
           return $this->cart =cart($this->user,$this->type);
        }

    }


    public function mount ()
    {

        $this->cart = cart($this->user,$this->type);
        $this->cartTotal = cartTotal($this->user,$this->type);


    }

    public function render()
    {
        return view('livewire.shopping-cart',[
            'cart' => $this->cart,
            'cartTotal' => $this->cartTotal,
            ]);
    }
}
