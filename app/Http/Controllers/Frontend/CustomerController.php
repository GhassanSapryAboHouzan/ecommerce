<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    ////////////////////////////////////////////////////
    /// index
    public function index()
    {
        return view('frontend.customer.index');
    }

    ////////////////////////////////////////////////////
    /// profile
    public function profile()
    {
        return view('frontend.customer.profile');
    }


    public function updateProfile(ProfileRequest $request)
    {

        dd($request->all());
        $customer = User::find(auth()->id());

        ///// check password not empty and not same of password in user table
        if (trim($request->password) != '' && !Hash::check($request->password, $customer->password)) {
            $password = bcrypt($request->password);
        } else {
            $password = $customer->password;
        }

        //// upload image
        if ($image = $request->file('user_image')) {
            if ($customer->user_image != null && File::exists('adminBoard/uploaded_images/users/' . $customer->user_image)) {
                unlink('adminBoard/uploaded_images/users/' . $customer->user_image);
            }
            $file_name = Str::slug($customer->username) . "." . $image->getClientOriginalExtension();
            $path = public_path('/adminBoard/uploaded_images/users/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

        } else {
            $file_name = $customer->user_image;
        }

        $customer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $password,
            'user_image' => $file_name,
            'receive_emails' => $request->receive_emails,
        ]);


        toast('Profile updated', 'success');
        return back();

    }

    public function removeImage()
    {
        $customer = User::find(auth()->id());
        if ($customer->user_image != null && File::exists('adminBoard/uploaded_images/users/' . $customer->user_image)) {
            unlink('adminBoard/uploaded_images/users/' . $customer->user_image);
        }

        $customer->user_image = '';
        $customer->save();

        toast('Customer image remove successfully', 'success');
        return back();
    }


    ////////////////////////////////////////////////////
    /// addresses
    public function addresses()
    {
        return view('frontend.customer.addresses');
    }


    ////////////////////////////////////////////////////
    /// orders
    public function orders()
    {
        return view('frontend.customer.orders');
    }
}
