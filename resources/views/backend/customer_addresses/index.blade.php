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
                        <a href="javascript:void(0);" class="text-muted">
                            {{trans('customer_addresses.customer_addresses')}}
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">
                            {!!  __('common.show_all') !!}
                        </a>
                    </li>
                </ul>

                <!--end::Actions-->
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->
            @ability('admin', 'create_customer_addresses')
            <div class="d-flex align-items-center">
                <a href="{!! route('admin.customer_addresses.create') !!}"
                   class="btn btn-primary btn-sm font-weight-bold font-size-base  mr-1">
                    <i class="fa fa-plus-square"></i>
                    {!! __('common.add_new') !!}
                </a>
                &nbsp;
            </div>
            @endability
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
                    <div class="card card-custom">
                        <div class="card-body">

                            @include('backend.includes.message')

                            @include('backend.customer_addresses.filter.filter')

                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive text-center ">
                                            <table class="table table-borderless"
                                                   style="text-align: center;vertical-align: middle;">
                                                <thead>
                                                <tr>
                                                    <th>{!! __('customer_addresses.customer') !!}</th>
                                                    <th>{!! __('customer_addresses.address_title') !!}</th>
                                                    <th>{!! __('customer_addresses.shipping_info') !!}</th>
                                                    <th>{!! __('customer_addresses.address') !!}</th>
                                                    <th>{!! __('customer_addresses.zip_code') !!}</th>
                                                    <th>{!! __('customer_addresses.po_box') !!}</th>
                                                    <th class="text-center">{!! __('customer_addresses.actions') !!}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($customer_addresses as $customer_address)
                                                    <tr>
                                                        <td>
                                                            <a href="{!! route('admin.customers.show',$customer_address->user_id) !!}">
                                                                {!! $customer_address->user->full_name !!}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{!! route('admin.customer_addresses.show',$customer_address->id) !!}">
                                                                {!! $customer_address->address_title !!}
                                                            </a>
                                                            <p class="text-gray-400">{!! $customer_address->default_address !!}</p>
                                                        </td>
                                                        <td>
                                                            {!! $customer_address->first_name !!} {!! $customer_address->last_name !!}
                                                            <p class="text-gray-400">
                                                                {!! $customer_address->email !!}
                                                                <br/>
                                                                {!! $customer_address->mobile !!}
                                                            </p>
                                                        </td>

                                                        <td>{!! $customer_address->country->name !!} -
                                                            {!! $customer_address->state->name !!} -
                                                            {!! $customer_address->city->name !!}
                                                        </td>
                                                        <td>{!! $customer_address->address !!}</td>
                                                        <td>{!! $customer_address->zip_code !!}</td>
                                                        <td>{!! $customer_address->po_box !!}</td>
                                                        <td>
                                                            <div>

                                                                <a href="{!! route('admin.customer_addresses.edit',$customer_address->id) !!}"
                                                                   class="btn btn-hover-primary btn-icon btn-pill "
                                                                   title="{!! __('common.edit') !!}">
                                                                    <i class="fa fa-edit fa-1x"></i>
                                                                </a>

                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-hover-danger btn-icon btn-pill delete_course_btn"
                                                                   title="{!! __('common.delete') !!}"
                                                                   onclick="if (confirm('{!! __('common.are_you_sure_to_delete_record') !!}'))
                                                                       { document.getElementById('delete-customer_address-{{ $customer_address->id }}').submit(); }
                                                                       else {
                                                                       return false;
                                                                       }">
                                                                    <i class="fa fa-trash fa-1x"></i>
                                                                </a>
                                                                <form
                                                                    action="{{ route('admin.customer_addresses.destroy', $customer_address->id) }}"
                                                                    method="post"
                                                                    id="delete-customer_address-{{ $customer_address->id }}"
                                                                    class="d-none">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8"
                                                            class="text-center">{!! __('common.no_data_found') !!}</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="8">
                                                        <div>
                                                            {!! $customer_addresses->appends(request()->all())->links('vendor.pagination.bootstrap-4') !!}
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tfoot>
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
