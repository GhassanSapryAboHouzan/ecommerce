<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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

    /*** Get the validation rules that apply to the request.*/
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => 'required|max:255|unique:product_categories',
                    'status' => 'required',
                    'parent_id' => 'nullable',
                    'image' => 'required|mimes:jpg,jpeg,png|max:2048',
                ];
            }
            case 'PUT' :
            case 'PATCH' :
            {
                return [
                    'name' => 'required|max:255|unique:product_categories,name,'.$this->product_category,
                    'status' => 'required',
                    'parent_id' => 'nullable',
                    'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
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
        ];
    }
}
