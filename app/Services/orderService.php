<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTransactions;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class orderService
{

    public function createOrder($request)
    {

        $order = Order::create([
            'ref_id' => 'ORD-' . Str::random(15),
            'user_id' => auth()->id(),
            'user_address_id' => $request['customerAddressId'],
            'shipping_company_id' => $request['shippingCompanyId'],
            'payment_method_id' => $request['paymentMethodId'],
            'subtotal' => getNumbers()->get('subtotal'),
            'discount_code' => session()->has('coupon') ? session()->get('coupon')['code'] : null,
            'discount' => getNumbers()->get('discount'),
            'shipping' => getNumbers()->get('shipping'),
            'tax' => getNumbers()->get('productTaxes'),
            'total' => getNumbers()->get('total'),
            'currency' => 'USD',
            'order_status' => 0,
        ]);

        foreach (Cart::content() as $item) {

            // هنا يوجد ثلات حلول لاضافة المنتجات من الكارت لل جدول منتيجات الطلب الحل الاخير بانشاء مودل جديد للبايفت  هو الافضل
            /* $order->products->create([
                 'product_id' => $item->model->id,
                 'quantity' => $item->qty
             ]);

            DB::table('order_product')->create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty
            ]);
            */

            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty
            ]);
            $product = Product::find($item->model->id);
            $product->update(['quantity' => $product->quantity - $item->qty]);
        }

        $order->transactions()->create([
            'transaction' => OrderTransactions::NEW_ORDER
        ]);

        return $order;
    }
}
