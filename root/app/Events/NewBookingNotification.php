<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewBookingNotification implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $message;
  public $userId;  // ID người nhận thông báo
  

 
  public function __construct($message, $userId)
  {
      $this->message = $message;
      $this->userId = $userId;  // Lưu thông tin người nhận thông báo
  }


  public function broadcastOn()
  {
      // Phát sự kiện vào kênh của người dùng cụ thể
      return ['user-' . $this->userId];  // Tạo kênh riêng cho người nhận thông báo
  }


  public function broadcastAs()
  {
      return 'booking';
      
  }
}
