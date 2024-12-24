<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class  DeleteDestinationRequest extends FormRequest
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
            'deleted_reason.required' => __('content.requests.deleted_reason_required'),
            'deleted_reason.string' => __('content.requests.deleted_reason_string'),
            'deleted_reason.max' => __('content.requests.deleted_reason_max'),
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'code' => 400,
            'errors' => $validator->errors(),
        ], 400));
    }
}
