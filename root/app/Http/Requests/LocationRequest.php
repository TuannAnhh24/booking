<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class LocationRequest extends FormRequest
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
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'characteristicAdd' => 'required|min:1', // Thêm quy tắc cho characteristic
          
         
            
        ];
    }
    public function messages(): array
    {
        return [
            'location_name.required' => __('content.requests.location_name_required'),
            'description.string' => __('content.requests.description_string'),
            'images.array' => __('content.requests.images_array'),
            'images..image' => __('content.requests.images__image'),
            'images..mimes' => __('content.requests.images__mimes'),
            'images..max' => __('content.requests.images__max'),
            'characteristicAdd.required' => __('content.requests.characteristic_required'), // Thông báo khi không chọn characteristic
         
         

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
