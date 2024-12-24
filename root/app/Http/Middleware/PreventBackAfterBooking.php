<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PreventBackAfterBooking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
          // Nếu session 'booking_completed' đã tồn tại, chặn quay lại các bước trước đó
        if (Session::has('booking_completed')) {
            $currentRouteName = $request->route()->getName();
            $allowedRoutes = ['booking.invoice', 'home']; // Các route cho phép sau khi đặt phòng thành công

            if (!in_array($currentRouteName, $allowedRoutes)) {
                return redirect()->route('booking.invoice', ['booking_id' => session('booking_id')])
                    ->with('error', __('Bạn không thể quay lại sau khi hoàn tất đặt phòng.'));
            }
        }
        return $next($request);
    }
}
