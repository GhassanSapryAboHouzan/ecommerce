<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SupervisorRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SupervisorsController extends Controller
{
    /*** Index Function*/
    public function index()
    {
        $title = __('supervisors.supervisors');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_supervisors, show_supervisors')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $supervisors = User::whereHas('roles', function ($query) {
            $query->where('name', 'supervisor');
        })
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.supervisors.index', compact('supervisors', 'title'));
    }


    /*** Create Function */
    public function create()
    {
        $title = __('supervisors.supervisor_create');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_supervisors')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $permissions = Permission::get(['id', 'display_name_ar', 'display_name_en']);
        return view('backend.supervisors.create', compact('title','permissions'));
    }


    /*** Store Function */
    public function store(SupervisorRequest $request)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_supervisors')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if ($image = $request->file('user_image')) {
            $file_name = Str::slug($request->username) . "." . $image->getClientOriginalExtension();
            $path = public_path('/adminBoard/uploaded_images/users/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
        } else {
            $file_name = null;
        }


        $supervisor = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'status' => $request->status,
            'password' => bcrypt($request->password),
            'user_image' => $file_name,
        ]);

        $supervisor->markEmailAsVerified();
        $supervisor->attachRole(Role::whereName('supervisor')->first()->id);
        // add permissions
        if (isset($request->permissions) && count($request->permissions) > 0) {
            $supervisor->permissions()->sync($request->permissions);
        }
        return redirect()->route('admin.supervisors.index')->with([
            'message' => __('common.add_success_message'),
            'alert-type' => 'success'
        ]);
    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_supervisors')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return view('backend.supervisors.show');

    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('supervisors.supervisor_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_supervisors')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $supervisor = User::findOrFail($id);
        if (!$id || !$supervisor) {
            return redirect()->route('admin.supervisors.index');
        }
        $permissions = Permission::get(['id', 'display_name_ar', 'display_name_en']);
        $supervisorPermissions = UserPermissions::whereUserId($supervisor->id)->pluck('permission_id')->toArray();
        return view('backend.supervisors.edit',
            compact('supervisor', 'title','permissions','supervisorPermissions'));

    }


    /*** Update Function .*/
    public function update(SupervisorRequest $request, $id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_supervisors')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $supervisor = User::findOrFail($id);
        if (!$id || !$supervisor) {
            return redirect()->route('admin.supervisors.index');
        }

        if ($image = $request->file('user_image')) {
            if ($supervisor->user_image != null && File::exists('adminBoard/uploaded_images/users/' . $supervisor->user_image)) {
                unlink('adminBoard/uploaded_images/users/' . $supervisor->user_image);
            }
            $file_name = Str::slug($request->username) . "." . $image->getClientOriginalExtension();
            $path = public_path('/adminBoard/uploaded_images/users/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

        } else {
            $file_name = $supervisor->user_image;
        }

        ///////////////////////////////////////////////
        /// update password
        if (trim($request->password) != '') {
            $password = bcrypt($request->password);
        } else {
            $password = $request->password;
        }

        $supervisor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'status' => $request->status,
            'password' => $password,
            'user_image' => $file_name,
        ]);

        // add permissions
        if (isset($request->permissions) && count($request->permissions) > 0) {
            $supervisor->permissions()->sync($request->permissions);
        }


        return redirect()->route('admin.supervisors.index')->with([
            'message' => __('common.update_success_message'),
            'alert-type' => 'success'
        ]);

    }


    /*** Remove the specified resource from storage.*/
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_supervisors')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $supervisor = User::findOrFail($id);
        if (!$id || !$supervisor) {
            return redirect()->route('admin.supervisors.index');
        }

        if ($supervisor->user_image != '') {
            if (File::exists('adminBoard/uploaded_images/users/' . $supervisor->user_image)) {
                unlink('adminBoard/uploaded_images/users/' . $supervisor->user_image);
            }
        }

        $supervisor->delete();
        return redirect()->route('admin.supervisors.index')->with(['message' => __('common.delete_success_message'),
            'alert-type' => 'success']);
    }


    /*** Remove Image Function .*/
    public
    function removeImage(Request $request)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_supervisors')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $supervisor = User::findOrFail($request->supervisor_id);
        if (!$supervisor) {
            return redirect()->route('admin.supervisors.index');
        }
        if (File::exists('adminBoard/uploaded_images/users/' . $supervisor->user_image)) {
            unlink('adminBoard/uploaded_images/users/' . $supervisor->user_image);
            $supervisor->user_image = null;
            $supervisor->save();
        }
        return true;
    }
}
