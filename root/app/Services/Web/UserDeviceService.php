<?php

namespace App\Services\Web;

use App\Repositories\Contracts\UserDeviceRepository;
use App\Services\Contracts\UserDeviceServiceInterface;
use Jenssegers\Agent\Agent;
use App\Traits\FileTrait;

class UserDeviceService implements UserDeviceServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $userDeviceRepository;

    public function __construct(UserDeviceRepository $userDeviceRepository)
    {
        $this->userDeviceRepository = $userDeviceRepository;
    }

    public function getAll($request)
    {
        $orderBy['updated_at'] = 'desc';
        $filters = [];
        if (!empty($request['keyword'])) {
            $filters['keyword'] = $request['keyword'];
        }
        if (!empty($request['name'])) {
            $filters['name'] = $request['name'];
        }
        if (!empty($request['device_name'])) {
            $filters['device_name'] = $request['device_name'];
        }
        if (!empty($request['device_type'])) {
            $filters['device_type'] = $request['device_type'];
        }
        if (!empty($request['device_ip'])) {
            $filters['device_ip'] = $request['device_ip'];
        }
        if (!empty($request['browser'])) {
            $filters['browser'] = $request['browser'];
        }
        if (!empty($request['status'])) {
            $filters['status'] = $request['status'];
        }
        $userDevice = $this->userDeviceRepository->paginateByFilters(
            $filters,
            PAGINATE_MAX_RECORD,
            ['user'],
            $orderBy
        )->withQueryString();

        return $userDevice;
    }
    public function getDeviceInfo() {}
    public function saveDeviceInfo($user, $data)
    {
        $agent = new Agent();
        $deviceName = $agent->device();
        $deviceType = $this->getDeviceType($agent);
        $browser = $agent->browser();
        $timeout = now()->addMinutes(config('session.lifetime'));
        $existingDevice = $this->userDeviceRepository->findBy([
            'user_id' => $user->id,
            'device_name' => $deviceName,
            'device_type' => $deviceType,
            'browser' => $browser,
        ]);
        $params = [];
        $params = [
            'user_id' => $user->id,
            'device_name' => $agent->device(),
            'device_type' => $this->getDeviceType($agent),
            'device_ip' => $data->ip(),
            'browser' => $agent->browser(),
            'login_time' => now(),
            'last_active' => now(),
            'time_out' => $timeout,
            'status' => ACTIVE,
        ];
        if ($existingDevice) {
            $userDevice = $this->userDeviceRepository->update($params, $existingDevice->id);
        } else {
            $userDevice = $this->userDeviceRepository->create($params);
        }
        return $userDevice;
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

    public function updateStatusLogout($user, $request)
    {
        $agent = new Agent();
        $deviceName = $agent->device();
        $deviceType = $this->getDeviceType($agent);
        $browser = $agent->browser();
        $deviceIp = $request->ip();

        $device = $this->userDeviceRepository->findBy([
            'user_id' => $user->id,
            'device_name' => $deviceName,
            'device_type' => $deviceType,
            'device_ip' => $deviceIp,
            'browser' => $browser,
        ]);

        if ($device) {
            $device->update([
                'status' => NOT_ACTIVE,
                'last_active' => now()
            ]);
            return $device;
        }
        return null;
    }

    public function getDevicesByUserId($user)
    {
        return $this->userDeviceRepository
            ->with('user')
            ->where('user_id', $user->id)
            ->paginate(PAGINATE_MAX_RECORD);
    }

    public function logoutAllDevices($user)
    {
        $user->devices()->delete();
        session()->forget('device_id');
        return true;
    }

    public function logoutDeviceById($user, $deviceId)
    {
        $device = $this->userDeviceRepository->findBy(['id' => $deviceId, 'user_id' => $user->id]);
        $device->delete();
        return true;
    }
}
