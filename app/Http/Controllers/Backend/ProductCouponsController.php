<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCouponRequest;
use App\Models\ProductCoupon;

class ProductCouponsController extends Controller
{
    /*** Index Function*/
    public function index()
    {
        $title = __('product_coupons.product_coupons');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_product_coupons, show_product_coupons')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $coupons = ProductCoupon::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.product_coupons.index', compact('title', 'coupons'));
    }


    /*** Create Function */
    public function create()
    {
        $title = __('product_coupons.product_coupon_create');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_product_coupons')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        return view('backend.product_coupons.create', compact('title'));
    }

    /*** Store Function */
    public function store(ProductCouponRequest $request)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_product_coupons')) {
            return redirect()->route('admin.index');
        }

        ProductCoupon::create($request->validated());

        return redirect()->route('admin.product_coupons.index')->with([
            'message' => __('common.add_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_product_coupons')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return view('backend.product_coupons.show');
    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('product_coupons.product_coupon_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_product_coupons')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $productCoupon = ProductCoupon::findORFail($id);
        if (!$id || !$productCoupon) {
            return redirect()->route('admin.product_coupons.index');
        }
        return view('backend.product_coupons.edit', compact('productCoupon', 'title'));

    }


    /*** Update Function .*/
    public function update(ProductCouponRequest $request, $id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_product_coupons')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $productCoupon = ProductCoupon::findORFail($id);
        if (!$id || !$productCoupon) {
            return redirect()->route('admin.product_coupons.index');
        }

        $productCoupon->update($request->validated());

        return redirect()->route('admin.product_coupons.index')->with([
            'message' => __('common.update_success_message'),
            'alert-type' => 'success'
        ]);

    }


    /*** Remove the specified resource from storage.*/
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_product_coupons')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $productCoupon = ProductCoupon::findOrFail($id);
        if (!$id || !$productCoupon) {
            return redirect()->route('admin.product_coupons.index');
        }

        $productCoupon->delete();

        return redirect()->route('admin.product_coupons.index')->with([
            'message' => __('common.delete_success_message'),
            'alert-type' => 'success'
        ]);
    }

}
