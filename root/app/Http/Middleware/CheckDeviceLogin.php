<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\UserDeviceRepository;

class CheckDeviceLogin
{
    protected $userDeviceRepository;

    public function __construct(UserDeviceRepository $userDeviceRepository)
    {
        $this->userDeviceRepository = $userDeviceRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $deviceId = session('device_id');
            if (!$deviceId) {
                Auth::logout();
                return redirect()->route('login');
            }
            $device = $this->userDeviceRepository->findBy([
                'user_id' => $user->id,
                'id' => $deviceId,
            ]);
            if (!$device) {
                Auth::logout();
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
