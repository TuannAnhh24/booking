<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('user-{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;  // Chỉ người dùng đúng mới có thể tham gia kênh của mình
});
