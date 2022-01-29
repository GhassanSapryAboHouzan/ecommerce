@extends('layouts.admin')
@section('content')

    <form action="{!! route('admin.customer_addresses.store') !!}" method="post"
          enctype="multipart/form-data">
    @csrf

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
                            <a href="{!! route('admin.customer_addresses.index') !!}" class="text-muted">
                                {!! __('customer_addresses.customer_addresses') !!}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {!! __('customer_addresses.customer_address_create') !!}
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
                                        {!! __('customer_addresses.customer') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control typeahead"
                                                   id="customer_name" name="customer_name"
                                                   value="{!! old('customer_name', request()->input('customer_name')) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('customer_addresses.start_typing_something_to_search_customer') !!}"/>

                                            <input type="hidden" class="form-control"
                                                   id="user_id" name="user_id"
                                                   value="{!! old('user_id' , request()->input('user_id')) !!}"
                                                   readonly/>
                                        </div>
                                        @error('user_id')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('customer_addresses.address_title') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="address_title" name="address_title"
                                                   value="{!! old('address_title') !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('customer_addresses.enter_address_title') !!}"/>
                                        </div>
                                        @error('address_title')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('customer_addresses.default_address') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" name="default_address" id="default_address">
                                                <option
                                                    value="1" {{ old('default_address', request()->input('default_address')) == '1' ? 'selected' : '' }}>
                                                    {!! __('common.active') !!}
                                                </option>
                                                <option
                                                    value="0" {{ old('default_address', request()->input('default_address')) == '0' ? 'selected' : '' }}>
                                                    {!! __('common.inactive') !!}
                                                </option>
                                            </select>

                                        </div>
                                        @error('default_address')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('customer_addresses.first_name') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="first_name" name="first_name"
                                                   value="{!! old('first_name') !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('customer_addresses.enter_first_name') !!}"/>
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
                                        {!! __('customer_addresses.last_name') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="last_name" name="last_name"
                                                   value="{!! old('last_name') !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('customer_addresses.enter_last_name') !!}"/>
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
                                        {!! __('customer_addresses.email') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="email" name="email"
                                                   value="{!! old('email') !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('customer_addresses.enter_email') !!}"/>
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
                                        {!! __('customer_addresses.mobile') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="mobile" name="mobile"
                                                   value="{!! old('mobile') !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('customer_addresses.enter_mobile') !!}"/>
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
                                        {!! __('customer_addresses.address') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="address" name="address"
                                                   value="{!! old('address') !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('customer_addresses.enter_address') !!}"/>
                                        </div>
                                        @error('address')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->

                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('customer_addresses.address2') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="address2" name="address2"
                                                   value="{!! old('address2') !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('customer_addresses.enter_address2') !!}"/>
                                        </div>
                                        @error('address2')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->

                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('customer_addresses.zip_code') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="zip_code" name="zip_code"
                                                   value="{!! old('zip_code') !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('customer_addresses.enter_zip_code') !!}"/>
                                        </div>
                                        @error('zip_code')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->

                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('customer_addresses.po_box') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="po_box" name="po_box"
                                                   value="{!! old('po_box') !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('customer_addresses.enter_po_box') !!}"/>
                                        </div>
                                        @error('po_box')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('customer_addresses.country_id') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" id="country_id" name="country_id">
                                                @forelse($countries as $country)
                                                    <option value="{!! $country->id !!}"
                                                        {{ old('country_id') == $country->id ? 'selected' : null }}>
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
                                        {!! __('customer_addresses.state_id') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" id="state_id" name="state_id">
                                            </select>
                                        </div>
                                        @error('state_id')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->

                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('customer_addresses.city_id') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" id="city_id" name="city_id">
                                            </select>
                                        </div>
                                        @error('city_id')
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
            src="{!! asset('adminBoard/assets/plugins/custom/typeahead/bootstrap3-typeahead.min.js') !!}"></script>
    <script>
        $(function () {
            ///////////////////////////////////////////////////////////////////////////
            /// typeahead
            $(".typeahead").typeahead({
                autoSelect: true,
                minLength: 3,
                delay: 400,
                displayText: function (item) {
                    return item.full_name + ' - ' + item.email;
                },
                source: function (query, process) {
                    return $.get("{{ route('admin.customers.get_customers') }}", {'query': query}, function (data) {
                        return process(data);
                    });
                },
                afterSelect: function (data) {
                    $('#user_id').val(data.id);
                }
            });


            populateStates();
            populateCities();

            ///////////////////////////////////////////////////////////////////////////
            /// country change
            $("#country_id").change(function () {
                populateStates();
                populateCities();
                return false;
            });

            ///////////////////////////////////////////////////////////////////////////
            /// state change
            $("#state_id").change(function () {
                populateCities();
                return false;
            });


            ///////////////////////////////////////////////////////////////////////////
            /// states populate
            function populateStates() {
                let countryIdVal = $('#country_id').val() != null ? $('#country_id').val() : '{{ old('country_id') }}';
                $.get("{{ route('admin.states.get_states') }}", {country_id: countryIdVal}, function (data) {
                    $('option', $("#state_id")).remove();
                    $("#state_id").append($('<option></option>').val('').html(' --- '));
                    $.each(data, function (val, text) {
                        let selectedVal = text.id == '{{ old('state_id') }}' ? "selected" : "";
                        $("#state_id").append($('<option ' + selectedVal + '></option>').val(text.id).html(text.name));
                    });
                }, "json");
            }

            ///////////////////////////////////////////////////////////////////////////
            /// cities populate
            function populateCities() {
                let stateIdVal = $('#state_id').val() != null ? $('#state_id').val() : '{{ old('state_id') }}';
                $.get("{{ route('admin.cities.get_cities') }}", {state_id: stateIdVal}, function (data) {
                    $('option', $("#city_id")).remove();
                    $("#city_id").append($('<option></option>').val('').html(' --- '));
                    $.each(data, function (val, text) {
                        let selectedVal = text.id == '{{ old('city_id') }}' ? "selected" : "";
                        $("#city_id").append($('<option ' + selectedVal + '></option>').val(text.id).html(text.name));
                    });
                }, "json");
            }


        });
    </script>
@endpush

