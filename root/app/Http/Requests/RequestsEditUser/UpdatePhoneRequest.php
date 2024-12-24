<?php
namespace App\Http\Requests\RequestsEditUser;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdatePhoneRequest extends FormRequest
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
            'phone_number' => 'nullable|required|regex:/^[0-9]+$/|max:15|min:4',
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
            'phone_number.required' => __('validation.validation_edit_profile.phone.phone_number_required'),
            'phone_number.regex' => __('validation.validation_edit_profile.phone.phone_number_regex'),
            'phone_number.max' => __('validation.validation_edit_profile.phone.phone_number_max'),
            'phone_number.min' => __('validation.validation_edit_profile.phone.phone_number_min'),
        ];
    }
    
    
protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json([
        'errors' => $validator->errors()
    ], 422));
}

}
