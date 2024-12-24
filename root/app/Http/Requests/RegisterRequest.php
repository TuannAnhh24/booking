<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có được phép thực hiện yêu cầu này hay không.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Cho phép tất cả người dùng gửi yêu cầu
    }

    /**
     * Lấy các quy tắc xác thực áp dụng cho yêu cầu.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Các thông báo lỗi tuỳ chỉnh cho các trường không hợp lệ.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => __('validation.register.email.required'),
            'email.email' => __('validation.register.email.email'),
            'email.unique' => __('validation.register.email.unique'),
            'password.required' => __('validation.register.password.required'),
            'password.min' => __('validation.register.password.min'),
            'password.string' => __('validation.register.password.string'),
            'password.confirmed' => __('validation.register.password.confirmed'),
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        if (empty($errors)) {
            $errors[] = __('validation.register.check');
        }
        $errorString = implode(', ', $errors);

        throw new HttpResponseException(
            redirect()->back()->with('error', $errorString)->withInput()
        );
    }
}
