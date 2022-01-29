<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartHeader extends Component
{
    public $cartProductsCount;
    public $wishListProductsCount;

    protected $listeners = ['updateCart', 'updateWishList', 'removeFromCart', 'removeItemFromWishList', 'moveToCart'];


    //////////////////////////////////////////////////////////////////////////////////
    /// Update Cart
    public function updateCart()
    {
        $this->cartProductsCount = Cart::instance('default')->count();
    }

    //////////////////////////////////////////////////////////////////////////////////
    /// Update Cart
    public function updateWishList()
    {
        $this->wishListProductsCount = Cart::instance('wishlist')->count();
    }
    //////////////////////////////////////////////////////////////////////////////////
    /// Remove From Cart
    public function removeFromCart($rowId)
    {
        Cart::instance('default')->remove($rowId);
        $this->emit('updateCart');
        $this->alert('success', 'Remove Product To Cart Successfully');
        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('cart');
        }
    }

    //////////////////////////////////////////////////////////////////////////////////
    /// Remove From WishList
    public function removeItemFromWishList($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        $this->emit('updateWishList');
        $this->alert('success', 'Remove Product To Wish List Successfully');
        if (Cart::instance('wishlist')->count() == 0) {
            return redirect()->route('wishList');
        }
    }

    //////////////////////////////////////////////////////////////////////////////////
    ///move From WishList To Cart
    public function moveToCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rid) use ($rowId) {
            return $rid === $rowId;
        });
        if ($duplicates->isNotEmpty()) {
            Cart::instance('wishlist')->remove($rowId);
            $this->alert('error', 'Product already exist in cart !');
        } else {
            Cart::instance('default')->add(
                $item->id, $item->name, 1, $item->price,
            )->associate(Product::class);
            Cart::instance('wishlist')->remove($rowId);
            $this->alert('success', 'Add Product To Cart Successfully');
        }
        $this->emit('updateCart');
        $this->emit('updateWishList');
        if (Cart::instance('wishlist')->count() == 0) {
            return redirect()->route('wishList');
        }
    }

    public function render()
    {
        $this->cartProductsCount = Cart::instance('default')->count();
        $this->wishListProductsCount = Cart::instance('wishlist')->count();

        return view('livewire.frontend.cart-header', [
            'cartProductsCount' => $this->cartProductsCount,
            'wishListProductsCount' => $this->wishListProductsCount,
        ]);
    }
}
