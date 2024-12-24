<?php
namespace App\Http\Requests\RequestsEditUser;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateDisplayNameRequest extends FormRequest
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
            'display_name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'display_name.required' =>__('validation.validation_edit_profile.displayName.display_name_required'),
            'display_name.string' => __('validation.validation_edit_profile.displayName.display_name_string'),
            'display_name.max' => __('validation.validation_edit_profile.displayName.display_name_max'),
        ];
    }
    
protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json([
        'errors' => $validator->errors()
    ], 422));
}

}
