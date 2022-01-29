<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PaymentMethodRequest;
use App\Models\PaymentMethod;

class PaymentMethodsController extends Controller
{
    /*** Index Function*/
    public function index()
    {
        $title = __('payment_methods.payment_methods');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_payment_methods, show_payment_methods')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $paymentMethods = PaymentMethod::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.payment_methods.index', compact('paymentMethods', 'title'));
    }


    /*** Create Function */
    public function create()
    {
        $title = __('payment_methods.payment_method_create');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_payment_methods')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        return view('backend.payment_methods.create', compact('title'));
    }


    /*** Store Function */
    public function store(PaymentMethodRequest $request)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_payment_methods')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        PaymentMethod::create($request->validated());

        return redirect()->route('admin.payment_methods.index')->with([
            'message' => __('common.add_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_payment_methods')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        return view('backend.payment_methods.show');
    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('payment_methods.payment_method_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_payment_methods')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $paymentMethod = PaymentMethod::findOrFail($id);
        if (!$id || !$paymentMethod) {
            return redirect()->route('admin.payment_methods.index');
        }

        return view('backend.payment_methods.edit',
            compact('paymentMethod', 'title'));

    }


    /*** Update Function .*/
    public function update(PaymentMethodRequest $request, $id)
    {

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_payment_methods')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $paymentMethod = PaymentMethod::findOrFail($id);
        if (!$id || !$paymentMethod) {
            return redirect()->route('admin.payment_methods.index');
        }


        $paymentMethod->update($request->validated());

        return redirect()->route('admin.payment_methods.index')->with([
            'message' => __('common.update_success_message'),
            'alert-type' => 'success'
        ]);

    }


    /*** Remove the specified resource from storage.*/
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_payment_methods')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $paymentMethod = PaymentMethod::findOrFail($id);
        if (!$id || !$paymentMethod) {
            return redirect()->route('admin.payment_methods.index');
        }

        $paymentMethod->delete();

        return redirect()->route('admin.payment_methods.index')->with([
            'message' => __('common.delete_success_message'),
            'alert-type' => 'success'
        ]);
    }

}
