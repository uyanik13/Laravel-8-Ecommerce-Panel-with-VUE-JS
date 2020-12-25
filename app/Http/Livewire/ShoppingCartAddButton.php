<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ShoppingCart;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ShoppingCartAddButton extends Component
{

    public $product;
    public $user;
    public $guest;
    public $cart;
    public $class ;
    public $quantity;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->guest = session()->getId();
    }

    public function addToCart (){


        if($this->user){
              $this->cart = userShoppingCartControl($this->user,$this->product->id,$this->quantity);
        } else {
             $this->cart = guestShoppingCartControl($this->guest,$this->product->id,$this->quantity);
        }


             $this->showAlert();
             $this->emit('addToCart', true);

    }

    public function showAlert()
    {
        $this->alert('success', trans('lang.product_added_to_cart'), [
            'position' => 'top-right',
            'toast' => true,
            'text' => '...',
            'showCancelButton' => false,
            'showConfirmButton' => false
        ]);
    }

    public function mount ($product,$quantity,$class){

        $this->product = $product;
        $this->quantity = $quantity;
        $this->class = $class;

    }

    public function render()
    {
        return view('livewire.shopping-cart-add-button',[
            'class' => $this->class,
        ]);
    }
}
