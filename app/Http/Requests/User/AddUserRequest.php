<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin')) {
            return true;
        }
        abort(401);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userType'      => 'required|string|exists:roles,slug',
            'firstname'     => 'required|string',
            'lastname'      => 'required|string',
            'gender'        => 'required|string|in:male,female,transgender',
            'phone_number'  => 'required|numeric|gte:6000000000|lte:9999999999',
            'alternate_phone_number'  => 'sometimes|nullable|gte:6000000000|lte:9999999999',
            'birthday'      => 'nullable|date_format:Y-m-d|before:-18 years',
            'address'       => 'required|string|max:255',
            'pin_code'      => 'required|numeric|min:100000|max:999999',
            'state'         => 'required|string|exists:states,slug',
            'city'          => 'required|string|exists:districts,slug',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/',
            'media'         => 'sometimes',
            'media.*'       => 'image|mimes:jpg,jpeg,png',
        ];
    }
    public function messages()
    {
        return [
            'userType.required'     => 'Usertype Not Defined',
            'gender.required'       => 'Please select your :attribute',
            'gender.in'             => 'Selected :attribute is invalid',
            'userType.exists'       => 'Usertype Does not exist',
            'phone_number.required' => 'Please enter a :attribute',
            'state.required'        => 'Please select a :attribute',
            'state.exists'          => 'Selected :attribute not valid',
            'city.required'         => 'Please select a :attribute',
            'city.exists'           => 'Selected :attribute not valid',
            'pin_code.required'     => 'Please Enter a :attribute',
            'email.unique'          => 'This :attribute alreay exist in our system',
            'password.regex'        => ':attribute should contain minimum of 6 characters, uppercase letter, lowercase letter and a number',
        ];
    }
    public function attributes()
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'address' => 'Address',
            'state' => 'State',
            'gender' => 'Gender',
            'phone_number' => 'Contact Number',
            'birthday' => 'Birthday',
            'pin_code' => 'Pincode',
            'alternate_phone_number' => 'Alternate contact number',
        ];
    }
}
