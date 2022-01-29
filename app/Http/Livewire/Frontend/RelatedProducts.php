<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class RelatedProducts extends Component
{

    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    /// Add To Cart Function
    public function addToCart($id)
    {

        $addProduct = Product::findOrFail($id);
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($addProduct) {
            return $cartItem->id === $addProduct->id;
        });

        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product already exist!');
        } else {
            Cart::instance('default')->add(
                $addProduct->id, $addProduct->name, 1, $addProduct->price,
            )->associate(Product::class);
            $this->emit('updateCart');
            $this->alert('success', 'Add Product To Cart Successfully');
        }

    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    /// Add To Wish List Cart Function
    public function addToWishList($id)
    {

        $addProduct = Product::findOrFail($id);
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($addProduct) {
            return $cartItem->id === $addProduct->id;
        });

        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product already exist!');
        } else {
            Cart::instance('wishlist')->add(
                $addProduct->id, $addProduct->name, 1, $addProduct->price,
            )->associate(Product::class);
            $this->emit('updateWishList');
            $this->alert('success', 'Add Product To Wish List Cart Successfully');
        }

    }

    public function render()
    {
        return view('livewire.frontend.related-products', [
            'relatedProducts' => Product::with('firstMedia')
                ->whereHas('category', function ($query) {
                    $query->whereId($this->product->product_category_id);
                    $query->whereStatus(true);
                })->inRandomOrder()->take(4)->get()
        ]);
    }
}
