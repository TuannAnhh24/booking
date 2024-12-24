<?php

namespace App\Http\Controllers;
use App\Services\Contracts\UserDeviceServiceInterface;
use App\Services\Contracts\UserServiceInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class YourpropertyController extends Controller
{
    protected $userService;
    protected $userDeviceService;

    public function __construct(
        UserServiceInterface $userService,
        UserDeviceServiceInterface $userDeviceService,
    ) {
        $this->userService = $userService;
        $this->userDeviceService = $userDeviceService;
    }
    public function index(Request $request)
    {
        $users = $this->userService->getAll($request->keyword);

        if ($request->ajax()) {
            $html = view('admin.user.table', compact('users'))->render();
            return response()->json(['html' => $html]);
        }
        return view('admin.user.index', compact('users'));
    }
    public function showLogin()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return view('login');
    }

    
}
