<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    // Hiển thị danh sách thông báo// Hiển thị danh sách thông báo // Lấy danh sách thông báo từ DB
    public function getNotifications()
    {
        // Lấy danh sách thông báo của người dùng đang đăng nhập
        $notifications = Notification::where('user_id', auth()->id())  // Điều kiện lọc theo user_id
            ->orderBy('created_at', 'desc') // Sắp xếp theo thời gian tạo
            ->get();

        // Trả về danh sách thông báo dưới dạng JSON
        return response()->json(['notifications' => $notifications]);
    }
    
}
