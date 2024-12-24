<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRoomRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name'               => 'required|string|max:255',
            'description'        => 'nullable|string',
            'room_images'        => 'nullable|array',
            'room_images.*'      => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'destination_id'     => 'required|integer|exists:destinations,id',
            'price'              => 'required|numeric|min:0',
            'variant_id'         => 'required|array|min:1',
            'variant_id.*'       => 'integer|exists:variants,id',
            'quantity'           => 'required|integer|min:1|max:25', 
            'guest_quantity'     => 'required|integer|min:1|max:4',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'                 => __('validation.room_validation.name.required'),
            'name.string'                   => __('validation.room_validation.name.string'),
            'name.max'                      => __('validation.room_validation.name.max'),
            'description.string'            => __('validation.room_validation.description.string'),
            'room_images.array'             => __('validation.room_validation.room_images.array'),
            'room_images.*.image'           => __('validation.room_validation.room_images.image'),
            'room_images.*.mimes'           => __('validation.room_validation.room_images.mimes'),
            'room_images.*.max'             => __('validation.room_validation.room_images.max'),
            'destination_id.required'       => __('validation.room_validation.destination_id.required'),
            'destination_id.integer'        => __('validation.room_validation.destination_id.integer'),
            'destination_id.exists'         => __('validation.room_validation.destination_id.exists'),
            'price.required'                => __('validation.room_validation.price.required'),
            'price.numeric'                 => __('validation.room_validation.price.numeric'),
            'price.min'                     => __('validation.room_validation.price.min'),
            'variant_id.required'           => __('validation.room_validation.variant_id.required'),
            'variant_id.array'              => __('validation.room_validation.variant_id.array'),
            'variant_id.min'                => __('validation.room_validation.variant_id.min'),
            'variant_id.*.integer'          => __('validation.room_validation.variant_id.integer'),
            'variant_id.*.exists'           => __('validation.room_validation.variant_id.exists'),
            'quantity.required'             => __('validation.room_validation.quantity.required'),
            'quantity.integer'              => __('validation.room_validation.quantity.integer'),
            'quantity.min'                  => __('validation.room_validation.quantity.min'),
            'quantity.max'                  => __('validation.room_validation.quantity.max'),
            'guest_quantity.required'       => __('validation.room_validation.guest_quantity.required'),
            'guest_quantity.integer'        => __('validation.room_validation.guest_quantity.integer'),
            'guest_quantity.min'            => __('validation.room_validation.guest_quantity.min'),
            'guest_quantity.max'            => __('validation.room_validation.guest_quantity.max'),

        ];
    }
    public function failedValidation(Validator $room)
    {
        $errors = $room->errors()->messages();
        throw new HttpResponseException(response()->json(['success' => false, 'errors' => $errors], 422));
    }
}