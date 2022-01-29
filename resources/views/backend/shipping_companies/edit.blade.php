@extends('layouts.admin')
@push('css')
    <style href="{!! asset('adminBoard/assets/plugins/custom/select2/css/select2.min.css') !!}" rel="stylesheet"/>
@endpush
@section('content')

    <form action="{!! route('admin.shipping_companies.update',$shippingCompany->id) !!}" method="post"
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
                            <a href="{!! route('admin.shipping_companies.index') !!}" class="text-muted">
                                {!! __('shipping_companies.shipping_companies') !!}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {!! __('shipping_companies.supervisor_update') !!}
                                -->
                                {!! $shippingCompany->name !!}
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
                                        {!! __('shipping_companies.name') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="name" name="name"
                                                   value="{!! old('name' , $shippingCompany->name) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('shipping_companies.enter_name') !!}"/>
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
                                        {!! __('shipping_companies.code') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="code" name="code"
                                                   value="{!! old('code', $shippingCompany->code) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('shipping_companies.enter_code') !!}"/>
                                        </div>
                                        @error('code')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('shipping_companies.description') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="description" name="description"
                                                   value="{!! old('description', $shippingCompany->description) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('shipping_companies.enter_description') !!}"/>
                                        </div>
                                        @error('description')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('shipping_companies.fast') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" name="fast" id="fast">
                                                <option
                                                    value="1" {{ old('fast', $shippingCompany->fast) == __('common.yes') ? 'selected' : null }}>
                                                    {!! __('common.yes') !!}
                                                </option>
                                                <option
                                                    value="0" {{ old('fast', $shippingCompany->fast) == __('common.no') ? 'selected' : null }}>
                                                    {!! __('common.no') !!}
                                                </option>
                                            </select>

                                        </div>
                                        @error('fast')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('shipping_companies.cost') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="cost" name="cost"
                                                   value="{!! old('cost', $shippingCompany->cost) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('shipping_companies.enter_cost') !!}"/>
                                        </div>
                                        @error('cost')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('shipping_companies.status') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" name="status" id="status">
                                                <option
                                                    value="1" {{ old('status', $shippingCompany->status) == __('common.active') ? 'selected' : null }}>
                                                    {!! __('common.active') !!}
                                                </option>
                                                <option
                                                    value="0" {{ old('status', $shippingCompany->status) == __('common.inactive') ? 'selected' : null }}>
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
                                        {!! __('shipping_companies.countries') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control select2 select_multiple_countries"
                                                    name="countries[]" id="countries"
                                                    multiple="multiple">
                                                @forelse($countries as $country)
                                                    <option value="{!! $country->id !!}"
                                                        {{ in_array($country->id, old('countries', $shippingCompany->countries->pluck('id')->toArray())) ? 'selected' : null }}>
                                                        {!! $country->name !!}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        @error('countries')
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

    <script>
        $(function () {
            function matchStart(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Skip if there is no 'children' property
                if (typeof data.children === 'undefined') {
                    return null;
                }

                // `data.children` contains the actual options that we are matching against
                var filteredChildren = [];
                $.each(data.children, function (idx, child) {
                    if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                        filteredChildren.push(child);
                    }
                });

                // If we matched any of the timezone group's children, then set the matched children on the group
                // and return the group object
                if (filteredChildren.length) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.children = filteredChildren;

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            }

            $('.select_multiple_countries').select2({
                tags: true,
                closeOnSelect: false,
                minimumResultsForSearch: Infinity,
                match: matchStart
            });
        });
    </script>
@endpush
