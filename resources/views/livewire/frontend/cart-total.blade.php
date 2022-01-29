<div class="col-lg-4">
    <div class="card border-0 rounded-0 p-lg-4 bg-light">
        <div class="card-body">
            <h5 class="text-uppercase mb-4">Cart total</h5>
            <ul class="list-unstyled mb-0">

                @if($cartTotal != 0)
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between my-2">
                        <strong class="text-uppercase small font-weight-bold">Subtotal</strong>
                        <span class="text-primary font-weight-bold small">${!! $cartSubTotal !!}</span>
                    </li>

                    @if(session()->has('coupon'))
                        <li class="border-bottom my-2"></li>
                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="small font-weight-bold">Discount
                                <small>{!! getNumbers()->get('discount_code') !!}</small>
                            </strong>
                            <span class="text-danger  font-weight-bold  small">
                               - {!! $cartDiscount !!}
                            </span>
                        </li>
                    @endif

                    @if(session()->has('shipping'))
                        <li class="border-bottom my-2"></li>
                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="small font-weight-bold">shipping
                                <small>{!!  getNumbers()->get('shipping_code') !!}</small>
                            </strong>
                            <span class="text-danger  font-weight-bold  small">
                               - {!! $cartDiscount !!}
                            </span>
                        </li>
                    @endif


                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between my-2">
                        <strong class="text-uppercase small font-weight-bold">Tax</strong>
                        <span class="text-danger font-weight-bold small">${!! $cartTax !!}</span>
                    </li>

                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between my-2">
                        <strong class="text-uppercase small font-weight-bold">Total</strong>
                        <span class="text-success font-weight-bold small">${!! $cartTotal !!}</span>
                    </li>


                @else
                    <li class=" align-items-center justify-content-center my-2">
                        <span>Your Cart Is Empty</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
