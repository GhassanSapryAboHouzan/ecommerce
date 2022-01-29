<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductModal extends Component
{
    public $productModalShow = false;
    public $productModal = [];
    public $quantity = 1;

    protected $listeners = ['showProductModalAction'];

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    /// Show Product Modal Function
    public function showProductModalAction($id)
    {
        $this->productModalShow = true;
        $this->productModal = Product::withAvg('reviews', 'rating')->findOrFail($id);
        //dd($this->productModal);
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
        if ($this->productModal->quantity > $this->quantity) {
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
            return $cartItem->id === $this->productModal->id;
        });

        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product already exist!');
        } else {
            Cart::instance('default')->add(
                $this->productModal->id, $this->productModal->name, $this->quantity, $this->productModal->price,
            )->associate(Product::class);
            $this->quantity = 1;
            $this->emit('updateCart');
            $this->alert('success', 'Add Product To Cart Successfully');
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    /// Add To Wish List Function
    public function addToWishList()
    {
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->productModal->id;
        });

        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product already exist!');
        } else {
            Cart::instance('wishlist')->add(
                $this->productModal->id, $this->productModal->name, 1, $this->productModal->price
            )->associate(Product::class);
            $this->emit('updateWishList');
            $this->alert('success', 'Add Product To Wish List Cart Successfully');
        }
    }

    public function render()
    {
        return view('livewire.frontend.product-modal');
    }
}
