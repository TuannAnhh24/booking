<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BannerRequest extends FormRequest
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'images.*.image' => __('validation.banner_validation.img_banner.image'),
            'images.*.mimes' => __('validation.banner_validation.img_banner.mimes'), 
            'images.*.max' => __('validation.banner_validation.img_banner.max'),
            'images.required' => __('validation.banner_validation.img_banner.required'),
            'images.*.required' => __('validation.banner_validation.img_banner.required')
         ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
