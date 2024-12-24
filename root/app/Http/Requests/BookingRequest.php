<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException; 

class BookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'last_name' => 'required|string|max:50',
            'first_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255',
            'phone_number' => ['required', 'regex:/^[0-9]{9,10}$/'],
            'full_name_guest' => 'nullable|string|max:255',
            'email_guest' => 'nullable|string|email|max:255',
            'take_note' => 'nullable|string|max:255',
            'time_check_in' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => __('content.booking.required'),
            'string' => __('content.booking.string'),
            'max' => __('content.booking.max'),
            'email.email' => __('content.booking.Email_is_not_in_correct_format'),
            'phone_number.regex' => __('content.booking.The_phone_number_is_incorrect'),
            'email_guest.email' => __('content.booking.Email_is_not_in_correct_format'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
