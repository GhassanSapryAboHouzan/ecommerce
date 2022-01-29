<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductReviewRequest extends FormRequest
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
                    'name' => 'required|max:255',
                    'user_id' => 'required',
                    'product_id' => 'required',
                    'email' => 'required|email',
                    'title' => 'required',
                    'message' => 'required',
                    'rating' => 'required|numeric',
                    'status' => 'required',
                ];
            }
            case 'PUT' :
            case 'PATCH' :
            {
                return [
                    'name' => 'required|max:255',
                    'user_id' => 'nullable',
                    'product_id' => 'required',
                    'email' => 'required|email',
                    'title' => 'required',
                    'message' => 'required',
                    'rating' => 'required|numeric',
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
            'numeric' => __('common.numeric'),
            'email' => __('common.email'),
        ];
    }
}
