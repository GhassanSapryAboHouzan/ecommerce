<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email||unique:users,email,' . auth()->id(),
            'mobile' => 'required|numeric|unique:users,mobile,' . auth()->id(),
            'password' => 'nullable|string|min:6|confirmed',
            'user_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'receive_emails' => 'required'
        ];
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
