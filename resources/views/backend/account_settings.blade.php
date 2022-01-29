@extends('layouts.admin')
@section('content')
    <form action="{!! route('admin.update.account.settings',auth()->user()->id) !!}" method="post"
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
                            <a href="" class="text-muted">
                                {!! __('dashboard.account_settings') !!}
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

                            <div class="card-body pt-10 pb-10">
                            @include('backend.includes.message')


                            <!--begin::Group-->
                                <div class="form-group row pt-10 pb-10">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('users.first_name') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="first_name" name="first_name"
                                                   value="{!! old('first_name' , auth()->user()->first_name) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('users.enter_first_name') !!}"/>
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
                                        {!! __('users.last_name') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="last_name" name="last_name"
                                                   value="{!! old('last_name', auth()->user()->last_name) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('users.enter_last_name') !!}"/>
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
                                        {!! __('users.username') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="username" name="username"
                                                   value="{!! old('username', auth()->user()->username) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('users.enter_username') !!}"/>
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
                                        {!! __('users.email') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="email" name="email"
                                                   value="{!! old('email', auth()->user()->email) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('users.enter_email') !!}"/>
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
                                        {!! __('users.mobile') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="mobile" name="mobile"
                                                   value="{!! old('mobile', auth()->user()->mobile) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('users.enter_mobile') !!}"/>
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
                                        {!! __('users.password') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="password" class="form-control"
                                                   id="password" name="password" value="{!! old('password') !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('users.enter_password') !!}"/>
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
                                        {!! __('users.user_image') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <input class="file-input-overview " type="file" name="user_image"
                                               id="user_image"
                                               placeholder="{!! __('common.select_file') !!}">
                                        <span class="text text-muted">{!! __('users.image_size') !!}</span>
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
        <!--end::content-->


    </form>

@endsection

@push('js')
    <script type="text/javascript">
        $(function () {
            $("#user_image").fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if(auth()->user()->user_image != '')
                        "{{ asset('adminBoard/uploaded_images/users/' . auth()->user()->user_image) }}",
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                        @if(auth()->user()->user_image != '')
                    {
                        caption: "{{ auth()->user()->user_image }}",
                        size: '1111',
                        width: "120px",
                        url: "{{ route('admin.account_settings.user.remove_image', ['user_id' => auth()->user()->id, '_token' => csrf_token()]) }}",
                        key: {{ auth()->user()->id }}
                    }
                    @endif
                ]
            });
        });
    </script>
@endpush
