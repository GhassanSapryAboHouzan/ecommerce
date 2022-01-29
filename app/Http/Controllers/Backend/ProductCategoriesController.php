<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductCategoriesController extends Controller
{
    /*** Index Function*/
    public function index()
    {
        $title = __('product_categories.product_categories');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_product_categories, show_product_categories')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $categories = ProductCategory::withCount('products')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.product_categories.index', compact('categories', 'title'));
    }


    /*** Create Function */
    public function create()
    {
        $title = __('product_categories.product_category_create');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_product_categories')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $main_categories = ProductCategory::whereNull('parent_id')->get(['id', 'name']);
        return view('backend.product_categories.create', compact('main_categories', 'title'));
    }


    /*** Store Function */
    public function store(ProductCategoryRequest $request)
    {

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_product_categories')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if ($image = $request->file('image')) {
            $file_name = Str::slug($request->name) . "." . $image->getClientOriginalExtension();
            $path = public_path('/adminBoard/uploaded_images/product_categories/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
        }


        ProductCategory::create([
            'name' => $request->name,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'image' => $file_name,
        ]);

        return redirect()->route('admin.product_categories.index')->with([
            'message' => __('common.add_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_product_categories')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return view('backend.product_categories.show');

    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('product_categories.product_category_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_product_categories')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $productCategory = ProductCategory::findOrFail($id);
        if (!$id || !$productCategory) {
            return redirect()->route('admin.product_categories.index');
        }
        $main_categories = ProductCategory::whereNull('parent_id')->get(['id', 'name']);

        return view('backend.product_categories.edit',
            compact('main_categories', 'productCategory', 'title'));

    }


    /*** Update Function .*/
    public function update(ProductCategoryRequest $request, $id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_product_categories')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $productCategory = ProductCategory::findOrFail($id);
        if (!$id || !$productCategory) {
            return redirect()->route('admin.product_categories.index');
        }

        if ($image = $request->file('image')) {
            if ($productCategory->image != null && File::exists('adminBoard/uploaded_images/product_categories/' . $productCategory->image)) {
                unlink('adminBoard/uploaded_images/product_categories/' . $productCategory->image);
            }
            $file_name = Str::slug($request->name) . "." . $image->getClientOriginalExtension();
            $path = public_path('/adminBoard/uploaded_images/product_categories/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

        } else {
            $file_name = $productCategory->image;
        }

        $productCategory->update([
            'name' => $request->name,
            'slug' => null,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'image' => $file_name,
        ]);

        return redirect()->route('admin.product_categories.index')->with([
            'message' => __('common.update_success_message'),
            'alert-type' => 'success'
        ]);

    }


    /*** Remove the specified resource from storage.*/
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_product_categories')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $productCategory = ProductCategory::findOrFail($id);
        if (!$id || !$productCategory) {
            return redirect()->route('admin.product_categories.index');
        }

        if (File::exists('adminBoard/uploaded_images/product_categories/' . $productCategory->image)) {
            unlink('adminBoard/uploaded_images/product_categories/' . $productCategory->image);
        }

        $productCategory->delete();

        return redirect()->route('admin.product_categories.index')->with([
            'message' => __('common.delete_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Remove Image Function .*/

    public function removeImage(Request $request)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_product_categories')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $category = ProductCategory::findOrFail($request->product_category_id);
        if (File::exists('adminBoard/uploaded_images/product_categories/' . $category->image)) {
            unlink('adminBoard/uploaded_images/product_categories/' . $category->image);
            $category->image = null;
            $category->save();
        }
        return true;
    }
}
