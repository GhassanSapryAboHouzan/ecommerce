<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'username'=>'required|string',
            'password'=>'required|string'
        ];
    }

    public function messages()
    {
        return [
            'username.required'=>trans('dashboard.username_required'),
            'username.string'=>trans('dashboard.username_string'),
            'password.required'=>trans('dashboard.password_required'),
            'password.string'=>trans('dashboard.password_string'),
            'password.min'=>trans('dashboard.password_min'),
        ];

    }
}
