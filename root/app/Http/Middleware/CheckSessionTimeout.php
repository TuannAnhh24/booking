<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\UserDeviceRepository;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

class CheckSessionTimeout
{
    protected $userDeviceRepository;

    public function __construct(UserDeviceRepository $userDeviceRepository)
    {
        $this->userDeviceRepository = $userDeviceRepository;
    }

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = Session::get('last_activity', now());

            if (now()->diffInMinutes($lastActivity) > config('session.lifetime')) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login');
            }

            Session::put('last_activity', now());

            $lifetime = config('session.lifetime');
            $timeOut = Carbon::now()->addMinutes($lifetime);

            $agent = new Agent();
            $deviceName = $agent->device();
            $deviceType = $this->getDeviceType($agent);
            $browser = $agent->browser();

            $device = $this->userDeviceRepository->findBy([
                'user_id' => Auth::id(),
                'device_name' => $deviceName,
                'device_type' => $deviceType,
                'browser' => $browser,
            ]);

            if ($device) {
                $device->update([
                    'time_out' => $timeOut,
                ]);
            }
        }

        return $next($request);
    }

    private function getDeviceType(Agent $agent)
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
