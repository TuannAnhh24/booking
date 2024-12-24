<?php

namespace App\Http\Requests\RequestsEditUser;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateCountryRequest extends FormRequest
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
          
            'nationality' => 'nullable|required',
           
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
          
    
    
            'nationality.required' =>__('validation.validation_edit_profile.nationality.nationality_required'),
          
    
           
        ];
    }
    
protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json([
        'errors' => $validator->errors()
    ], 422));
}

}
