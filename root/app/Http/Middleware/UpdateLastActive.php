<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserDevice;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class UpdateLastActive
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $agent = new Agent();
            $deviceName = $agent->device();
            $deviceType = $this->getDeviceType($agent);
            $deviceIp = $request->ip();
            $browser = $agent->browser();

            $device = UserDevice::where('user_id', Auth::id())
                ->where('device_name', $deviceName)
                ->where('device_type', $deviceType)
                ->where('device_ip', $deviceIp)
                ->where('browser', $browser)
                ->first();

            if ($device) {
                $device->update([
                    'last_active' => now(),
                    'status' => ACTIVE
                ]);
            }
        }

        return $next($request);
    }

    private function getDeviceType($agent)
    {
        if ($agent->isTablet()) {
            return TABLET;
        } elseif ($agent->isMobile()) {
            return MOBILE;
        } elseif ($agent->isDesktop()) {
            return DESKTOP;
        }
        return UNKNOWN;
    }
}
