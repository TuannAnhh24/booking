<?php

namespace App\Http\Requests\RequestsEditUser;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateEmailRequest extends FormRequest
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
           
            'email' => 'required|email|unique:users,email,' . $this->user()->id,
         
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
         
            'email.required' => __('validation.validation_edit_profile.email.email_required'),
            'email.email' => __('validation.validation_edit_profile.email.email'),
            'email.unique' => __('validation.validation_edit_profile.email.email_unique'),
    
        
        ];
    }
    
protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json([
        'errors' => $validator->errors()
    ], 422));
}

}
