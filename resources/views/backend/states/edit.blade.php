@extends('layouts.admin')
@section('content')

    <form action="{!! route('admin.states.update',$state->id) !!}" method="post"
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
                            <a href="{!! route('admin.states.index') !!}" class="text-muted">
                                {!! __('states.states') !!}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {!! __('states.state_update') !!}
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
                        {!! __('common.update') !!}
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
                                        {!! __('states.name') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="name" name="name" value="{!! old('name', $state->name) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('states.enter_name') !!}"/>
                                        </div>
                                        @error('name')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('states.country_id') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" name="country_id" id="country_id">
                                                <option value="">{!! __('common.choose_from_list') !!}</option>
                                                @forelse($countries as $country)
                                                    <option
                                                        value="{!! $country->id !!}"
                                                        {{ old('country_id', $state->country_id) == $country->id ? 'selected' : null }}>
                                                        {!! $country->name !!}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>

                                        </div>
                                        @error('country_id')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('states.status') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" name="status" id="status">
                                                <option
                                                    value="1" {{ old('status', $state->status) == __('common.active') ? 'selected' : null }}>
                                                    {!! __('common.active') !!}
                                                </option>
                                                <option
                                                    value="0" {{ old('status', $state->status) == __('common.inactive') ? 'selected' : null }}>
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

