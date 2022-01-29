<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerAddressRequest;
use App\Http\Requests\Backend\TagRequest;
use App\Models\Country;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class CustomerAddressesController extends Controller
{
    /*** Index Function*/
    public function index()
    {
        $title = __('customer_addresses.customer_addresses');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_customer_addresses, show_customer_addresses')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $customer_addresses = UserAddress::with('user')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereDefaultAddress(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.customer_addresses.index', compact('customer_addresses', 'title'));
    }


    /*** Create Function */
    public function create()
    {
        $title = __('customer_addresses.customer_address_create');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_customer_addresses')) {
            return redirect()->route('admin.index');
        }


        $countries = Country::whereStatus(true)->get(['id', 'name']);
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        return view('backend.customer_addresses.create', compact('title', 'countries'));
    }


    /*** Store Function */
    public function store(CustomerAddressRequest $request)
    {

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_customer_addresses')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        UserAddress::create($request->validated());

        return redirect()->route('admin.customer_addresses.index')->with([
            'message' => __('common.add_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_customer_addresses')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $customerAddress = UserAddress::findOrFail($id);
        if (!$id || !$customerAddress) {
            return redirect()->route('admin.customer_addresses.index');
        }
        return view('backend.customer_addresses.show', compact('customerAddress'));
    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('customer_addresses.customer_address_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_customer_addresses')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $customerAddress = UserAddress::findOrFail($id);
        if (!$id || !$customerAddress) {
            return redirect()->route('admin.customer_addresses.index');
        }

        $countries = Country::whereStatus(true)->get(['id', 'name']);
        return view('backend.customer_addresses.edit', compact('customerAddress', 'title', 'countries'));

    }


    /*** Update Function */
    public function update(CustomerAddressRequest $request, $id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_customer_addresses')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $customerAddress = UserAddress::findOrFail($id);
        if (!$id || !$customerAddress) {
            return redirect()->route('admin.customer_addresses.index');
        }

        $customerAddress->update($request->validated());

        return redirect()->route('admin.customer_addresses.index')->with([
            'message' => __('common.update_success_message'),
            'alert-type' => 'success'
        ]);

    }


    /*** destroy */
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_customer_addresses')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $customerAddress = UserAddress::findOrFail($id);
        if (!$id || !$customerAddress) {
            return redirect()->route('admin.customer_addresses.index');
        }

        $customerAddress->delete();
        return redirect()->route('admin.customer_addresses.index')->with([
            'message' => __('common.delete_success_message'),
            'alert-type' => 'success'
        ]);
    }
}
