<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CountryRequest;
use App\Models\Country;

class CountriesController extends Controller
{
    /*** Index Function*/
    public function index()
    {
        $title = __('countries.countries');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_countries, show_countries')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $countries = Country::with('states')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.countries.index', compact('countries', 'title'));
    }


    /*** Create Function */
    public function create()
    {
        $title = __('countries.country_create');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_countries')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        return view('backend.countries.create', compact('title'));
    }


    /*** Store Function */
    public function store(CountryRequest $request)
    {

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_countries')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        Country::create($request->validated());

        return redirect()->route('admin.countries.index')->with([
            'message' => __('common.add_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_countries')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return view('backend.countries.show');
    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('countries.country_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_countries')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $country = Country::findOrFail($id);
        if (!$id || !$country) {
            return redirect()->route('admin.countries.index');
        }
        return view('backend.countries.edit', compact('country', 'title'));

    }


    /*** Update Function */
    public function update(CountryRequest $request, $id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_countries')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $country = Country::findOrFail($id);
        if (!$id || !$country) {
            return redirect()->route('admin.countries.index');
        }

        $country->update($request->validated());

        return redirect()->route('admin.countries.index')->with([
            'message' => __('common.update_success_message'),
            'alert-type' => 'success'
        ]);

    }


    /*** destroy */
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_countries')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $country = Country::findOrFail($id);
        if (!$id || !$country) {
            return redirect()->route('admin.countries.index');
        }
        $country->delete();
        return redirect()->route('admin.countries.index')->with([
            'message' => __('common.delete_success_message'),
            'alert-type' => 'success'
        ]);
    }
}
