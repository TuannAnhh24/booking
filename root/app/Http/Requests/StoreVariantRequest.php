<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreVariantRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'variant_image' => 'nullable|array',
            'variant_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => __('validation.validation.name.required'),
            'name.string' => __('validation.validation.name.string'),
            'name.max' => __('validation.validation.name.max'),
            'description.string' => __('validation.validation.description.string'),
            'variant_image.array' => __('validation.validation.variant_images.array'),
            'variant_image.*.image' => __('validation.validation.variant_images.image'),
            'variant_image.*.mimes' => __('validation.validation.variant_images.mimes'),
            'variant_image.*.max' => __('validation.validation.variant_images.max'),
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->messages();
        throw new HttpResponseException(response()->json(['success' => false, 'errors' => $errors], 422));
    }
}
