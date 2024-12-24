<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DestinationRequest extends FormRequest
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
            'destinations.*.location' => 'required|string|max:255',
            'destinations.*.district' => 'required|string|max:255',
            'destinations.*.ward' => 'required|string|max:255',
            'destinations.*.name' => 'required|string|max:255',
            'destinations.*.detailed_address' => 'required|string|max:255',
            'destinations.*.description' => 'nullable|string',
            'destinations.*.images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'destinations.*.categoriesAdd' => 'required', // Bắt buộc phải chọn ít nhất một danh mục
            'destinations.*.convenientsAdd' => 'required', // Bắt buộc phải chọn ít nhất một danh mục
        ];
    }
    
    public function messages(): array
    {
        return [
            'destinations.*.location.required' => __('content.requests.location_name_required'),
            'destinations.*.district.required' => __('content.requests.district_name_required'),
            'destinations.*.ward.required' => __('content.requests.ward_name_required'),
            'destinations.*.name.required' => __('content.requests.name_required'),
            'destinations.*.detailed_address.required' => __('Vui lòng nhập'),
            'destinations.*.name.string' => __('content.requests.name_string'),
            'destinations.*.name.max' => __('content.requests.name_max'),
            'destinations.*.description.string' => __('content.requests.description_string'),
            'destinations.*.images.array' => __('content.requests.images_array'),
            'destinations.*.images.*image' => __('content.requests.images__image'),
            'destinations.*.images.*mimes' => __('content.requests.images__mimes'),
            'destinations.*.images.*max' => __('content.requests.images__max'),
            'destinations.*.categoriesAdd.required' => __('content.requests.category_required'), // Thông báo lỗi khi không chọn danh mục
            'destinations.*.convenientsAdd.required' => __('content.requests.convenient_required'), // Thông báo lỗi khi không chọn danh mục
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->messages();
        throw new HttpResponseException(response()->json(['success' => false, 'errors' => $errors], 422));
    }
}
