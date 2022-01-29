<?php

use App\Http\Controllers\Frontend\CustomerController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| customer Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['roles', 'role:customer']], function () {


    Route::get('/dashboard', [CustomerController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [CustomerController::class, 'profile'])
        ->name('profile');

    Route::patch('/update/profile', [CustomerController::class, 'updateProfile'])
        ->name('update.profile');

    Route::get('/remove/image', [CustomerController::class, 'removeImage'])
        ->name('remove.image');


    Route::get('/addresses', [CustomerController::class, 'addresses'])
        ->name('addresses');

    Route::get('/orders', [CustomerController::class, 'orders'])
        ->name('orders');


});





