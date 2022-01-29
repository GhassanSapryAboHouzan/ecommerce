@extends('layouts.admin')
@push('css')
    <style>
        .picker__select--month, .picker__select--year {
            padding: 0 !important;
        }
    </style>
@endpush
@section('content')

    <form action="{!! route('admin.product_coupons.update',$productCoupon->id) !!}" method="post"
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
                            <a href="{!! route('admin.product_coupons.index') !!}" class="text-muted">
                                {!! __('product_coupons.product_coupons') !!}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {!! __('product_coupons.product_coupon_update') !!}
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
                                        {!! __('product_coupons.code') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="code" name="code"
                                                   value="{!! old('code',$productCoupon->code) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('product_coupons.enter_code') !!}"/>
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
                                        {!! __('product_coupons.type') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" name="type" id="type">
                                                <option
                                                    value="fixed" {{ old('type',$productCoupon->type) == 'fixed' ? 'selected' : '' }}>
                                                    {!! __('product_coupons.fixed') !!}
                                                </option>
                                                <option
                                                    value="percentage" {{ old('type',$productCoupon->type) == 'percentage' ? 'selected' : '' }}>
                                                    {!! __('product_coupons.percentage') !!}
                                                </option>
                                            </select>

                                        </div>
                                        @error('type')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('product_coupons.value') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="value" name="value" value="{!! old('value',$productCoupon->value) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('product_coupons.enter_value') !!}"/>
                                        </div>
                                        @error('value')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('product_coupons.use_times') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control"
                                                   id="use_times" name="use_times" value="{!! old('use_times',$productCoupon->use_times) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('product_coupons.enter_use_times') !!}"/>
                                        </div>
                                        @error('use_times')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('product_coupons.start_date') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="start_date" name="start_date"
                                                   value="{!! old('start_date',$productCoupon->start_date->format('Y-m-d')) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('product_coupons.enter_start_date') !!}"/>
                                        </div>
                                        @error('start_date')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->

                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('product_coupons.expire_date') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="expire_date" name="expire_date"
                                                   value="{!! old('expire_date',$productCoupon->expire_date->format('Y-m-d')) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('product_coupons.enter_expire_date') !!}"/>
                                        </div>
                                        @error('expire_date')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('product_coupons.greater_than') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control"
                                                   id="greater_than" name="greater_than"
                                                   value="{!! old('greater_than',$productCoupon->greater_than) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('product_coupons.enter_greater_than') !!}"/>
                                        </div>
                                        @error('greater_than')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->

                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('product_coupons.status') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" name="status" id="status">
                                                <option
                                                    value="1" {{ old('status',$productCoupon->status) == '1' ? 'selected' : '' }}>
                                                    {!! __('common.active') !!}
                                                </option>
                                                <option
                                                    value="0" {{ old('status',$productCoupon->status) == '0' ? 'selected' : '' }}>
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
                                        {!! __('product_coupons.description') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <textarea class="form-control" rows="3"
                                                      id="description" name="description"
                                                      placeholder="{!! __('product_coupons.enter_description') !!}"
                                            >{!! old('description',$productCoupon->description) !!}</textarea>
                                        </div>
                                        @error('description')
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
    <script type="text/javascript">
        $(function () {

            $('#code').keyup(function () {
                this.value = this.value.toUpperCase();
            });

            $('#start_date').pickadate({
                format: 'yyyy-mm-dd',
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // Creates a dropdown to control year
                clear: '{!! __('common.clear') !!}',
                close: '{!! __('common.ok') !!}',
                closeOnSelect: true // Close upon selecting a date,
            });


            var startdate = $('#start_date').pickadate('picker');
            var enddate = $('#expire_date').pickadate('picker');

            // to make expire date after start date
            $('#start_date').change(function () {
                selected_ci_date = "";
                selected_ci_date = $('#start_date').val();
                if (selected_ci_date != null) {
                    var cidate = new Date(selected_ci_date);
                    min_codate = "";
                    min_codate = new Date();
                    min_codate.setDate(cidate.getDate() + 1);
                    enddate.set('min', min_codate);
                }
            });


            $('#expire_date').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // Creates a dropdown to control month
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true // Close upon selecting a date,
            });

        })
    </script>
@endpush
