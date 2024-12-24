<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerifyOtpRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'otp_code' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'otp_code.required' => __('validation.forgot_password.otp_code.required'),
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all(); 
        $errorString = implode(', ', $errors); 

        throw new HttpResponseException(
            redirect()->back()->withErrors(['otp_code' => $errorString])->withInput()
        );
    }
}
