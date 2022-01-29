<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductCouponRequest extends FormRequest
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
    /*** Get the validation rules that apply to the request.*/
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'code' => 'required|unique:product_coupons',
                    'type' => 'required',
                    'value' => 'required',
                    'description' => 'nullable',
                    'use_times' => 'required|numeric',
                    'start_date'        => 'nullable|date_format:Y-m-d',
                    'expire_date'       => 'required_with:start_date|date_format:Y-m-d',
                    'greater_than' => 'nullable|numeric',
                    'status' => 'required',
                ];
            }
            case 'PUT' :
            case 'PATCH' :
            {
                return [
                    'code' => 'required|unique:product_coupons,code,' . $this->product_coupon,
                    'type' => 'required',
                    'value' => 'required',
                    'description' => 'nullable',
                    'use_times' => 'required|numeric',
                    'start_date'        => 'nullable|date_format:Y-m-d',
                    'expire_date'       => 'required_with:start_date|date_format:Y-m-d',
                    'greater_than' => 'nullable|numeric',
                    'status' => 'required',
                ];
            }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'required' => __('common.required'),
            'name.max' => __('common.max_characters_250'),
            'unique' => __('common.unique'),
            'mimes' => __('common.mimes'),
            'image.max' => __('common.image_max_2_mega'),
            'numeric' => __('common.numeric'),
        ];
    }
}
