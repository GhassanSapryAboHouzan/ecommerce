<?php

namespace App\Http\Livewire\Frontend;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishListTable extends Component
{


    public function removeItemFomWishListTable($rowId)
    {
        $this->render();
        $this->emit('removeItemFromWishList', $rowId);

    }

    public function render()
    {
        return view('livewire.frontend.wish-list-table', [
            'wishlistItems' => Cart::instance('wishlist')->content()
        ]);
    }
}
