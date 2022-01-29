<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    /////////////////////////////////////////////////////////
    // login
    public function login(){
        return view('backend.auth.login');
    }

    /////////////////////////////////////////////////////////
    // forget Password
    public function forgetPassword(){
        return view('backend.auth.forget-password');
    }

    /////////////////////////////////////
    /// do Login
    public function doLogin(LoginRequest $request)
    {

        $rememberMe = $request->has('rememberMe') ? true : false;

        if (auth()->attempt(['username' => $request->input('username'), 'password' => $request->input('password')], $rememberMe)) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('admin.login')->with(['error' => trans('dashboard.login_failed')]);
        }
    }


}
