<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'name' => 'required|string|max:255|unique:categories,name,'.$id,
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.category_validation.name.required'),
            'name.string' => __('validation.category_validation.name.string'),
            'name.max' => __('validation.category_validation.name.max'),
            'name.unique' => __('validation.category_validation.name.unique'),
            'description.string' => __('validation.category_validation.description.string'),
            'images.array' => __('validation.category_validation.images.array'),
            'images..image' => __('validation.category_validation.images.image'),
            'images..mimes' => __('validation.category_validation.images.mimes'),
            'images..max' => __('validation.category_validation.images.max'),
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
