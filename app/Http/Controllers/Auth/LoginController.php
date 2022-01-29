<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */


    use AuthenticatesUsers {
        logout as protected originalLogout;
    }


    public function username()
    {
        return 'username';
    }

    /*** redirect to .*/
    public function redirectTo()
    {
        if (auth()->user()->roles()->first()->allowed_route != '') {
            return $this->redirectTo = auth()->user()->roles()->first()->allowed_route . '/index';
        }
    }


    /*** Where to redirect users after login.*/
    protected $redirectTo = RouteServiceProvider::HOME;


    /*** Create a new controller instance.*/
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /** الفكرة وبكل بساطة انه لما يعمل تسجيل خروج تفضل السلة مليانة هههه.*/
    public function logout(Request $request)
    {
        $cart = collect($request->session()->get('cart'));

        /* Call original logout method */
        $response = $this->originalLogout($request);

        /* Repopulate Sesssion with Cart */
        if (!config('cart.destroy_on_logout')) {
            $cart->each(function ($rows, $identifier) use ($request){
                $request->session()->put('cart.'. $identifier, $rows);
            });
        }

        /* Return original response */
        return $response;

    }

    /*** The user has logged out of the application.*/
    protected function loggedOut(Request $request)
    {
        Cache::forget('admin_side_menu');
        Cache::forget('role_routes');
        Cache::forget('user_routes');

    }
}
