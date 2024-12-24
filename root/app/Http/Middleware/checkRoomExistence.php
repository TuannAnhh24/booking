<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\RoomRepository;
use Closure;
use Illuminate\Http\Request;

class checkRoomExistence
{
    protected $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Lấy ID từ route
        $roomId = $request->route('id');
        
        // Kiểm tra sự tồn tại của phòng (Room)
        if (!$this->roomRepository->find($roomId)) {
            // Nếu không tìm thấy phòng, trả về thông báo lỗi
            return redirect()->route('admin.rooms.index')
                ->with('error', __('content.room.error_not_found'));
        }

        // Nếu phòng tồn tại, cho phép tiếp tục xử lý request
        return $next($request);
    }
}
