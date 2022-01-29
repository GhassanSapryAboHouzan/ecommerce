<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CustomersController extends Controller
{
    /*** Index Function*/
    public function index()
    {
        $title = __('customers.customers');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_customers, show_customers')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.customers.index', compact('customers', 'title'));
    }


    /*** Create Function */
    public function create()
    {
        $title = __('customers.customer_create');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_customers')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return view('backend.customers.create', compact('title'));
    }


    /*** Store Function */
    public function store(CustomerRequest $request)
    {


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_customers')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if ($image = $request->file('user_image')) {
            $file_name = Str::slug($request->username) . "." . $image->getClientOriginalExtension();
            $path = public_path('/adminBoard/uploaded_images/users/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
        } else {
            $file_name = null;
        }


        $customer = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'status' => $request->status,
            'password' => bcrypt($request->password),
            'user_image' => $file_name,
        ]);

        $customer->attachRole(Role::whereName('customer')->first()->id);
        $customer->markEmailAsVerified();

        return redirect()->route('admin.customers.index')->with([
            'message' => __('common.add_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_customers')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return view('backend.customers.show');

    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('customers.customer_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_customers')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $customer = User::findOrFail($id);
        if (!$id || !$customer) {
            return redirect()->route('admin.customers.index');
        }

        return view('backend.customers.edit',
            compact('customer', 'title'));

    }


    /*** Update Function .*/
    public function update(CustomerRequest $request, $id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_customers')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $customer = User::findOrFail($id);
        if (!$id || !$customer) {
            return redirect()->route('admin.customers.index');
        }

        if ($image = $request->file('user_image')) {
            if ($customer->user_image != null && File::exists('adminBoard/uploaded_images/users/' . $customer->user_image)) {
                unlink('adminBoard/uploaded_images/users/' . $customer->user_image);
            }
            $file_name = Str::slug($request->username) . "." . $image->getClientOriginalExtension();
            $path = public_path('/adminBoard/uploaded_images/users/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

        } else {
            $file_name = $customer->user_image;
        }

        if (trim($request->password) != '') {
            $password = bcrypt($request->password);
        } else {
            $password = $customer->password;
        }

        $customer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'status' => $request->status,
            'password' => $password,
            'user_image' => $file_name,
        ]);

        return redirect()->route('admin.customers.index')->with([
            'message' => __('common.update_success_message'),
            'alert-type' => 'success'
        ]);

    }


    /*** Remove the specified resource from storage.*/
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_customers')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $customer = User::findOrFail($id);
        if (!$id || !$customer) {
            return redirect()->route('admin.customers.index');
        }

        if ($customer->user_image != '') {
            if (File::exists('adminBoard/uploaded_images/users/' . $customer->user_image)) {
                unlink('adminBoard/uploaded_images/users/' . $customer->user_image);
            }
        }

        $customer->delete();
        return redirect()->route('admin.customers.index')->with(['message' => __('common.delete_success_message'),
            'alert-type' => 'success']);
    }


    /*** Remove Image Function .*/
    public function removeImage(Request $request)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_customers')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $customer = User::findOrFail($request->customer_id);
        if (!$customer) {
            return redirect()->route('admin.customers.index');
        }
        if (File::exists('adminBoard/uploaded_images/users/' . $customer->user_image)) {
            unlink('adminBoard/uploaded_images/users/' . $customer->user_image);
            $customer->user_image = null;
            $customer->save();
        }
        return true;
    }


    /*** Remove Image Function .*/
    public function getCustomers()
    {
        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->when(\request()->input('query') != '', function ($query) {
            $query->search(\request()->input('query'));
        })
            ->get(['id', 'first_name', 'last_name', 'email'])->toArray();

        return response()->json($customers);
    }


}
