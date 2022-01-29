<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /*** Index Function*/
    public function index()
    {

        $title = __('products.products');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_products, show_products')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $products = Product::with('category', 'tags', 'firstMedia')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.products.index', compact('products','title'));
    }


    /*** Create Function */
    public function create()
    {
        $title = __('products.product_create');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_products')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $categories = ProductCategory::whereStatus(1)->get(['id', 'name']);
        $tags = Tag::whereStatus(1)->get(['id', 'name']);

        return view('backend.products.create', compact('categories', 'tags','title'));
    }


    /*** Store Function */
    public function store(ProductRequest $request)
    {

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_products')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_category_id' => $request->product_category_id,
            'featured' => $request->featured,
            'status' => $request->status,
        ]);

        ///////////////////////////////////////////////
        /// add multiple tags morph relation
        $product->tags()->attach($request->tags);

        ///////////////////////////////////////////////////////
        /// upload Multiple images
        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $image) {
                $file_name = $product->slug . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('adminBoard/uploaded_images/products/' . $file_name);

                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);

                $product->media()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => true,
                    'file_sort' => $i,
                ]);
                $i++;
            }
        }

        return redirect()->route('admin.products.index')->with([
            'message' => __('common.add_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_products')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('products.product_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_products')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $product = Product::findOrFail($id);
        if (!$id || !$product) {
            return redirect()->route('admin.products.index');
        }
        $categories = ProductCategory::whereStatus(1)->get(['id', 'name']);
        $tags = Tag::whereStatus(1)->get(['id', 'name']);

        return view('backend.products.edit', compact('product', 'categories', 'tags','title'));
    }


    /*** Update Function .*/
    public function update(ProductRequest $request, $id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_products')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $product = Product::findOrFail($id);
        if (!$id || !$product) {
            return redirect()->route('admin.products.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_category_id' => $request->product_category_id,
            'featured' => $request->featured,
            'status' => $request->status,
        ]);

        ///////////////////////////////////////////////
        /// add multiple tags morph relation
        $product->tags()->sync($request->tags);

        ///////////////////////////////////////////////////////
        /// upload Multiple images
        if ($request->images && count($request->images) > 0) {
            $i = $product->media()->count() + 1;
            foreach ($request->images as $image) {
                $file_name = $product->slug . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('adminBoard/uploaded_images/products/' . $file_name);

                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);

                $product->media()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => true,
                    'file_sort' => $i,
                ]);
                $i++;
            }
        }

        return redirect()->route('admin.products.index')->with([
            'message' => __('common.update_success_message'),
            'alert-type' => 'success'
        ]);

    }


    /*** destroy Function .*/
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_products')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $product  = Product::findOrFail($id);
        if (!$id || !$product) {
            return redirect()->route('admin.products.index');
        }

        if ($product->media()->count() > 0) {
            foreach ($product->media as $media) {
                if (File::exists('adminBoard/uploaded_images/products/'. $media->file_name)){
                    unlink('adminBoard/uploaded_images/products/'. $media->file_name);
                }
                $media->delete();
            }
        }


        $product->delete();

        return redirect()->route('admin.products.index')->with([
            'message' => __('common.delete_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Remove Image Function.*/
    public function removeImage(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_products')) {
            return redirect()->route('admin.index');
        }

        $product = Product::findOrFail($request->product_id);
        $image = $product->media()->whereId($request->image_id)->first();
        if (File::exists('adminBoard/uploaded_images/products/' . $image->file_name)) {
            unlink('adminBoard/uploaded_images/products/' . $image->file_name);
        }
        $image->delete();
        return true;
    }

}
