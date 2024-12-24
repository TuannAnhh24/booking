<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ForgotPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'exists:users,email',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('validation.forgot_password.email.required'),
            'email.email' => __('validation.forgot_password.email.email'),
            'email.exists' => __('validation.forgot_password.email.exists'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        if (empty($errors)) {
            $errors[] = __('validation.forgot_password.check');
        }

        $errorString = implode(', ', $errors);

        throw new HttpResponseException(
            redirect()->back()->withErrors(['email' => $errorString])->withInput()
        );
    }
}
