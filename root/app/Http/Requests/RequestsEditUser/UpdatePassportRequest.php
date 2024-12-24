<?php
namespace App\Http\Requests\RequestsEditUser;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdatePassportRequest extends FormRequest
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
            
            'passport_first_name' => 'nullable|required|string|max:255',
            'passport_last_name' => 'nullable|required|string|max:255',
            'passport_country' => 'nullable|required|string|max:100',
            'passport_number' => 'nullable|required|string|regex:/^[a-zA-Z0-9]{6,9}$/|max:20',
            'expiry_day' => 'nullable|required|integer|between:1,31',
            'expiry_month' => 'nullable|required|between:1,12',
            'expiry_year' => 'nullable|required|integer|min:1900|max:' . (date('Y') + 10),
            
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
         
    
            'passport_first_name.required' => __('validation.validation_edit_profile.passport.passport_first_name_required'),
            'passport_first_name.string' => __('validation.validation_edit_profile.passport.passport_first_name_string'),
            'passport_first_name.max' => __('validation.validation_edit_profile.passport.passport_first_name_max'),
    
            'passport_last_name.required' => __('validation.validation_edit_profile.passport.passport_last_name_required'),
            'passport_last_name.string' => __('validation.validation_edit_profile.passport.passport_last_name_string'),
            'passport_last_name.max' => __('validation.validation_edit_profile.passport.passport_last_name_max'),
    
            'passport_country.required' => __('validation.validation_edit_profile.passport.passport_country_required'),
            'passport_country.string' => __('validation.validation_edit_profile.passport.passport_country_string'),
            'passport_country.max' => __('validation.validation_edit_profile.passport.passport_country_max'),
    
            'passport_number.required' => __('validation.validation_edit_profile.passport.passport_number_required'),
            'passport_number.regex' => __('validation.validation_edit_profile.passport.passport_number_regex'),
            'passport_number.max' => __('validation.validation_edit_profile.passport.passport_number_max'),
            
            'expiry_day.required' => __('validation.validation_edit_profile.passport.expiry_day_required'),
            'expiry_day.integer' => __('validation.validation_edit_profile.passport.expiry_day_integer'),
            'expiry_day.between' => __('validation.validation_edit_profile.passport.expiry_day_between'),

            'expiry_month.required' => __('validation.validation_edit_profile.passport.expiry_month_required'),
            'expiry_month.integer' => __('validation.validation_edit_profile.passport.expiry_month_integer'),
            'expiry_month.between' => __('validation.validation_edit_profile.passport.expiry_month_between'),

            'expiry_year.required' => __('validation.validation_edit_profile.passport.expiry_year_required'),
            'expiry_year.min' => __('validation.validation_edit_profile.passport.expiry_year_min'),
            'expiry_year.max' => __('validation.validation_edit_profile.passport.expiry_year_max'),
           
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $expiryDay = $this->input('expiry_day');
            $expiryMonth = $this->input('expiry_month');
            $expiryYear = $this->input('expiry_year');

            if ($expiryDay && $expiryMonth && $expiryYear) {
                // Kiểm tra tính hợp lệ của ngày
                if (!checkdate($expiryMonth, $expiryDay, $expiryYear)) {
                    $validator->errors()->add('expiry_date', 'Ngày hết hạn không hợp lệ.');
                } else {
                    // Kiểm tra nếu ngày hết hạn là ngày trong tương lai
                    $expiryDate = Carbon::create($expiryYear, $expiryMonth, $expiryDay);
                    if ($expiryDate->isPast()) {
                        $validator->errors()->add('expiry_date', 'Ngày hết hạn phải nằm trong tương lai.');
                    }
                }
            }
        });
    }
    
protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json([
        'errors' => $validator->errors()
    ], 422));
}

}
