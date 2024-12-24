<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DestinationUpdateRequest extends FormRequest
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
            'location_name' => 'required',
            'district_name' => 'required',
            'ward_name' => 'required',
            'name' => 'required|string|max:255',
            'detailed_address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required',
            'convenients' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'location_name.required' => __('content.requests.location_name_required'),
            'district_name.required' => __('content.requests.district_name_required'),
            'ward_name.required' => __('content.requests.ward_name_required')   ,
            'name.required' => __('content.requests.detailed_address_required'),
            'detailed_address.required' => __('content.requests.name_required'),
            'name.string' => __('content.requests.name_string'),
            'name.max' => __('content.requests.name_max'),
            'description.string' => __('content.requests.description_string'),
            'images.array' => __('content.requests.images_array'),
            'images.*.image' => __('content.requests.images__image'),
            'images.*.mimes' => __('content.requests.images__mimes'),
            'images.*.max' => __('content.requests.images__max'),
            'categories' => __('content.requests.category_required'), // Thông báo lỗi khi không chọn danh mục
            'convenients' => __('content.requests.convenient_required'), // Thông báo lỗi khi không chọn danh mục
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->messages();
        throw new HttpResponseException(response()->json(['success' => false, 'errors' => $errors], 422));
    }
}
