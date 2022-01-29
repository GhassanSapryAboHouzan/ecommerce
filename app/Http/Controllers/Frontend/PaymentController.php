<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTransactions;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Models\User;
use App\Notifications\Frontend\Customer\OrderCreatedNotification;
use App\Notifications\Frontend\Customer\OrderThanksNotification;
use App\Services\OmnipayService;
use App\Services\orderService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;

class PaymentController extends Controller
{

    ///////////////////////////////////////////////////
    // checkout
    public function checkout()
    {
        return view('frontend.checkout');
    }

    ////////////////////////////////////////////////////////////
    /// checkout payment function
    public function checkoutPayment(Request $request)
    {

        $order = (new OrderService)->createOrder($request->except(['_token', 'submit']));

        $omniPay = new OmnipayService('PayPal_Express');
        $response = $omniPay->purchase([
            'amount' => $order->total,
            'transactionId' => $order->ref_id,
            'currency' => $order->currency,
            'cancelUrl' => $omniPay->getCancelUrl($order->id),
            'returnUrl' => $omniPay->getReturnUrl($order->id),
        ]);

        // هنا يعني انه تم تحويلك للبي بال هذا يعني انه العملية نحجت
        if ($response->isRedirect()) {
            $response->redirect();
        }

        toast($response->getMessage(), 'error');
        return redirect()->route('frontend.index');
    }

    ////////////////////////////////////////////////////////////
    /// canceled  function
    public function canceled($order_id)
    {
        $order = Order::find($order_id);
        $order->update([
            'order_status' => Order::CANCELED
        ]);

        $order->products()->each(function ($order_product) {
            $product = Product::whereId($order_product->pivot->product_id)->first();
            $product->update([
                'quantity' => $product->quantity + $order_product->pivot->quantity
            ]);
        });

        toast('You have cancelled your order payment!', 'error');
        return redirect()->route('index');
    }

    ////////////////////////////////////////////////////////////
    /// completed function
    public function completed($order_id)
    {

        $order = Order::with('products', 'user', 'payment_method')->find($order_id);
        $omniPay = new OmnipayService('PayPal_Express');

        $response = $omniPay->complete([
            'amount' => $order->total,
            'transactionId' => $order->ref_id,
            'currency' => $order->currency,
            'cancelUrl' => $omniPay->getCancelUrl($order->id),
            'returnUrl' => $omniPay->getReturnUrl($order->id),
            'notifyUrl' => $omniPay->getNotifyUrl($order->id),
        ]);

        if ($response->isSuccessful()) {
            $order->update(['order_status' => Order::PAYMENT_COMPLETED]);
            $order->transactions()->create([
                'transaction' => OrderTransactions::PAYMENT_COMPLETED,
                'transaction_number' => $response->getTransactionReference(),
                'payment_result' => 'success'
            ]);

            if (session()->has('coupon')) {
                $coupon = ProductCoupon::whereCode(session()->get('coupon')['code'])->first();
                $coupon->increment('used_times');
            }

            Cart::instance('default')->destroy();

            session()->forget([
                'coupon',
                'savedCustomerAddressId',
                'savedShippingCompanyId',
                'savedPaymentMethodId',
                'shipping',
            ]);


            /////////////////////////////////////////////////////////////////////////
            /// notification

            $admins = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['admin', 'supervisor']);
            })->get();

            foreach ($admins as $admin) {
                $admin->notify(new OrderCreatedNotification($order));
            }

            ////////////////////////////////////////////////////////////
            /// pdf and customer notification
            $data = $order->toArray();
            $data['currency_symbol'] = $order->currency == 'USD' ? '$' : $order->currency;

            $pdf = PDF::loadView('layouts.invoice', $data);
            $saved_file = storage_path('app/pdf/files/' . $data['ref_id'] . '.pdf');
            $pdf->save($saved_file);

            $customer = User::find(3);
            $customer->notify(new OrderThanksNotification($order, $saved_file));




            toast('Your recent payment is successful with reference code: ' . $response->getTransactionReference(), 'success');
            return redirect()->route('index');
        }
    }

    ////////////////////////////////////////////////////////////
    /// webhook function
    public function webhook($order, $env)
    {

    }


}
