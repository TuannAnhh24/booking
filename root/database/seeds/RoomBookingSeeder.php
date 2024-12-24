<?php

namespace Database\Seeders;

use App\Models\RoomBooking;
use Illuminate\Database\Seeder;

class RoomBookingSeeder extends Seeder
{
    public function run()
    {
        RoomBooking::create([
            'user_id' => '2',
            'room_varant_id' => '1',
            'room_booking_detail' => json_encode([
                'destination' => 'Tiểu vương quốc mễ trì',
                'room' => 'phòng 1 người đủ nội thất',
                'night_count' => 3,
                'room_price' => 2400000,
            ]),
            'check_in' => '2024-10-05',
            'check_out' => '2024-10-08',
            'guest_details' => json_encode([
                'booker_name' => 'Tuấn Anh',
                'guest_name' => 'Minh Nhật',
                'contact' => '0866011730',
            ]),
            'total_price' => 2400000,
            'take_note' => 'Trang Trí Hoa Hồng',
        ]);

        RoomBooking::create([
            'user_id' => '3',
            'room_varant_id' => '2',
            'room_booking_detail' => json_encode([
                'destination' => 'Khách sạn to nhất mễ trì',
                'room' => 'phòng luxury',
                'night_count' => 5,
                'room_price' => 5500000,
            ]),
            'check_in' => '2024-10-10',
            'check_out' => '2024-10-12',
            'guest_details' => json_encode([
                'booker_name' => 'Tmoon',
                'guest_name' => 'Tuấn Simon',
                'contact' => '0866011730',
            ]),
            'total_price' => 5500000,
            'take_note' => 'Full nội thất kim cương',
        ]);
    }
}
