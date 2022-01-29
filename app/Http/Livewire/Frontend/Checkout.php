<?php

namespace App\Http\Livewire\Frontend;

use App\Models\PaymentMethod;
use App\Models\ProductCoupon;
use App\Models\ShippingCompany;
use App\Models\UserAddress;
use Livewire\Component;

class Checkout extends Component
{
    public $subtotal;
    public $tax;
    public $total;
    public $couponCodeInput;
    public $cartDiscount;

    public $addresses;
    public $customerAddressId = 0;
    public $shippingCompanies;
    public $shippingCompanyId = 0;
    public $cartShipping;

    public $paymentMethods;
    public $paymentMethodId = 0;
    public $paymentMethodCode;

    public function mount()
    {
        $this->customerAddressId = session()->has('savedCustomerAddressId') ? session()->get('savedCustomerAddressId') : '';
        $this->shippingCompanyId = session()->has('savedShippingCompanyId') ? session()->get('savedShippingCompanyId') : '';
        $this->paymentMethodId = session()->has('savedPaymentMethodId') ? session()->get('savedPaymentMethodId') : '';

        $this->addresses = auth()->user()->addresses;

        $this->subtotal = getNumbers()->get('subtotal');
        $this->tax = getNumbers()->get('productTaxes');
        $this->total = getNumbers()->get('total');
        $this->cartDiscount = getNumbers()->get('discount');
        $this->cartShipping = getNumbers()->get('shipping');

        //////////////////////////////////////////////////
        /// تفريع شركات الشحن
        if ($this->customerAddressId == '') {
            $this->shippingCompanies = collect([]);
        } else {
            $this->updateShippingCompanies();
        }

        $this->paymentMethods = PaymentMethod::whereStatus(true)->get();

    }

    public function applyDiscount()
    {
        if (getNumbers()->get('subtotal') > 0) {
            $coupon = ProductCoupon::where('code', $this->couponCodeInput)->whereStatus(true)->first();
            if (!$coupon) {
                $this->couponCodeInput = '';
                $this->alert('error', 'Invalid Coupon');
            } else {

                $couponDiscount = $coupon->discount($this->subtotal);
                if ($couponDiscount > 0) {
                    session()->put('coupon', [
                        'code' => $coupon->code,
                        'value' => $coupon->value,
                        'discount' => $couponDiscount,
                    ]);

                    $this->couponCodeInput = session()->get('coupon')['code'];
                    $this->emit('updateCart');
                    $this->alert('success', 'coupon apply successfully');

                } else {
                    $this->alert('error', 'product coupon is invalid');
                }
            }
        } else {
            $this->couponCodeInput = '';
            $this->alert('danger', 'No products exist int the cart');

        }
    }

    public function removeCoupon()
    {
        session()->remove('coupon');
        $this->couponCodeInput = '';
        $this->emit('updateCart');
        $this->alert('success', 'Coupon Delete Successfully');
    }

    public function updateShippingCompanies()
    {
        $addressCountry = UserAddress::where('id', $this->customerAddressId)->first();
        $this->shippingCompanies = ShippingCompany::whereHas('countries', function ($query) use ($addressCountry) {
            $query->where('country_id', $addressCountry->country_id);
        })->get();
    }

    public function updateShippingCost()
    {
        $selectedShippingCompany = ShippingCompany::whereId($this->shippingCompanyId)->first();
        session()->put('shipping', [
            'code' => $selectedShippingCompany->code,
            'cost' => $selectedShippingCompany->cost,
        ]);
        $this->emit('updateCart');
        $this->alert('success', 'Shipping cost is applied successfully');
    }


    public function updatePaymentMethod()
    {
        $paymentMethod = PaymentMethod::whereId($this->paymentMethodId)->first();
        $this->paymentMethodCode = $paymentMethod->code;
    }

    // Hook
    /////////////////////////////////////////////////////////////////////////////////////
    /// Customer Address radio show hide shipping companies and payment methods
    public function updatingCustomerAddressId()
    {
        session()->forget('savedCustomerAddressId');
        session()->forget('savedShippingCompanyId');
        session()->forget('shipping');

        session()->put('savedCustomerAddressId', $this->customerAddressId);

        $this->customerAddressId = session()->has('savedCustomerAddressId') ? session()->get('savedCustomerAddressId') : '';
        $this->shippingCompanyId = session()->has('savedShippingCompanyId') ? session()->get('savedShippingCompanyId') : '';
        $this->paymentMethodId = session()->has('savedPaymentMethodId') ? session()->get('savedPaymentMethodId') : '';


        $this->emit('updateCart');
    }

    public function updatedCustomerAddressId()
    {
        session()->forget('savedCustomerAddressId');
        session()->forget('savedShippingCompanyId');
        session()->forget('shipping');

        session()->put('savedCustomerAddressId', $this->customerAddressId);

        $this->customerAddressId = session()->has('savedCustomerAddressId') ? session()->get('savedCustomerAddressId') : '';
        $this->shippingCompanyId = session()->has('savedShippingCompanyId') ? session()->get('savedShippingCompanyId') : '';
        $this->paymentMethodId = session()->has('savedPaymentMethodId') ? session()->get('savedPaymentMethodId') : '';

        $this->emit('updateCart');
    }

    // Hook
    /////////////////////////////////////////////////////////////////////////////////////
    /// Shipping Company radio show hide payment methods
    public function updatingShippingCompanyId()
    {
        session()->forget('savedShippingCompanyId');

        session()->put('savedShippingCompanyId', $this->shippingCompanyId);

        $this->customerAddressId = session()->has('savedCustomerAddressId') ? session()->get('savedCustomerAddressId') : '';
        $this->shippingCompanyId = session()->has('savedShippingCompanyId') ? session()->get('savedShippingCompanyId') : '';
        $this->paymentMethodId = session()->has('savedPaymentMethodId') ? session()->get('savedPaymentMethodId') : '';

        $this->emit('updateCart');
    }

    public function updatedShippingCompanyId()
    {
        session()->forget('savedShippingCompanyId');

        session()->put('savedShippingCompanyId', $this->shippingCompanyId);

        $this->customerAddressId = session()->has('savedCustomerAddressId') ? session()->get('savedCustomerAddressId') : '';
        $this->shippingCompanyId = session()->has('savedShippingCompanyId') ? session()->get('savedShippingCompanyId') : '';
        $this->paymentMethodId = session()->has('savedPaymentMethodId') ? session()->get('savedPaymentMethodId') : '';

        $this->emit('updateCart');
    }

    public function render()
    {
        return view('livewire.frontend.checkout');
    }
}
