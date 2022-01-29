<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StateRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
class StatesController extends Controller
{
    /*** Index Function*/
    public function index()
    {
        $title = __('states.states');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_states, show_states')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $states = State::with('cities')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.states.index', compact('states', 'title'));
    }


    /*** Create Function */
    public function create()
    {
        $title = __('states.state_create');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_states')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $countries = Country::get(['id', 'name']);
        return view('backend.states.create', compact('title', 'countries'));
    }


    /*** Store Function */
    public function store(StateRequest $request)
    {

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_states')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        State::create($request->validated());

        return redirect()->route('admin.states.index')->with([
            'message' => __('common.add_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_states')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return view('backend.states.show');
    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('states.state_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_states')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $state = State::findOrFail($id);
        if (!$id || !$state) {
            return redirect()->route('admin.states.index');
        }
        $countries = Country::get(['id', 'name']);
        return view('backend.states.edit', compact('state', 'title', 'countries'));
    }


    /*** Update Function */
    public function update(StateRequest $request, $id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_states')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $state = State::findOrFail($id);
        if (!$id || !$state) {
            return redirect()->route('admin.states.index');
        }

        $state->update($request->validated());

        return redirect()->route('admin.states.index')->with([
            'message' => __('common.update_success_message'),
            'alert-type' => 'success'
        ]);

    }


    /*** destroy */
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_states')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $state = State::findOrFail($id);
        if (!$id || !$state) {
            return redirect()->route('admin.states.index');
        }
        $state->delete();
        return redirect()->route('admin.states.index')->with([
            'message' => __('common.delete_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** get States */
    public function getStates(Request $request)
    {
        $states = State::whereCountryId($request->country_id)->whereStatus(true)->get(['id', 'name'])->toArray();
        return response()->json($states);
    }
}
