<?php

namespace App\Http\Livewire\Frontend;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartTotal extends Component
{


    public $cartSubTotal;
    public $cartDiscount;
    public $cartTax;
    public $cartShipping;
    public $cartTotal;
    protected $listeners = ['updateCart' => 'mount'];

    public function mount()
    {

        $this->cartSubTotal = getNumbers()->get('subtotal');
        $this->cartDiscount = getNumbers()->get('discount');
        $this->cartTax = getNumbers()->get('productTaxes');
        $this->cartShipping = getNumbers()->get('shipping');
        $this->cartTotal = getNumbers()->get('total');

    }

    public function render()
    {
        return view('livewire.frontend.cart-total');
    }
}
