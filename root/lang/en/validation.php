<?php

return [
    'login' => [
        'email' => [
            'required' => 'Email is required.',
            'email' => 'Invalid email format.',
        ],
        'password' => [
            'required' => 'Password is required.',
            'string' => 'Password must be a string.',
            'min' => 'Password must be at least 8 characters.',
        ],
        'check' => 'Email or password is incorrect or does not exist.',
        'login_required' => 'You need to log in to access this page.',
    ],
    'register' => [
        'email' => [
            'required' => 'Email is required.',
            'email' => 'Invalid email format.',
            'unique' => 'This email address is already registered.',
        ],
        'password' => [
            'required' => 'Password is required.',
            'string' => 'Password must be a string.',
            'min' => 'Password must be at least 8 characters.',
            'confirmed' => 'Password confirmation does not match.'
        ],
        'check' => 'Email or password is incorrect or does not exist.',
        'login_required' => 'You need to log in to access this page.',
    ],
    'category_validation' => [
        'name' => [
            'required' => 'Category name is required.',
            'string' => 'Category name must be a string.',
            'max' => 'Category name must not exceed the maximum length.',
            'unique' => 'This category name has already been created.',
        ],
        'description' => [
            'string' => 'Description must be a string.',
        ],
        'images' => [
            'array' => 'Images must be provided as an array.',
            'image' => 'Each file must be an image.',
            'mimes' => 'Each image must be of type: jpeg, png, jpg, gif.',
            'max' => 'Each image must not exceed the maximum size.',
        ],
        'deleted_reason' => [
            'required' => 'Reason for deletion is required.',
            'string' => 'Reason for deletion must be a string.',
            'max' => 'Reason for deletion must not exceed the maximum length.',
        ],
    ],
    'banner_validation' => [
        'img_banner' => [
            'image' => 'Image must be an image.',
            'mimes' => 'Image must be of type: jpeg, png, jpg, gif.',
            'max' => 'Image must not exceed the maximum size.',
            'required' => 'Image is required.',
        ],
        'reason' => [
            'required' => 'Reason for deletion is required.',
            'string' => 'Reason for deletion must be a string.',
            'max' => 'Reason for deletion must not exceed the maximum length.',
        ],
    ],
    'forgot_password' => [
        'email' => [
            'required' => 'Email is required.',
            'email' => 'Invalid email.',
            'exists' => 'Email does not exist in the system.',
        ],
        'new_password' => [
            'required' => 'Password is required.',
            'string' => 'Password must be a string.',
            'min' => 'Password must be at least 8 characters long.',
            'confirmed' => 'Password confirmation does not match.',
        ],
        'otp_code' => [
            'required' => 'OTP code is required.',
            'string' => 'OTP code must be a string.',
        ],
        'check' => 'Email is incorrect or does not exist',
    ],
    'validation' => [
        'name' => [
            'required' => 'The variant name is required.',
            'string' => 'The variant name must be a string.',
            'max' => 'The variant name must not exceed 255 characters.',
        ],
        'description' => [
            'string' => 'The description must be a string.',
        ],
        'variant_images' => [
            'array' => 'Images must be provided as an array.',
            'image' => 'Each uploaded file must be an image.',
            'mimes' => 'Each image must be in one of the following formats: jpeg, png, jpg, gif.',
            'max' => 'Each image must not exceed 2MB.',
        ],
        'reason' => [
            'required' => 'You must provide a reason for deleting the variant.',
        ]
    ],
    'room_validation' => [
        'name' => [
            'required' => 'The room name is required.',
            'string' => 'The room name must be a string.',
            'max' => 'The room name must not exceed 255 characters.',
        ],
        'description' => [
            'string' => 'The description must be a string.',
        ],
        'room_images' => [
            'array' => 'Images must be provided as an array.',
            'image' => 'Each uploaded file must be an image.',
            'mimes' => 'Each image must be in one of the following formats: jpeg, png, jpg, gif.',
            'max' => 'Each image must not exceed 2MB.',
        ],
        'reason' => [
            'required' => 'You must provide a reason for deleting the room.',
        ],
        'destination_id' => [
            'required' => 'You must select a destination.',
            'integer' => 'The destination must be a valid integer.',
            'exists' => 'The selected destination is invalid.',
        ],
        'price' => [
            'required' => 'The room price is required.',
            'numeric' => 'The room price must be a number.',
            'min' => 'The room price must be greater than or equal to 0.',
        ],
        'variant_id' => [
            'required' => 'You must select at least one variant.',
            'array' => 'The variant data must be an array.',
            'min' => 'You must select at least one variant.',
            'integer' => 'The variant ID must be an integer.',
            'exists' => 'The selected variant does not exist.',
        ],
        'quantity' => [
            'required' => 'The room quantity is required.',
            'integer' => 'The room quantity must be an integer.',
            'min' => 'The room quantity must be greater than or equal to 1.',
            'max' => 'The room quantity must be less than or equal to 25.',
        ],
        'guest_quantity' => [
            'required' => 'The guest quantity is required.',
            'integer' => 'The guest quantity must be an integer.',
            'min' => 'The guest quantity must be greater than or equal to 1.',
            'max' => 'The guest quantity must be less than or equal to 4.',
        ],
    ],
    'changepassword' => [
        'current_password' => [
            'required' => 'Current password is required.',
            'min' => 'Current password must be at least 8 characters.',
        ],
        'new_password' => [
            'required' => 'New password is required.',
            'min' => 'New password must be at least 8 characters.',
            'confirmed' => 'Password confirmation does not match the new password.',
        ],
        'new_password_confirmation' => [
            'required' => 'Please confirm the new password.',
            'min' => 'Password confirmation must be at least 8 characters.',
        ],
    ],
    'validation_edit_profile' => [
        'name' => [
            'first_name_required' => 'First name is required.',
            'first_name_string' => 'First name must be a string.',
            'first_name_max' => 'First name cannot exceed 255 characters.',
            
            'last_name_required' => 'Last name is required.',
            'last_name_string' => 'Last name must be a string.',
            'last_name_max' => 'Last name cannot exceed 255 characters.',
        ],
        'displayName' => [
            'display_name_required' => 'Display name is required.',
            'display_name_string' => 'Display name must be a string.',
            'display_name_max' => 'Display name cannot exceed 255 characters.',
        ],
        'email' => [
            'email_required' => 'Email address is required.',
            'email' => 'The email address is not valid.',
            'email_unique' => 'This email address is already in use.',
        ],
        'phone' => [
            'phone_number_required' => 'Phone number is required.',
            'phone_number_regex' => 'Phone number can only contain numeric characters.',
            'phone_number_max' => 'Phone number cannot exceed 15 characters.',
            'phone_number_min' => 'Phone number must be at least 4 characters.',
        ],
        'birthday' => [
            'day_required' => 'Day is required.',
            'day_numeric' => 'Day must be an integer.',
            'day_between' => 'Day must be between 1 and 31.',
            'month_required' => 'Month is required.',
            'year_required' => 'Year is required.',
            'year_integer' => 'Year must be an integer.',
            'year_digits' => 'Year must have 4 digits.',
            'year_min' => 'The year is not valid.',
            'year_max' => 'The year cannot exceed the current year.',
        ],
        'address' => [
            'country_required' => 'Country is required.',
            'country_string' => 'Country must be a string.',
            'country_max' => 'Country cannot exceed 100 characters.',
            
            'street_required' => 'Street is required.',
            'street_string' => 'Street must be a string.',
            'street_max' => 'Street cannot exceed 255 characters.',
            
            'city_required' => 'City is required.',
            'city_string' => 'City must be a string.',
            'city_max' => 'City cannot exceed 100 characters.',
            
            'zip_required' => 'ZIP code is required.',
            'zip_regex' => 'ZIP code must be numeric.',
            'zip_max' => 'ZIP code cannot exceed 20 characters.',
        ],
        'nationality' => [
            'nationality_required' => 'Nationality is required.',
        ],
        'gender' => [
            'gender_required' => 'Gender is required.',
            'gender_in' => 'Gender is invalid. Please select Male, Female, or Other.',
        ],
        'passport' => [
            'passport_first_name_required' => 'Passport first name is required.',
            'passport_first_name_string' => 'Passport first name must be a string.',
            'passport_first_name_max' => 'Passport first name cannot exceed 255 characters.',
            
            'passport_last_name_required' => 'Passport last name is required.',
            'passport_last_name_string' => 'Passport last name must be a string.',
            'passport_last_name_max' => 'Passport last name cannot exceed 255 characters.',
            
            'passport_country_required' => 'Passport country is required.',
            'passport_country_string' => 'Passport country must be a string.',
            'passport_country_max' => 'Passport country cannot exceed 100 characters.',
            
            'passport_number_required' => 'Passport number is required.',
            'passport_number_regex' => 'Passport number must be between 6 and 9 alphanumeric characters.',
            'passport_number_max' => 'Passport number cannot exceed 20 characters.',
            
            'expiry_day_required' => 'Passport expiry day is required.',
            'expiry_day_integer' => 'Passport expiry day must be an integer.',
            'expiry_day_between' => 'Passport expiry day must be between 1 and 31.',
            
            'expiry_month_required' => 'Passport expiry month is required.',
            'expiry_month_integer' => 'Passport expiry month must be an integer.',
            'expiry_month_between' => 'Passport expiry month must be between 1 and 12.',
            
            'expiry_year_required' => 'Passport expiry year is required.',
            'expiry_year_min' => 'Passport expiry year is not valid.',
            'expiry_year_max' => 'Passport expiry year cannot exceed 10 years from the current year.',
        ],
        'success_delete' => 'Successfully deleted.',
        'success' => 'Successfully updated.',
        'success_email' => 'A confirmation email has been sent. Please check your inbox.',
    ],
    'history' => [
        'error_day' => 'You can only cancel a booking at least 2 days in advance.',
    ],

];
