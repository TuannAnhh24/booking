<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteCategoryRequest extends FormRequest
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
            'deleted_reason' => 'required|string|max:255',
        ];
    }


    public function messages()
    {
        return [
            'deleted_reason.required' => __('validation.category_validation.deleted_reason.required'),
            'deleted_reason.string' => __('validation.category_validation.deleted_reason.string'),
            'deleted_reason.max' => __('validation.category_validation.deleted_reason.max'),
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
