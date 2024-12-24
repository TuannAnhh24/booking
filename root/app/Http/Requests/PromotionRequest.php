<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException; 
class PromotionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'code' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'discount_type' => 'required|in:percentage,amount',
            'discount_percentage' => 'nullable|required_if:discount_type,percentage|numeric|min:1|max:100',
            'discount_amount' => 'nullable|required_if:discount_type,amount|numeric|min:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'quantity' => 'required|min:1',
        ];
        
        return $rules;
    }
    public function messages()
    {
        return [
            'required' => __('content.promotion.required'),
            'date' => __('content.promotion.date'),
            'in' => __('content.promotion.in'),
            'image' => __('content.promotion.image'),
            'mimes' => __('content.promotion.mimes'),
            'max' => __('content.promotion.max'),
            'integer' => __('content.promotion.integer'),
            'min' => __('content.promotion.min'),
            'after' => __('content.promotion.after'),
            'required_if' => __('content.promotion.required_if'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
