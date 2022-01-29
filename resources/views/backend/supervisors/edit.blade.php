@extends('layouts.admin')
@push('css')
    <style href="{!! asset('adminBoard/assets/plugins/custom/select2/css/select2.min.css') !!}" rel="stylesheet"/>
@endpush
@section('content')

    <form action="{!! route('admin.supervisors.update',$supervisor->id) !!}" method="post"
          enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div
                class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">

                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <!--begin::Actions-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{!! route('admin.supervisors.index') !!}" class="text-muted">
                                {!! __('supervisors.supervisors') !!}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {!! __('supervisors.supervisor_update') !!}
                                -->
                                {!! $supervisor->full_name !!}
                            </a>
                        </li>
                    </ul>

                    <!--end::Actions-->
                </div>
                <!--end::Info-->

                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary btn-sm font-weight-bold font-size-base mr-1">
                        <i class="fa fa-save"></i>
                        {!! __('common.save') !!}
                    </button>
                    &nbsp;
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->

        <!--begin::content-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div class="card card-custom card-shadowless rounded-top-0">
                            <div class="card-body pt-20 pb-20">
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('supervisors.first_name') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="first_name" name="first_name"
                                                   value="{!! old('first_name' , $supervisor->first_name) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('supervisors.enter_first_name') !!}"/>
                                        </div>
                                        @error('first_name')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->

                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('supervisors.last_name') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="last_name" name="last_name"
                                                   value="{!! old('last_name', $supervisor->last_name) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('supervisors.enter_last_name') !!}"/>
                                        </div>
                                        @error('last_name')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('supervisors.username') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="username" name="username"
                                                   value="{!! old('username', $supervisor->username) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('supervisors.enter_username') !!}"/>
                                        </div>
                                        @error('username')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('supervisors.email') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="email" name="email"
                                                   value="{!! old('email', $supervisor->email) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('supervisors.enter_email') !!}"/>
                                        </div>
                                        @error('email')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('supervisors.mobile') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="mobile" name="mobile"
                                                   value="{!! old('mobile', $supervisor->mobile) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('supervisors.enter_mobile') !!}"/>
                                        </div>
                                        @error('mobile')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('supervisors.password') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="password" class="form-control"
                                                   id="password" name="password" value="{!! old('password') !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('supervisors.enter_password') !!}"/>
                                        </div>
                                        @error('password')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('supervisors.status') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" name="status" id="status">
                                                <option
                                                    value="1" {{ old('status', $supervisor->status) == __('common.active') ? 'selected' : null }}>
                                                    {!! __('common.active') !!}
                                                </option>
                                                <option
                                                    value="0" {{ old('status', $supervisor->status) == __('common.inactive') ? 'selected' : null }}>
                                                    {!! __('common.inactive') !!}
                                                </option>
                                            </select>

                                        </div>
                                        @error('status')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->



                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('supervisors.permissions') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control select2 select_multiple_permissions"
                                                    name="permissions[]" id="permissions"
                                                    multiple="multiple">
                                                @forelse($permissions as $permission)
                                                    <option value="{!! $permission->id !!}"
                                                            {{ in_array($permission->id, old('permissions', $supervisorPermissions)) ? 'selected' : null }} }}>
                                                        {!! Lang()=='ar'?$permission->display_name_ar:$permission->display_name_en !!}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>

                                        </div>
                                        @error('permissions')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('supervisors.user_image') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <input class="file-input-overview " type="file" name="user_image"
                                               id="supervisor_image"
                                               placeholder="{!! __('common.select_file') !!}">
                                        <span class="text text-muted">{!! __('supervisors.image_size') !!}</span>
                                        @error('user_image')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->


                            </div>
                            <!--end::Card-->
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->

                <!--begin::Form-->
            </div>
            <!--end::content-->
        </div>
    </form>
@endsection
@push('js')
    <script type="text/javascript"
            src="{!! asset('adminBoard/assets/plugins/custom/select2/js/select2.full.min.js') !!}"></script>

    <script type="text/javascript">
        $(function () {
            //////////////////////////////////////////////////////////////////////////
            // select2  multiple permissions
            $('.select_multiple_permissions').select2({
                minimumResultsForSearch: Infinity,
                tags: true,
                closeOnSelect: false
            });


            $("#supervisor_image").fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if($supervisor->user_image != '')
                        "{{ asset('adminBoard/uploaded_images/users/' . $supervisor->user_image) }}",
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                        @if($supervisor->user_image != '')
                    {
                        caption: "{{ $supervisor->user_image }}",
                        size: '1111',
                        width: "120px",
                        url: "{{ route('admin.supervisors.remove_image', ['supervisor_id' => $supervisor->id, '_token' => csrf_token()]) }}",
                        key: {{ $supervisor->id }}
                    }
                    @endif
                ]
            });
        });
    </script>
@endpush
