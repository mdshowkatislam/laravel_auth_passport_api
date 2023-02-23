<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSignup extends FormRequest
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
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string|unique:users|digits:8',
            'password' => 'required|string|min:8|confirmed',
            // 'password_confirmation' => 'required|min:8',
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'Please enter first name',
            'last_name.' => 'Please enter last name',
            'email.required' => 'Please enter email',
            'phone.digits' => 'You have to put adjectly 8 digit',
            'phone.unique' => 'This phone number already has been taken',
            'password.min' => 'You have to put adjectly 8 digit',
            'password.confirmed' =>
                'password_confirmation field must be same as it is',
        ];
    }
}
