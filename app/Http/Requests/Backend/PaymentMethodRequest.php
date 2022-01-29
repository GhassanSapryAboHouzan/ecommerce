<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => 'required|max:255',
                    'code' => 'required|max:255|unique:payment_methods,code',
                    'driver_name' => 'nullable',
                    'merchant_email' => 'nullable|email',
                    'client_id' => 'nullable',
                    'client_password' => 'nullable',
                    'client_secret' => 'nullable',
                    'sandbox_merchant_email' => 'nullable|email',
                    'sandbox_client_id' => 'nullable',
                    'sandbox_client_password' => 'nullable',
                    'sandbox_client_secret' => 'nullable',
                    'sandbox' => 'nullable',
                    'status' => 'required',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|max:255',
                    'code' => 'required|max:255|unique:payment_methods,code,' . $this->payment_method,
                    'driver_name' => 'nullable',
                    'merchant_email' => 'nullable|email',
                    'client_id' => 'nullable',
                    'client_password' => 'nullable',
                    'client_secret' => 'nullable',
                    'sandbox_merchant_email' => 'nullable|email',
                    'sandbox_client_id' => 'nullable',
                    'sandbox_client_password' => 'nullable',
                    'sandbox_client_secret' => 'nullable',
                    'sandbox' => 'nullable',
                    'status' => 'required',
                ];
            }
            default:
                break;
        }
    }
}
