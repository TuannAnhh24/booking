<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoomSelection
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu `room_quantity` không có trong request hoặc session
        if (!$request->has('room_quantity') && !session()->has('room.room_quantity')) {
            return redirect()->route('home')
                ->with('error',  __('content.booking.Please_select_a_room_and_quantity_before_proceeding') . '.');
        }

        // Nếu `room_quantity` có trong request, lưu vào session
        if ($request->has('room_quantity')) {
            session(['room.room_quantity' => $request['room_quantity']]);
        }

        return $next($request);
    }
}
