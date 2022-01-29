<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShippingCompanyRequest;
use App\Models\Country;
use App\Models\ShippingCompany;


class ShippingCompaniesController extends Controller
{
    /*** Index Function*/
    public function index()
    {
        $title = __('shipping_companies.shipping_companies');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_shipping_companies, show_shipping_companies')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $shippingCompanies = ShippingCompany::withCount('countries')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.shipping_companies.index', compact('shippingCompanies', 'title'));
    }


    /*** Create Function */
    public function create()
    {
        $title = __('shipping_companies.shipping_company_create');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_shipping_companies')) {
            return redirect()->route('admin.index');
        }

        $countries = Country::orderBy('id', 'asc')->get(['id', 'name']);
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        return view('backend.shipping_companies.create', compact('title', 'countries'));
    }


    /*** Store Function */
    public function store(ShippingCompanyRequest $request)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_shipping_companies')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if ($request->validated()) {
            $shippingCompany = ShippingCompany::create($request->except('countries', '_token', 'submit'));
            $shippingCompany->countries()->attach(array_values($request->countries));

            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => __('common.add_success_message'),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => __('common.error_message'),
                'alert-type' => 'danger'
            ]);
        }

    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_shipping_companies')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return view('backend.shipping_companies.show');

    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('shipping_companies.shipping_company_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_shipping_companies')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $shippingCompany = ShippingCompany::with('countries')->findOrFail($id);
        if (!$id || !$shippingCompany) {
            return redirect()->route('admin.shipping_companies.index');
        }

        $countries = Country::get(['id', 'name']);
        return view('backend.shipping_companies.edit', compact('shippingCompany', 'title', 'countries'));

    }


    /*** Update Function */
    public function update(ShippingCompanyRequest $request, $id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_shipping_companies')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $shippingCompany = ShippingCompany::findOrFail($id);
        if (!$id || !$shippingCompany) {
            return redirect()->route('admin.shipping_companies.index');
        }

        if ($request->validated()) {
            $shippingCompany->update($request->except('countries', '_token', 'submit'));
            $shippingCompany->countries()->sync(array_values($request->countries));


            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => __('common.update_success_message'),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => __('common.error_message'),
                'alert-type' => 'danger'
            ]);
        }

    }


    /*** destroy */
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_shipping_companies')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $shippingCompany = ShippingCompany::findOrFail($id);
        if (!$id || !$shippingCompany) {
            return redirect()->route('admin.shipping_companies.index');
        }
        $shippingCompany->delete();

        return redirect()->route('admin.shipping_companies.index')->with([
            'message' => __('common.delete_success_message'),
            'alert-type' => 'success'
        ]);
    }
}
