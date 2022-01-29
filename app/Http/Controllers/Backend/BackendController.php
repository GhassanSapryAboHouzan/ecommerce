<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AccountSettingRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BackendController extends Controller
{

    /////////////////////////////////////////////////////////
    // index
    public function index()
    {
        $title = __('dashboard.main');
        return view('backend.index', compact('title'));
    }


    /////////////////////////////////////////////////////////
    // account settings
    public function accountSettings()
    {
        $title = __('dashboard.account_settings');
        return view('backend.account_settings', compact('title'));
    }


    /////////////////////////////////////////////////////////
    // account settings
    public function updateAccountSettings(AccountSettingRequest $request)
    {

        if ($image = $request->file('user_image')) {
            if (auth()->user()->user_image != null && File::exists('adminBoard/uploaded_images/users/' . auth()->user()->user_image)) {
                unlink('adminBoard/uploaded_images/users/' . auth()->user()->user_image);
            }
            $file_name = Str::slug($request->username) . "." . $image->getClientOriginalExtension();
            $path = public_path('/adminBoard/uploaded_images/users/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

        } else {
            $file_name = auth()->user()->user_image;
        }

        if (trim($request->password) != '') {
            $password = bcrypt($request->password);
        } else {
            $password = $request->password;
        }

        auth()->user()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'status' => $request->status,
            'password' => $password,
            'user_image' => $file_name,
        ]);

        return redirect()->route('admin.account.settings')->with([
            'message' => __('common.update_success_message'),
            'alert-type' => 'success'
        ]);

    }

    /////////////////////////////////////////////////////////
    // Remove user Image Function

    public function removeImage(Request $request)
    {
        if (File::exists('adminBoard/uploaded_images/users/' . auth()->user()->user_image)) {
            unlink('adminBoard/uploaded_images/users/' . auth()->user()->user_image);
            auth()->user()->user_image = null;
            auth()->user()->save();
        }
        return true;
    }

}
