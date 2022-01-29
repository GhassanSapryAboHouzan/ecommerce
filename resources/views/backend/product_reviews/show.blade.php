@extends('layouts.admin')
@section('content')
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
                            {{trans('product_reviews.product_reviews')}}
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">
                            {{trans('product_reviews.product_review_show')}}
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">
                            {!! $productReview->name !!}
                        </a>
                    </li>

                </ul>

                <!--end::Actions-->
            </div>
            <!--end::Info-->



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
                    <div class="card card-custom">
                        <div class="card-body">



                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive ">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th>{!! __('product_reviews.name') !!}</th>
                                                    <td>{{ $productReview->name }}</td>
                                                    <th>{!! __('product_reviews.email') !!}</th>
                                                    <td>{{ $productReview->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{!! __('product_reviews.customer_name') !!}</th>
                                                    <td>{{ $productReview->user_id != '' ? $productReview->user->name : '' }}</td>
                                                    <th>{!! __('product_reviews.rating') !!}</th>
                                                    <td>{{ $productReview->rating }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{!! __('product_reviews.title') !!}</th>
                                                    <td colspan="3">{{ $productReview->title }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{!! __('product_reviews.message') !!}</th>
                                                    <td colspan="3">{{ $productReview->message }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{!! __('product_reviews.created_date') !!}</th>
                                                    <td colspan="3">{{ $productReview->created_at->format('Y-m-d') }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: table-->
                        </div>

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
@endsection
