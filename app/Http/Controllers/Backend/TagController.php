<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TagRequest;
use App\Models\Tag;


class TagController extends Controller
{
    /*** Index Function*/
    public function index()
    {
        $title = __('tags.tags');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_tags, show_tags')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $tags = Tag::with('products')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.tags.index', compact('tags', 'title'));
    }


    /*** Create Function */
    public function create()
    {
        $title = __('tags.tag_create');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_tags')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        return view('backend.tags.create', compact('title'));
    }


    /*** Store Function */
    public function store(TagRequest $request)
    {

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_tags')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        Tag::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.tags.index')->with([
            'message' => __('common.add_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_tags')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return view('backend.tags.show');

    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('tags.tag_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_tags')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $tag = Tag::findOrFail($id);
        if (!$id || !$tag) {
            return redirect()->route('admin.tags.index');
        }
        return view('backend.tags.edit', compact('tag', 'title'));

    }


    /*** Update Function */
    public function update(TagRequest $request, $id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_tags')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $tag = Tag::findOrFail($id);
        if (!$id || !$tag) {
            return redirect()->route('admin.tags.index');
        }


        $tag->update([
            'name' => $request->name,
            'slug' => null,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.tags.index')->with([
            'message' => __('common.update_success_message'),
            'alert-type' => 'success'
        ]);

    }


    /*** destroy */
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_tags')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $tag = Tag::findOrFail($id);
        if (!$id || !$tag) {
            return redirect()->route('admin.tags.index');
        }
        $tag->delete();
        return redirect()->route('admin.tags.index')->with([
            'message' => __('common.delete_success_message'),
            'alert-type' => 'success'
        ]);
    }

}
