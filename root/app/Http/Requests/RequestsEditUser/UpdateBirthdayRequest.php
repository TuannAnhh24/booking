<?php

namespace App\Http\Requests\RequestsEditUser;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateBirthdayRequest extends FormRequest
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
            'day' => 'required|numeric|between:1,31',
            'month' => 'required',
            'year' => 'required|integer|digits:4|min:1900|max:' . date('Y'),
        ];
    }

    public function messages()
    {
        return [
            'day.required' => __('validation.validation_edit_profile.birthday.day_required'),
            'day.numeric' => __('validation.validation_edit_profile.birthday.day_numeric'),
            'day.between' => __('validation.validation_edit_profile.birthday.day_between'),
            
            'month.required' => __('validation.validation_edit_profile.birthday.month_required'),
            
            'year.required' => __('validation.validation_edit_profile.birthday.year_required'),
            'year.integer' => __('validation.validation_edit_profile.birthday.year_integer'),
            'year.digits' => __('validation.validation_edit_profile.birthday.year_digits'),
            'year.min' => __('validation.validation_edit_profile.birthday.year_min'),
            'year.max' => __('validation.validation_edit_profile.birthday.year_max'),
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->filled(['day', 'month', 'year'])) {
            $birthday = sprintf('%04d-%02d-%02d', $this->year, $this->month, $this->day);

            if (Carbon::hasFormat($birthday, 'Y-m-d')) {
                $this->merge(['birthday' => $birthday]);
            }
        }
    }
protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json([
        'errors' => $validator->errors()
    ], 422));
}

}
