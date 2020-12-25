<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{

    public function __Construct($cart = null)
    {
        if ($cart) {

            $this->items = $cart->items;
            $this->totalQty = $cart->totalQty;
            $this->totalPrice = $cart->totalPrice;
        } else {

            $this->items = [];
            $this->totalQty = 0;
            $this->totalPrice = 0;
        }
    }

    protected $with = ['post'];
    protected $guarded = [];
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public $items = [];
    public $totalQty;
    public $totalPrice;



    public function add($product)
    {
        $item = [
            'id' =>  $product->id,
            'title' => $product->title,
            'price' => $product->price,
            'qty' => 0,
            'image' => $product->image,
        ];

        if (!array_key_exists($product->id, $this->items)) {
            $this->items[$product->id] = $item;
            $this->totalQty += 1;
            $this->totalPrice += $product->price;
        } else {

            $this->totalQty += 1;
            $this->totalPrice += $product->price;
        }

        $this->items[$product->id]['qty']  += 1;
    }

    public function remove($id)
    {
        if (array_key_exists($id, $this->items)) {
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];
            unset($this->items[$id]);
        }
    }

    public function updateQty($id, $qty)
    {
        //reset qty and price in the cart ,
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['qty'];
        // add the item with new qty
        $this->items[$id]['qty'] = $qty;

        // total price and total qty in cart
        $this->totalQty += $qty;
        $this->totalPrice += $this->items[$id]['price'] * $qty;
    }
}
