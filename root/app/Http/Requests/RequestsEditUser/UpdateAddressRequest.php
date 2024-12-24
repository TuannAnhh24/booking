<?php

namespace App\Http\Requests\RequestsEditUser;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class   UpdateAddressRequest extends FormRequest
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
           
            'country' => 'nullable|required|string|max:100',
            'street' => 'nullable|required|string|max:255',
            'city' => 'nullable|required|string|max:100',
            'zip' => 'nullable|required|regex:/^[0-9]+$/|max:20',
           
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
           
    
            'country.required' => __('validation.validation_edit_profile.address.country_required'),
            'country.string' => __('validation.validation_edit_profile.address.country_string'),
            'country.max' => __('validation.validation_edit_profile.address.country_max'),
    
            'street.required' => __('validation.validation_edit_profile.address.street_required'),
            'street.string' => __('validation.validation_edit_profile.address.street_string'),
            'street.max' => __('validation.validation_edit_profile.address.street_max'),
    
            'city.required' => __('validation.validation_edit_profile.address.city_required'),
            'city.string' =>__('validation.validation_edit_profile.address.city_string'),
            'city.max' => __('validation.validation_edit_profile.address.city_max'),
    
            'zip.required' => __('validation.validation_edit_profile.address.zip_required'),
            'zip.regex' => __('validation.validation_edit_profile.address.zip_regex'),
            'zip.max' => __('validation.validation_edit_profile.address.zip_max'),
    
            
        ];
    }
    
protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json([
        'errors' => $validator->errors()
    ], 422));
}

}
