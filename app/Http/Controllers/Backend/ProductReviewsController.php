<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductReviewRequest;
use App\Models\ProductReview;


class ProductReviewsController extends Controller
{
    /*** Index Function */
    public function index()
    {
        $title = __('product_reviews.product_reviews');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_product_reviews, show_product_reviews')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $reviews = ProductReview::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.product_reviews.index', compact('reviews', 'title'));
    }


    /*** Create Function */
    public function create()
    {
        $title = __('product_reviews.product_review_create');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_product_reviews')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        return view('backend.product_reviews.create', compact('title'));
    }


    /*** Store Function */
    public function store(ProductReviewRequest $request)
    {

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_product_reviews')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ProductReview::create($request->validated());

        return redirect()->route('admin.product_reviews.index')->with([
            'message' => __('common.add_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_product_reviews')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $title = __('product_reviews.product_review_show');
        $productReview = ProductReview::findOrFail($id);
        if (!$id || !$productReview) {
            return redirect()->route('admin.product_reviews.index');
        }
        return view('backend.product_reviews.show', compact('id', 'productReview', 'title'));

    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('product_reviews.product_review_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_product_reviews')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $productReview = ProductReview::findOrFail($id);
        if (!$id || !$productReview) {
            return redirect()->route('admin.product_reviews.index');
        }
        return view('backend.product_reviews.edit', compact('productReview', 'title'));

    }


    /*** Update Function .*/
    public function update(ProductReviewRequest $request, $id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_product_reviews')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $productReview = ProductReview::findOrFail($id);
        if (!$id || !$productReview) {
            return redirect()->route('admin.product_reviews.index');
        }

        $productReview->update($request->validated());

        return redirect()->route('admin.product_reviews.index')->with([
            'message' => __('common.update_success_message'),
            'alert-type' => 'success'
        ]);

    }


    /*** Remove the specified resource from storage.*/
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_product_reviews')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $productReview = ProductReview::findOrFail($id);
        if (!$id || !$productReview) {
            return redirect()->route('admin.product_reviews.index');
        }

        $productReview->delete();

        return redirect()->route('admin.product_reviews.index')->with([
            'message' => __('common.delete_success_message'),
            'alert-type' => 'success'
        ]);
    }


}
