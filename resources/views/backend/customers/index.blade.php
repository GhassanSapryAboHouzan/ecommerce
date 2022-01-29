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
                            {{trans('customers.customers')}}
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
            @ability('admin', 'create_customers')
            <div class="d-flex align-items-center">
                <a href="{!! route('admin.customers.create') !!}"
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

                            @include('backend.customers.filter.filter')

                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive text-center ">
                                            <table class="table table-borderless"
                                                   style="text-align: center;vertical-align: middle;">
                                                <thead>
                                                <tr>
                                                    <th>{!! __('customers.user_image') !!}</th>
                                                    <th>{!! __('customers.full_name') !!}</th>
                                                    <th>{!! __('customers.email') !!}</th>
                                                    <th>{!! __('customers.mobile') !!}</th>
                                                    <th>{!! __('customers.status') !!}</th>
                                                    <th>{!! __('customers.created_at') !!}</th>
                                                    <th class="text-center">{!! __('common.actions') !!}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($customers as $customer)
                                                    <tr>
                                                        <td>
                                                            @if( $customer->user_image != null)
                                                                <img class="img-thumbnail"
                                                                     style="width: 50px ; height: 50px"
                                                                     src="{{ asset('adminBoard/uploaded_images/users/' . $customer->user_image) }}">
                                                            @else
                                                                <img class="img-thumbnail"
                                                                     style="width: 50px ; height: 50px"
                                                                     src="{{ asset('adminBoard/images/user.jpg') }}">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {!! $customer->full_name !!}
                                                            <br/>
                                                            {!! $customer->username !!}
                                                        </td>
                                                        <td>{!! $customer->email !!}</td>
                                                        <td>{!! $customer->mobile  !!}</td>
                                                        <td>{!! $customer->status !!}</td>
                                                        <td>{!! $customer->created_at !!}</td>
                                                        <td>
                                                            <div>
                                                                <a href="{!! route('admin.customers.edit',$customer->id) !!}"
                                                                   class="btn btn-hover-primary btn-icon btn-pill "
                                                                   title="{!! __('common.edit') !!}">
                                                                    <i class="fa fa-edit fa-1x"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-hover-danger btn-icon btn-pill delete_course_btn"
                                                                   title="{!! __('common.delete') !!}"
                                                                   onclick="if (confirm('{!! __('common.are_you_sure_to_delete_record') !!}'))
                                                                       { document.getElementById('delete-customer-{{ $customer->id }}').submit(); }
                                                                       else {
                                                                       return false;
                                                                       }">
                                                                    <i class="fa fa-trash fa-1x"></i>
                                                                </a>
                                                                <form
                                                                    action="{{ route('admin.customers.destroy', $customer->id) }}"
                                                                    method="post"
                                                                    id="delete-customer-{{ $customer->id }}"
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
                                                            {!! $customers->appends(request()->all())->links('vendor.pagination.bootstrap-4') !!}
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
