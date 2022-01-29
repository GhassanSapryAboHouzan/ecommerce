<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
use App\Notifications\Frontend\Customer\OrderThanksNotification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
Auth::routes(['verify' => true]);

//Route::get('/invoice', function () {
//    $order = \App\Models\Order::with('products', 'user', 'payment_method')->find(1);
//    $data = $order->toArray();
//    $data['currency_symbol'] = $order->currency == 'USD' ? '$' : $order->currency;
//
//    $pdf = PDF::loadView('layouts.invoice', $data);
//    $saved_file = storage_path('app/pdf/files/' . $data['ref_id'] . '.pdf');
//    $pdf->save($saved_file);
//
//    $customer = \App\Models\User::find($order->user_id);
//    $customer->notify(new OrderThanksNotification($order, $saved_file));
//
//    return 'Email Sent';
//
//});


Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/product/{slug?}', [FrontendController::class, 'product'])->name('product');

Route::get('/shop/{slug?}', [FrontendController::class, 'shop'])->name('shop');
Route::get('/shop/tags/{slug?}', [FrontendController::class, 'shopTags'])->name('shop.tags');

Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('/wishList', [FrontendController::class, 'wishList'])->name('wishList');


Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['roles', 'role:customer', 'check_cart']], function () {

    Route::get('/checkout', [PaymentController::class, 'checkout'])
        ->name('checkout');
    Route::post('/checkout/payment', [PaymentController::class, 'checkoutPayment'])
        ->name('checkout.payment');
    Route::get('/checkout/{order_id}/canceled', [PaymentController::class, 'canceled'])
        ->name('checkout.cancel');
    Route::get('/checkout/{order_id}/completed', [PaymentController::class, 'completed'])
        ->name('checkout.complete');
    Route::get('/checkout/webhook/{order?}/{env?}', [PaymentController::class, 'webhook'])
        ->name('checkout.webhook.ipn');
});
