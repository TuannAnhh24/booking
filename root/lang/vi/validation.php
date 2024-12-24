<?php

return [
    'login' => [
        'email' => [
            'required' => 'Email là bắt buộc.',
            'email' => 'Định dạng email không hợp lệ.',
        ],
        'password' => [
            'required' => 'Mật khẩu là bắt buộc.',
            'string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ],
        'check' => 'Email hoặc mật khẩu sai hoặc chưa tồn tại hoặc đã bị khoá',
        'login_required' => 'Bạn cần đăng nhập để truy cập trang này.',
    ],
    'register' => [
        'email' => [
            'required' => 'Email là bắt buộc.',
            'email' => 'Định dạng email không hợp lệ.',
            'unique' => 'Địa chỉ email này đã được đăng ký.',
        ],
        'password' => [
            'required' => 'Mật khẩu là bắt buộc.',
            'string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'confirmed' => 'Mật khẩu xác nhận không khớp.'
        ],
        'check' => 'Email hoặc mật khẩu sai hoặc chưa tồn tại',
        'login_required' => 'Bạn cần đăng nhập để truy cập trang này.',
    ],
    'changepassword' => [
        'current_password' => [
            'required' => 'Mật khẩu cũ không được để trống.',
            'min' => 'Mật khẩu cũ phải có ít nhất 8 ký tự.',
        ],
        'new_password' => [
            'required' => 'Mật khẩu mới không được để trống.',
            'min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'confirmed' => 'Mật khẩu xác nhận không khớp với mật khẩu mới.',
        ],
        'new_password_confirmation' => [
            'required' => 'Vui lòng xác nhận mật khẩu mới.',
            'min' => 'Mật khẩu xác nhận phải có ít nhất 8 ký tự.',
        ],
    ],

    'validation' => [
        'name' => [
            'required' => 'Tên biến thể là bắt buộc.',
            'string' => 'Tên biến thể phải là một chuỗi ký tự.',
            'max' => 'Tên biến thể không được vượt quá 255 ký tự.',
        ],
        'description' => [
            'string' => 'Mô tả phải là một chuỗi ký tự.',
        ],
        'variant_images' => [
            'array' => 'Hình ảnh phải được cung cấp dưới dạng mảng.',
            'image' => 'Mỗi tệp tải lên phải là một hình ảnh.',
            'mimes' => 'Mỗi hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'max' => 'Mỗi hình ảnh không được vượt quá 2MB.',
        ],
        'reason' => [
            'required' => 'Bạn phải nhập lý do để xóa biến thể.',
        ]

    ],
    'category_validation' => [
        'name' => [
            'required' => 'Tên danh mục phải là bắt buộc.',
            'string' => 'Tên danh mục phải là một chuỗi ký tự.',
            'max' => 'Tên danh mục phải là một chuỗi ký tự.',
            'unique' => 'Tên danh mục này đã được tạo.',
        ],
        'description' => [
            'string' => 'Mô tả phải là một chuỗi ký tự.',
        ],
        'images' => [
            'array' => 'Hình ảnh phải là cung cấp dưới dạng mảng.',
            'image' => 'Một hình ảnh phải là một hình ảnh.',
            'mimes' => 'Một hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'max' => 'Một hình ảnh phải là một hình ảnh.',
        ],
        'deleted_reason' => [
            'required' => 'Lý do xóa là bắt buộc.',
            'string' => 'Lý do xóa là một chuỗi ký tự.',
            'max' => 'Lý do xóa là một chuỗi ký tự.',
        ],
    ],
    'banner_validation' => [
        'img_banner' => [
            'image' => 'Hình ảnh phải là một hình ảnh.',
            'mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'max' => 'Hình ảnh phải là một hình ảnh.',
            'required' => 'Hình ảnh phải là bắt buộc.',
        ],
        'reason' => [
            'required' => 'Lý do xóa phải là bắt buộc.',
            'string' => 'Lý do xóa phải là một chuỗi ký tự.',
            'max' => 'Lý do xóa phải là một chuỗi ký tự.',
        ],
    ],
    'room_validation' => [
        'name' => [
            'required' => 'Tên phòng là bắt buộc.',
            'string' => 'Tên phòng phải là một chuỗi ký tự.',
            'max' => 'Tên phòng không được vượt quá 255 ký tự.',

        ],
        'description' => [

            'string' => 'Mô tả phải là một chuỗi ký tự.',

        ],
        'room_images' => [

            'array' => 'Hình ảnh phải được cung cấp dưới dạng mảng.',
            'image' => 'Mỗi tệp tải lên phải là một hình ảnh.',
            'mimes' => 'Mỗi hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'max' => 'Mỗi hình ảnh không được vượt quá 2MB.',

        ],
        'reason' => [

            'required' => 'Bạn phải nhập lý do để xóa phòng.',

        ],
        'destination_id' => [

            'required' => 'Bạn phải chọn một địa điểm.',
            'integer' => 'Bạn phải chọn một địa điểm.',
            'exists' => 'Địa điểm không hợp lệ.',

        ],
        'price' => [

            'required' => 'Giá phòng là bắt buộc.',
            'numeric' => 'Giá phòng phải là một số.',
            'min' => 'Giá phòng phải lớn hơn hoặc bằng 0.',

        ],
        'variant_id' => [

            'required' => 'Bạn phải chọn ít nhất một biến thể.',
            'array' => 'Dữ liệu biến thể phải là một mảng.',
            'min' => 'Bạn phải chọn ít nhất một biến thể.',
            'integer' => 'ID biến thể phải là một số nguyên.',
            'exists' => 'Biến thể bạn chọn không tồn tại.',

        ],
        'quantity' => [
            'required' => 'Số lượng phòng là bắt buộc.',
            'integer' => 'Số lượng phòng phải là một số nguyên.',
            'min' => 'Số lượng phòng phải lớn hơn hoặc bằng 1.',
            'max' => 'Số lượng phòng tối đa nhở hơn hoặc bằng 25.',

        ],
        'guest_quantity' => [
            'required' => 'Số lượng khách là bắt buộc.',
            'integer' => 'Số lượng khách phải là một số nguyên.',
            'min' => 'Số lượng khách phải lớn hơn hoặc bằng 1.',
            'max' => 'Số lượng khách tối đa nhở hơn hoặc bằng 4.',
        ],
    ],
    'forgot_password' => [
        'email' => [
            'required' => 'Email này là bắt buộc.',
            'email' => 'Email không hợp lệ.',
            'exists' => 'Email không tồn tại trong hệ thống.',
        ],
        'new_password' => [
            'required' => 'Mật khẩu là bắt buộc.',
            'string' => 'Mật này phải là một chuỗi ký tự.',
            'min' => 'Mật này phải có ít nhất 8 ký tự.',
            'confirmed' => 'Mật khẩu xác nhận không khớp.',
        ],
        'otp_code' => [
            'required' => 'Mã OTP là bắt buộc.',
            'string' => 'Mã OTP phải là một chuỗi ký tự.',
        ],
        'check' => 'Email sai hoặc chưa tồn tại',
    ],

    'validation_edit_profile' => [
        'avatar' =>  [
            'error' => 'Xin vui lòng chọn một hình ảnh để tải lên.',
            'success' => 'Cập nhật ảnh đại diện thành công',
            'error_update' => 'Lỗi cập nhật hình đại diện.',
            'error_delete' => 'Xóa thất bại',
            'success_delete' => 'Xóa thành công',
        ],
           
        'name' => [
            'first_name_required' => 'Tên là bắt buộc.',
            'first_name_string' => 'Tên phải là một chuỗi ký tự.',
            'first_name_max' => 'Tên không được vượt quá 255 ký tự.',
            
            'last_name_required' => 'Họ là bắt buộc.',
            'last_name_string' => 'Họ phải là một chuỗi ký tự.',
            'last_name_max' => 'Họ không được vượt quá 255 ký tự.',
        ],
        'displayName' => [
            'display_name_required' => 'Tên hiển thị là bắt buộc.',
            'display_name_string' => 'Tên hiển thị phải là một chuỗi ký tự.',
            'display_name_max' => 'Tên hiển thị không được vượt quá 255 ký tự.',
        ],
        'email' => [
            'email_required' => 'Địa chỉ email là bắt buộc.',
            'email' => 'Địa chỉ email không hợp lệ.',
            'email_unique' => 'Địa chỉ email này đã được sử dụng.',
        ],
        'phone' => [
            'phone_number_required' => 'Số điện thoại là bắt buộc.',
            'phone_number_regex' => 'Số điện thoại chỉ được chứa các ký tự số.',
            'phone_number_max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'phone_number_min' => 'Số điện thoại không được vượt quá 4 ký tự.',
        ],
        'birthday' => [
            'day_required' => 'Ngày là bắt buộc.',
            'day_numeric' => 'Ngày phải là một số nguyên.',
            'day_between' => 'Ngày phải nằm trong khoảng từ 1 đến 31.',
            'month_required' => 'Tháng là bắt buộc.',
            'year_required' => 'Năm là bắt buộc.',
            'year_integer' => 'Năm phải là một số nguyên.',
            'year_digits' => 'Năm phải có 4 chữ số.',
            'year_min' => 'Năm không hợp lệ.',
            'year_max' => 'Năm không thể lớn hơn năm hiện tại.',
        ],
        'address' => [
            'country_required' => 'Quốc gia là bắt buộc.',
            'country_string' => 'Quốc gia phải là một chuỗi ký tự.',
            'country_max' => 'Quốc gia không được vượt quá 100 ký tự.',
    
            'street_required' => 'Đường là bắt buộc.',
            'street_string' => 'Đường phải là một chuỗi ký tự.',
            'street_max' => 'Đường không được vượt quá 255 ký tự.',
    
            'city_required' => 'Thành phố là bắt buộc.',
            'city_string' => 'Thành phố phải là một chuỗi ký tự.',
            'city_max' => 'Thành phố không được vượt quá 100 ký tự.',
    
            'zip_required' => 'Mã bưu điện là bắt buộc.',
            'zip_regex' => 'Mã bưu điện phải là một dạng kí tự số.',
            'zip_max' => 'Mã bưu điện không được vượt quá 20 ký tự.',
        ],
        'nationality' => [
            'nationality_required' => 'Quốc tịch là bắt buộc.',
        ],
        'gender' => [
            'gender_required' => 'Giới tính là bắt buộc.',
            'gender_in' => 'Giới tính không hợp lệ. Vui lòng chọn Nam, Nữ hoặc Khác.',
        ],
        'passport' => [
            
            'passport_first_name_required' => 'Tên hộ chiếu là bắt buộc.',
            'passport_first_name_string' => 'Tên hộ chiếu phải là một chuỗi ký tự.',
            'passport_first_name_max' => 'Tên hộ chiếu không được vượt quá 255 ký tự.',
    
            'passport_last_name_required' => 'Họ hộ chiếu là bắt buộc.',
            'passport_last_name_string' => 'Họ hộ chiếu phải là một chuỗi ký tự.',
            'passport_last_name_max' => 'Họ hộ chiếu không được vượt quá 255 ký tự.',
    
            'passport_country_required' => 'Quốc gia hộ chiếu là bắt buộc.',
            'passport_country_string' => 'Quốc gia hộ chiếu phải là một chuỗi ký tự.',
            'passport_country_max' => 'Quốc gia hộ chiếu không được vượt quá 100 ký tự.',
    
            'passport_number_required' => 'Số hộ chiếu là bắt buộc.',
            'passport_number_regex' => 'Số hộ chiếu phải từ 6 đến 9 ký tự chữ hoặc số.',
            'passport_number_max' => 'Số hộ chiếu không được vượt quá 20 ký tự.',
            
            'expiry_day_required' => 'Ngày hết hạn hộ chiếu là bắt buộc.',
            'expiry_day_integer' => 'Ngày hết hạn hộ chiếu phải là số nguyên.',
            'expiry_day_between' => 'Ngày hết hạn hộ chiếu phải nằm trong khoảng từ 1 đến 31.',

            'expiry_month_required' => 'Tháng hết hạn hộ chiếu là bắt buộc.',
            'expiry_month_integer' => 'Tháng hết hạn hộ chiếu phải là số nguyên.',
            'expiry_month_between' => 'Tháng hết hạn hộ chiếu phải nằm trong khoảng từ 1 đến 12.',

            'expiry_year_required' => 'Năm hết hạn hộ chiếu là bắt buộc.',
            'expiry_year_min' => 'Năm hết hạn hộ chiếu không hợp lệ.',
            'expiry_year_max' => 'Năm hết hạn hộ chiếu không thể lớn hơn 10 năm so với hiện tại.',
           
        ],
        'success_delete' => 'Đã xóa thành công',
        'success' => 'Cập nhật thành công.',
        'success_email' => 'Đã gửi xác nhận về mail của bạn. Vui lòng kiểm tra mail'
    ],
    'history' => [
        'error_day' => 'Bạn chỉ có thể hủy đặt chỗ trước 2 ngày.'
    ],
];
