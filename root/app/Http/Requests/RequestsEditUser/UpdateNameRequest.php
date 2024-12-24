<?php

namespace App\Http\Requests\RequestsEditUser;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateNameRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',

        ];
    }

    /**
     * Thông báo lỗi tùy chỉnh cho từng quy tắc xác thực.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => __('validation.validation_edit_profile.name.first_name_required'),
            'first_name.string' => __('validation.validation_edit_profile.name.first_name_string'),
            'first_name.max' => __('validation.validation_edit_profile.name.first_name_max'),
            'last_name.required' => __('validation.validation_edit_profile.name.last_name_required'),
            'last_name.string' => __('validation.validation_edit_profile.name.last_name_string'),
            'last_name.max' => __('validation.validation_edit_profile.name.last_name_max'),

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
