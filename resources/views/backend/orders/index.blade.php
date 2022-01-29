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
                            {{trans('orders.orders')}}
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
            @ability('admin', 'create_orders')
            <div class="d-flex align-items-center">
                <a href="{!! route('admin.orders.create') !!}"
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

                            @include('backend.orders.filter.filter')

                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-12">


                                        <div class="table-responsive text-center ">
                                            <table class="table table-borderless"
                                                   style="text-align: center;vertical-align: middle;">
                                                <thead>
                                                <tr>
                                                    <th>{!! __('orders.ref_id') !!}</th>
                                                    <th>{!! __('orders.user_id') !!}</th>
                                                    <th>{!! __('orders.payment_method_id') !!}</th>
                                                    <th>{!! __('orders.total') !!}</th>
                                                    <th>{!! __('orders.order_status') !!}</th>
                                                    <th>{!! __('orders.created_at') !!}</th>
                                                    <th class="text-center">{!! __('common.actions') !!}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($orders as $order)
                                                    <tr>
                                                        <td>{!! $order->ref_id !!}</td>
                                                        <td>{!! $order->user->full_name !!}</td>
                                                        <td>{!! $order->payment_method->name !!}</td>
                                                        <td>{!! $order->currency() .' '.  $order->total !!}</td>
                                                        <td>{!! $order->statusWithLabel() !!}</td>
                                                        <td>{!! $order->created_at->format('Y-m-d h:i a') !!}</td>

                                                        <td>
                                                            <div>
                                                                <a href="{!! route('admin.orders.show',$order->id) !!}"
                                                                   class="btn btn-hover-primary btn-icon btn-pill "
                                                                   title="{!! __('common.show') !!}">
                                                                    <i class="fa fa-eye fa-1x"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-hover-danger btn-icon btn-pill delete_course_btn"
                                                                   title="{!! __('common.delete') !!}"
                                                                   onclick="if (confirm('{!! __('common.are_you_sure_to_delete_record') !!}'))
                                                                       { document.getElementById('delete-order-{{ $order->id }}').submit(); }
                                                                       else {
                                                                       return false;
                                                                       }">
                                                                    <i class="fa fa-trash fa-1x"></i>
                                                                </a>
                                                                <form
                                                                    action="{{ route('admin.orders.destroy', $order->id) }}"
                                                                    method="post"
                                                                    id="delete-order-{{ $order->id }}"
                                                                    class="d-none">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7"
                                                            class="text-center">{!! __('common.no_data_found') !!}</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="7">
                                                        <div>
                                                            {!! $orders->appends(request()->all())->links('vendor.pagination.bootstrap-4') !!}
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
