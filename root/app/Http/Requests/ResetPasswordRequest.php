<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'new_password.required' => __('validation.forgot_password.new_password.required'),
            'new_password.min' => __('validation.forgot_password.new_password.min'),
            'new_password.confirmed' => __('validation.forgot_password.new_password.confirmed'),
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        $errorString = implode(', ', $errors); 

        throw new HttpResponseException(
            redirect()->back()->withErrors(['new_password' => $errorString])->withInput()
        );
    }
}
