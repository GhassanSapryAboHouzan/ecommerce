<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ShowProduct extends Component
{

    public $product;
    public $quantity = 1;
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    /// Mount Function
    public function mount($product)
    {
        $this->product = $product;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    /// Decrease Quantity Function
    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }

    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    /// Increase Quantity Function
    public function increaseQuantity()
    {
        if ($this->product->quantity > $this->quantity) {
            $this->quantity++;
        } else {
            $this->alert('warning', 'Exceeded quantity in stock');
        }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////
    /// Add To Cart Function
    public function addToCart()
    {

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->product->id;
        });

        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product already exist!');
        } else {
            Cart::instance('default')->add(
                $this->product->id, $this->product->name, $this->quantity, $this->product->price,
            )->associate(Product::class);
            $this->emit('updateCart');
            $this->alert('success', 'Add Product To Cart Successfully');
        }

    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    /// Add To Wish List Cart Function
    public function addToWishList()
    {
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->product->id;
        });
        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product already exist!');
        } else {
            Cart::instance('wishlist')->add(
                $this->product->id, $this->product->name, 1, $this->product->price,
            )->associate(Product::class);
            $this->emit('updateWishList');
            $this->alert('success', 'Add Product To Wish List Cart Successfully');
        }
    }

    public function render()
    {
        return view('livewire.frontend.show-product');
    }
}
