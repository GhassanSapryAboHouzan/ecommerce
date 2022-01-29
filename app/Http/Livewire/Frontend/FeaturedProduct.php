<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class FeaturedProduct extends Component
{


    ///////////////////////////////////////////////////////////////////////////////////////////////////
    /// Add To Cart Function
    public function addToCart($id)
    {

        $product = Product::findOrFail($id);
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product already exist!');
        } else {
            Cart::instance('default')->add(
                $product->id, $product->name, 1, $product->price,
            )->associate(Product::class);
            $this->emit('updateCart');
            $this->alert('success', 'Add Product To Cart Successfully');
        }

    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    /// Add To Wish List Cart Function
    public function addToWishList($id)
    {

        $product = Product::findOrFail($id);
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product already exist!');
        } else {
            Cart::instance('wishlist')->add(
                $product->id, $product->name, 1, $product->price,
            )->associate(Product::class);
            $this->emit('updateWishList');
            $this->alert('success', 'Add Product To Wish List Cart Successfully');
        }

    }

    public function render()
    {
        //->inRandomOrder()
        return view('livewire.frontend.featured-product', [
            'featuredProducts' => Product::with('firstMedia')
                ->Featured()->Active()->HasQuantity()->ActiveCategory()->orderByDesc('id')->take(8)->get()
        ]);
    }
}
