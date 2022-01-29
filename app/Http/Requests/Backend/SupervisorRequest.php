<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SupervisorRequest extends FormRequest
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
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'username' => 'required|max:20|unique:users',
                    'email' => 'required|email|max:255|unique:users',
                    'mobile' => 'required|numeric|unique:users',
                    'status' => 'required',
                    'password' => 'required|min:8',
                    'user_image' => 'nullable|mimes:jpg,jpeg,png|max:2048'
                ];
            }
            case 'PUT' :
            case 'PATCH' :
            {
                return [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'username' => 'required|max:20|unique:users,username,' . $this->supervisor,
                    'email' => 'required|email|max:255|unique:users,email,' . $this->supervisor,
                    'mobile' => 'required|numeric|unique:users,mobile,' . $this->supervisor,
                    'status' => 'required',
                    'password' => 'nullable|min:8',
                    'user_image' => 'nullable|mimes:jpg,jpeg,png|max:2048'
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
            'mimes' => __('common.mimes'),
            'image.max' => __('common.image_max_2_mega'),
        ];
    }
}
