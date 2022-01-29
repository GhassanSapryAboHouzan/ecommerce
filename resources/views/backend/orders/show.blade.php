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
                        <a href="{!! route('admin.orders.index') !!}" class="text-muted">
                            {{trans('orders.orders')}}
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">
                            {!!  __('orders.order_show') !!}
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


                    @include('backend.includes.message')


                    <div class="row">
                        <div class="col-12">
                            <div class="card card-custom shadow mb-4">
                                <div class="card-body">
                                    <div class="portlet-body">
                                        <div class="card-header  d-flex">
                                            <h6 class="m-0 font-weight-bold text-primary">Order
                                                ({{ $order->ref_id }})</h6>
                                            <div class="ml-auto">
                                                <form action="{{ route('admin.orders.update', $order->id) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-row align-items-center">
                                                        <label class="sr-only" for="inlineFormInputGroupUsername">Order
                                                            Status</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">Order status</div>
                                                            </div>
                                                            <select class="form-control" name="order_status"
                                                                    style="outline-style: none;"
                                                                    onchange="this.form.submit()">
                                                                <option value=""> Choose your action</option>
                                                                @foreach($orderStatusArray as $key => $value)
                                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="col-8">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <tbody>
                                                        <tr>
                                                            <th>Ref. Id</th>
                                                            <td>{{ $order->ref_id }}</td>
                                                            <th>Customer</th>
                                                            <td>
                                                                <a href="{{ route('admin.customers.show', $order->user_id) }}">{{ $order->user->full_name }}</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address</th>
                                                            <td>
                                                                <a href="{{ route('admin.customer_addresses.show', $order->user_address_id) }}">{{ $order->user_address->address_title }}</a>
                                                            </td>
                                                            <th>Shipping Company</th>
                                                            <td>{{ $order->shipping_company->name . '('. $order->shipping_company->code .')' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Created date</th>
                                                            <td>{{ $order->created_at->format('d-m-Y h:i a') }}</td>
                                                            <th>Order status</th>
                                                            <td>{!! $order->statusWithLabel() !!}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <tbody>
                                                        <tr>
                                                            <th>Subtotal</th>
                                                            <td>{{ $order->currency() . $order->subtotal }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Discount code</th>
                                                            <td>{{ $order->discount_code }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Discount</th>
                                                            <td>{{ $order->currency() . $order->discount }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Shipping</th>
                                                            <td>{{ $order->currency() . $order->shipping }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>tax</th>
                                                            <td>{{ $order->currency() . $order->tax }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Amount</th>
                                                            <td>{{ $order->currency() . $order->total }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card card-custom shadow mb-4">
                                <div class="card-body">
                                    <div class="portlet-body">
                                        <div class="card-header ">
                                            <h6 class="font-weight-bold text-primary">Transactions</h6>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Transaction</th>
                                                    <th>Transaction number</th>
                                                    <th>Payment result</th>
                                                    <th>Action date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($order->transactions as $transaction)
                                                    <tr>
                                                        <td>{{ $transaction->status($transaction->transaction) }}</td>
                                                        <td>{{ $transaction->transaction_number }}</td>
                                                        <td>{{ $transaction->payment_result }}</td>
                                                        <td>{{ $transaction->created_at->format('Y-m-d h:i a') }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">No transactions found</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-custom shadow mb-4">
                                <div class="card-body">
                                    <div class="portlet-body">
                                        <div class="card-header ">
                                            <h6 class=" font-weight-bold text-primary">Details</h6>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($order->products as $product)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a>
                                                        </td>
                                                        <td>{{ $product->pivot->quantity }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="2">No products found</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->

        <!--begin::Form-->
    </div>
    <!--end::content-->

@endsection
