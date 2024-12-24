<?php

namespace App\Http\Controllers;
use App\Services\Contracts\UserDeviceServiceInterface;
use Illuminate\Http\Request;

class UserDeviceController extends Controller
{
    protected $userDeviceService;

    public function __construct(
        UserDeviceServiceInterface $userDeviceService
    ) {
        $this->userDeviceService = $userDeviceService;
    }

    public function index(Request $request)
    {
        $userDevices = $this->userDeviceService->getAll($request->all());
        if ($request->ajax()) {
            $html = view('admin.user-device.table', compact('userDevices'))->render();
            return response()->json(['html' => $html]);
        }
        return view('admin.user-device.index', compact('userDevices'));
    }
}
