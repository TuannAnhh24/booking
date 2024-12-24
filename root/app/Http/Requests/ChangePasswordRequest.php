<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => ['required', 'string', 'min:8'], // Mật khẩu cũ phải có ít nhất 8 ký tự
            'new_password' => ['required', 'string', 'min:8', 'confirmed'], // Mật khẩu mới phải có ít nhất 8 ký tự và phải xác nhận đúng
            'new_password_confirmation' => ['required', 'string', 'min:8'], // Xác nhận mật khẩu mới
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => __('validation.changepassword.current_password.required'),
            'current_password.min' => __('validation.changepassword.current_password.min'),
            'new_password.required' => __('validation.changepassword.new_password.required'),
            'new_password.min' => __('validation.changepassword.new_password.min'),
            'new_password.confirmed' => __('validation.changepassword.new_password.confirmed'),
            'new_password_confirmation.required' => __('validation.changepassword.new_password_confirmation.required'),
            'new_password_confirmation.min' => __('validation.changepassword.new_password_confirmation.min'),
        ];
    }
    public function failedValidation(Validator $validator)
    {
        // Trả về lỗi validation dưới dạng JSON
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422)
        );
    }
    
}
