<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ShippingCompanyRequest extends FormRequest
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
                    'name'          => 'required|max:255',
                    'code'          => 'required|unique:shipping_companies',
                    'description'   => 'required',
                    'fast'          => 'required',
                    'cost'          => 'required|numeric',
                    'status'        => 'required',
                    'countries'     => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'          => 'required|max:255',
                    'code'          => 'required|unique:shipping_companies,code,'.$this->shipping_company,
                    'description'   => 'required',
                    'fast'          => 'required',
                    'cost'          => 'required|numeric',
                    'status'        => 'required',
                    'countries'     => 'required',
                ];
            }
            default: break;
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
