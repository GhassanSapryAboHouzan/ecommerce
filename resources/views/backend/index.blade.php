@extends('layouts.admin')
@section('content')
    <style>
        .card_name_span {
            font-size: 18px
        }
    </style>

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div
            class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

                <!--begin::Page Title-->
                <span class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    {{trans('dashboard.dashboard')}}
                </span>
                <!--end::Page Title-->

                <!--begin::Actions-->

            </div>
            <!--end::Info-->

        </div>
    </div>
    <!--end::Subheader-->



    <!--begin::content-->
    <div class="d-flex flex-column-fluid" style="margin-bottom: 5px">


        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Counters-->


            <livewire:backend.dashboard.statistices-component/>


            <!--end::Counters-->


            <!--begin::Flow Charts-->
            <div class="card card-custom  ">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                </div>
                <livewire:backend.dashboard.charts-component/>



                <!--end::Body-->
            </div>
            <!--end::Last Courses-->


        </div>
        <!--end::Container-->

    </div>
    <!--end::content-->





@endsection

