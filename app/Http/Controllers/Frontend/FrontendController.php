<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    ///////////////////////////////////////////////////
    // index
    public function index()
    {
        $product_categories = ProductCategory::whereStatus(1)->whereNull('parent_id')->get();
        return view('frontend.index', compact('product_categories'));
    }


    ///////////////////////////////////////////////////
    // shop
    public function shop($slug = null)
    {

        return view('frontend.shop', compact('slug'));
    }

    ///////////////////////////////////////////////////
    // shop Tags
    public function shopTags($slug = null)
    {
        if (!$slug) {
            return redirect()->route('index');
        }
        return view('frontend.shop_tag', compact('slug'));
    }


    ///////////////////////////////////////////////////
    // product
    public function product($slug = null)
    {
        if (!$slug) {
            return redirect()->route('index');
        }
        $product = Product::withAvg('reviews', 'rating')->with('media', 'category', 'tags', 'reviews')
            ->Active()->whereSlug($slug)->firstOrFail();


        return view('frontend.product', compact('product'));
    }

    ///////////////////////////////////////////////////
    // cart
    public function cart()
    {
        return view('frontend.cart');
    }

    ///////////////////////////////////////////////////
    // wishList
    public function wishList()
    {
        return view('frontend.wish_list');
    }




}
