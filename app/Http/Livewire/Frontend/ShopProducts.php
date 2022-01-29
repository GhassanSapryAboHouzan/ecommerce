<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use App\Models\ProductCategory;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class ShopProducts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginationLimit = 12;
    public $slug;
    public $sortingBy = 'default';

    //////////////////////////////////////////////////////////////////
    /// mount function
    public function mount($slug)
    {
        $this->slug = $slug;
    }

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
    //////////////////////////////////////////////////////////////////
    /// render function
    public function render()
    {
        switch ($this->sortingBy) {
            case 'popularity':
                $sort_field = 'id';
                $sort_type = 'asc';
                break;
            case 'low-high':
                $sort_field = 'price';
                $sort_type = 'asc';
                break;
            case 'high-low':
                $sort_field = 'price';
                $sort_type = 'desc';
                break;
            default:
                $sort_field = 'id';
                $sort_type = 'asc';
        }


        $products = Product::with('firstMedia');

        if ($this->slug == '') {
            $products = $products->ActiveCategory();
        } else {

            $productCategory = ProductCategory::whereStatus(true)->whereSlug($this->slug)->first();

            if (is_null($productCategory->parent_id)) {

                $categoriesIds = ProductCategory::where('parent_id', $productCategory->id)
                    ->whereStatus(true)->pluck('id')->toArray();

                $products = $products->whereHas('category', function ($query) use ($categoriesIds) {
                    $query->whereIn('id', $categoriesIds);
                });

            } else {
                $products = $products->with('category')->whereHas('category', function ($query) {
                    $query->whereSlug($this->slug);
                    $query->whereStatus(true);
                });
            }

        }

        $products = $products->Active()
            ->orderBy($sort_field, $sort_type)
            ->paginate($this->paginationLimit);

        return view('livewire.frontend.shop-products', [
            'products' => $products
        ]);
    }
}
