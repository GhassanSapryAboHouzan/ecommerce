@extends('layouts.admin')
@section('content')

    <form action="{!! route('admin.product_reviews.update',$productReview->id) !!}" method="post"
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
                            <a href="{!! route('admin.product_reviews.index') !!}" class="text-muted">
                                {!! __('product_reviews.product_reviews') !!}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {!! __('product_reviews.product_review_update') !!}
                                -->
                                {!! $productReview->product->name !!}
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
                                        {!! __('product_reviews.name') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="name" name="name"
                                                   value="{!! old('name', $productReview->name) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('product_reviews.enter_name') !!}"/>
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
                                        {!! __('product_reviews.email') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="email" name="email"
                                                   value="{!! old('email', $productReview->email) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('product_reviews.enter_email') !!}"/>
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
                                        {!! __('product_reviews.rating') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" id="rating" name="rating">
                                                <option
                                                    value="1" {{ old('rating', $productReview->rating) == '1' ? 'selected' : null }}>
                                                    1
                                                </option>
                                                <option
                                                    value="2" {{ old('rating', $productReview->rating) == '2' ? 'selected' : null }}>
                                                    2
                                                </option>
                                                <option
                                                    value="3" {{ old('rating', $productReview->rating) == '3' ? 'selected' : null }}>
                                                    3
                                                </option>
                                                <option
                                                    value="4" {{ old('rating', $productReview->rating) == '4' ? 'selected' : null }}>
                                                    4
                                                </option>
                                                <option
                                                    value="5" {{ old('rating', $productReview->rating) == '5' ? 'selected' : null }}>
                                                    5
                                                </option>
                                            </select>
                                        </div>
                                        @error('rating')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('product_reviews.product_id') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" readonly
                                                   value="{!! $productReview->product->name !!}"/>
                                            <input type="hidden" class="form-control"
                                                   id="product_id" name="product_id"
                                                   value="{!! $productReview->product_id !!}"/>
                                        </div>
                                        @error('product_id')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->

                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('product_reviews.user_id') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" readonly
                                                   value="{!! $productReview->user_id != '' ? $productReview->user->full_name : '' !!}"/>
                                            <input type="hidden" class="form-control"
                                                   id="user_id" name="user_id"
                                                   value="{!! $productReview->user_id !!}"/>
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
                                        {!! __('product_reviews.status') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <select class="form-control" name="status" id="status">
                                                <option
                                                    value="1" {{ old('status', $productReview->status) == __('common.active') ? 'selected' : null }}>
                                                    {!! __('common.active') !!}
                                                </option>
                                                <option
                                                    value="0" {{ old('status', $productReview->status) == __('common.inactive') ? 'selected' : null }}>
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
                                        {!! __('product_reviews.title') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="title" name="title"
                                                   value="{!! old('title', $productReview->title) !!}"
                                                   autocomplete="off"
                                                   placeholder="{!! __('product_reviews.enter_title') !!}"/>
                                        </div>
                                        @error('title')
                                        <span class="form-text text-danger">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->


                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-2 col-form-label">
                                        {!! __('product_reviews.message') !!}
                                    </label>
                                    <div class="col-lg-10 col-xl-10">
                                        <div class="input-group">
                                            <textarea type="message" class="form-control" rows="5"
                                                      id="message" name="message"
                                                      autocomplete="off"
                                                      placeholder="{!! __('product_reviews.enter_message') !!}"
                                            >{!! old('message', $productReview->message) !!}</textarea>
                                        </div>
                                        @error('message')
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

