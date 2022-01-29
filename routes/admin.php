<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CitiesController;
use App\Http\Controllers\Backend\CountriesController;
use App\Http\Controllers\Backend\CustomerAddressesController;
use App\Http\Controllers\Backend\CustomersController;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\PaymentMethodsController;
use App\Http\Controllers\Backend\ProductCategoriesController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductCouponsController;
use App\Http\Controllers\Backend\ProductReviewsController;
use App\Http\Controllers\Backend\ShippingCompaniesController;
use App\Http\Controllers\Backend\StatesController;
use App\Http\Controllers\Backend\SupervisorsController;
use App\Http\Controllers\Backend\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LoginController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/


Route::group(
    [
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::group(['middleware' => 'guest'], function () {
            Route::get('/login', [LoginController::class, 'login'])->name('login');
            Route::post('login', [LoginController::class, 'doLogin'])->name('login');
            Route::get('/forget-password', [LoginController::class, 'forgetPassword'])
                ->name('forget.password');

        });


        Route::group(['middleware' => ['roles', 'role:admin|supervisor']], function () {
            Route::get('/', [BackendController::class, 'index'])->name('index_route');
            Route::get('/index', [BackendController::class, 'index'])->name('index');

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            /// account settings
            Route::get('/account_settings', [BackendController::class, 'accountSettings'])->name('account.settings');
            Route::patch('/account_settings/update', [BackendController::class, 'updateAccountSettings'])
                ->name('update.account.settings');
            Route::post('/account_settings/user/remove-image', [BackendController::class, 'removeImage'])
                ->name('account_settings.user.remove_image');


            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            /// product categories
            Route::post('/product_categories/remove-image', [ProductCategoriesController::class, 'removeImage'])
                ->name('product_categories.remove_image');
            Route::resource('product_categories', ProductCategoriesController::class);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            /// tags
            Route::resource('tags', TagController::class);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            /// products
            Route::post('/products/remove-image', [ProductController::class, 'removeImage'])
                ->name('products.remove_image');
            Route::resource('products', ProductController::class);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            /// product coupons
            Route::resource('product_coupons', ProductCouponsController::class);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            /// product reviews
            Route::resource('product_reviews', ProductReviewsController::class);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            /// customers
            Route::post('/customers/remove-image', [CustomersController::class, 'removeImage'])
                ->name('customers.remove_image');

            Route::get('/customers/get_customers', [CustomersController::class, 'getCustomers'])
                ->name('customers.get_customers');

            Route::resource('customers', CustomersController::class);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///customer addresses
            Route::resource('customer_addresses', CustomerAddressesController::class);


            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///supervisors
            Route::post('/supervisors/remove-image', [SupervisorsController::class, 'removeImage'])
                ->name('supervisors.remove_image');
            Route::resource('supervisors', SupervisorsController::class);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///countries
            Route::resource('countries', CountriesController::class);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///states
            Route::get('/states/get_states', [StatesController::class, 'getStates'])
                ->name('states.get_states');
            Route::resource('states', StatesController::class);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///cities
            Route::get('/cities/get_cities', [CitiesController::class, 'getCities'])
                ->name('cities.get_cities');
            Route::resource('cities', CitiesController::class);


            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///shipping companies
            Route::resource('shipping_companies', ShippingCompaniesController::class);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///payment methods
            Route::resource('payment_methods', PaymentMethodsController::class);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///orders
            Route::resource('orders', OrdersController::class);


        });


    });



