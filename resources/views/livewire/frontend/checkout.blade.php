<div class="row">

    <!-- Begin: Billing details-->
    <div class="col-lg-8">
        <h2 class="h5 text-uppercase mb-4">Sipping addresses</h2>
        <div class="row">
            @forelse($addresses as $address)
                <div class="col-6 form-group">
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            id="address-{{ $address->id }}"
                            class="custom-control-input"
                            wire:model="customerAddressId"
                            wire:click="updateShippingCompanies()"
                            {{ intval($customerAddressId) == $address->id ? 'checked' : '' }}
                            value="{{ $address->id }}">
                        <label for="address-{{ $address->id }}" class="custom-control-label text-small">
                            <b>{{ $address->address_title }}</b>
                            <small>
                                {{ $address->address }}<br>
                                {{ $address->country->name }} - {{ $address->state->name }} - {{ $address->city->name }}
                            </small>
                        </label>
                    </div>
                </div>

            @empty
                <p>No addresses found</p>
                <a href="#">Add an address</a>
            @endforelse
        </div>


        @if ($customerAddressId != 0)
            <h2 class="h5 text-uppercase mb-4">Sipping way</h2>
            <div class="row">
                @forelse($shippingCompanies as $shippingCompany)
                    <div class="col-6 form-group">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                id="shipping-company-{{ $shippingCompany->id }}"
                                class="custom-control-input"
                                wire:model="shippingCompanyId"
                                wire:click="updateShippingCost()"
                                {{ intval($shippingCompanyId) == $shippingCompany->id ? 'checked' : '' }}
                                value="{{ $shippingCompany->id }}">
                            <label for="shipping-company-{{ $shippingCompany->id }}"
                                   class="custom-control-label text-small">
                                <b>{{ $shippingCompany->name }}</b>
                                <small>
                                    {{ $shippingCompany->description }} - (${{ $shippingCompany->cost }})
                                </small>
                            </label>
                        </div>
                    </div>
                @empty
                    <p>No shipping companies found</p>
                @endforelse
            </div>
        @endif



        @if ($customerAddressId != 0 && $shippingCompanyId !=0)
            <h2 class="h5 text-uppercase mb-4">Shipping way</h2>
            <div class="row">
                @forelse($paymentMethods as $paymentMethod)
                    <div class="col-6 form-group">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                id="payment-method-{{ $paymentMethod->id }}"
                                class="custom-control-input"
                                wire:model="paymentMethodId"
                                wire:click="updatePaymentMethod()"
                                {{ intval($paymentMethodId) == $paymentMethod->id ? 'checked' : '' }}
                                value="{{ $paymentMethod->id }}">
                            <label for="payment-method-{{ $paymentMethod->id }}"
                                   class="custom-control-label text-small">
                                <b>{{ $paymentMethod->name }}</b>
                            </label>
                        </div>
                    </div>
                @empty
                    <p>No Payment Methods found</p>
                @endforelse
            </div>
        @endif

        @if ($customerAddressId != 0 && $shippingCompanyId !=0 && $paymentMethodId !=0)

            @if(\Illuminate\Support\Str::lower($paymentMethodCode) == 'ppex')
                <form action="{!! route('checkout.payment') !!}" method="post">
                    @csrf

                    <input type="hidden" class="form-control" id="customerAddressId" name="customerAddressId"
                           value="{!! old('customerAddressId' , $customerAddressId) !!}">

                    <input type="hidden" class="form-control" id="shippingCompanyId" name="shippingCompanyId"
                           value="{!! old('shippingCompanyId' , $shippingCompanyId) !!}">

                    <input type="hidden" class="form-control" id="paymentMethodId" name="paymentMethodId"
                           value="{!! old('paymentMethodId' , $paymentMethodId) !!}">

                    <button type="submit" name="submit" class="btn btn-dark btn-sm btn-block">
                        Checkout By Paypal
                    </button>

                </form>

            @endif

        @endif


    </div>
    <!-- End:Billing details-->

    <!-- Begin:ORDER SUMMARY-->
    <div class="col-lg-4">
        <div class="card border-0 rounded-0 p-lg-4 bg-light">
            <div class="card-body">
                <h5 class="text-uppercase mb-4">Your order</h5>
                <ul class="list-unstyled mb-0">

                    <li class="d-flex align-items-center justify-content-between">
                        <strong class="small font-weight-bold">SubTotal</strong>
                        <span class="text-primary  font-weight-bold  small">$ {!! $subtotal !!}</span></li>


                    @if(session()->has('coupon'))
                        <li class="border-bottom my-2"></li>
                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="small font-weight-bold">Discount
                                <small>{!! getNumbers()->get('discount_code')!!}</small>
                            </strong>
                            <span class="text-danger  font-weight-bold  small">
                               - $ {!! $cartDiscount !!}
                            </span>
                        </li>
                    @endif

                    @if(session()->has('shipping'))
                        <li class="border-bottom my-2"></li>
                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="small font-weight-bold">Shipping
                                <small>({{ getNumbers()->get('shipping_code') }})</small></strong>
                            <span class="text-muted small">${{ $cartShipping }}</span>
                        </li>
                    @endif

                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between">
                        <strong class="small font-weight-bold">Tax</strong>
                        <span class="text-danger  font-weight-bold  small">$ {!! $tax !!}</span>
                    </li>


                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between">
                        <strong class="text-uppercase small font-weight-bold">Total</strong>
                        <span class="text-success font-weight-bold small">${!! $total !!}</span>
                    </li>

                    <li class="border-bottom my-2"></li>
                    <li>
                        <form wire:submit.prevent="applyDiscount()" class="form">

                            @if(!session()->has('coupon'))
                                <input wire:model="couponCodeInput" type="text" class="form-control">
                            @endif

                            @if(session()->has('coupon'))
                                <button type="button" wire:click.prevent="removeCoupon()"
                                        class="btn btn-danger btn-sm btn-block">
                                    <i class="fa fa-gift"></i>
                                    Remove Discount
                                </button>
                            @else
                                <button type="submit" class="btn btn-dark btn-sm btn-block">
                                    <i class="fa fa-gift"></i>
                                    Apply Discount
                                </button>
                            @endif

                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End:ORDER SUMMARY-->

</div>
