<?php


use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

function getParentShowOf($param)
{
    $route = str_replace(LaravelLocalization::setLocale() . '/admin.', '', $param);
    $permission = collect(Cache::get('admin_side_menu')->pluck('children')->flatten())
        ->where('as', $route)->flatten()->first();
    return $permission ? $permission['parent_show'] : null;

}

function getParentOf($param)
{
    $route = str_replace(LaravelLocalization::setLocale() . '/admin.', '', $param);
    $permission = collect(Cache::get('admin_side_menu')->pluck('children')->flatten())
        ->where('as', $route)->flatten()->first();
    return $permission ? $permission['parent'] : null;
}


function getParentOIdf($param)
{
    $route = str_replace(LaravelLocalization::setLocale() . '/admin.', '', $param);
    $permission = collect(Cache::get('admin_side_menu')->pluck('children')->flatten())
        ->where('as', $route)->flatten()->first();
    return $permission ? $permission['id'] : null;

}


//  get active languages Helper Function
if (!function_exists('getActiveLanguages')) {
    function Lang()
    {
        return LaravelLocalization::getCurrentLocale();
    }
}

function getNumbers()
{
    $subtotal = Cart::instance('default')->subtotal();
    $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0.00;
    $discount_code = session()->has('coupon') ? session()->get('coupon')['code'] : null;

    $subtotal_after_discount = $subtotal - $discount;

    // calculate tax
    $tax = config('cart.tax') / 100;
    $taxText = config('cart.tax') . '%';

    $productTaxes = round($subtotal_after_discount * $tax, 2);
    $newSubTotal = $subtotal_after_discount + $productTaxes;

    // add shipping value
    $shipping = session()->has('shipping') ? session()->get('shipping')['cost'] : 0.00;
    $shipping_code = session()->has('shipping') ? session()->get('shipping')['code'] : null;


    $total = ($newSubTotal + $shipping) > 0 ? round($newSubTotal + $shipping, 2) : 0.00;

    return collect([
        'subtotal' => $subtotal,
        'tax' => $tax,
        'taxText' => $taxText,
        'productTaxes' => (float)$productTaxes,
        'newSubTotal' => (float)$newSubTotal,
        'discount' => (float)$discount,
        'discount_code' => $discount_code,
        'shipping' => (float)$shipping,
        'shipping_code' => $shipping_code,
        'total' => (float)$total,
    ]);
}
