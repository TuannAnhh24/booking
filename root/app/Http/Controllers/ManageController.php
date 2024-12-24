<?php

namespace App\Http\Controllers;

use App\Services\Contracts\RoomBookingServiceInterface;
use App\Services\Contracts\RoomListServiceInterface;
use App\Services\Contracts\RoomServiceInterface;
use Illuminate\Http\Request;

class ManageController extends Controller
{

    protected $roombookingService;
    protected $roomService;
    protected $roomListService;

    public function __construct(
        RoomBookingServiceInterface $roombookingService,
        RoomServiceInterface $roomService,
        RoomListServiceInterface $roomListService,
    ) {
        $this->roombookingService = $roombookingService;
        $this->roomService = $roomService;
        $this->roomListService = $roomListService;
    }
    public function manageBooking(Request $request)
    {
        try {
            $rooms = $this->roomService->getAllRoomManage();
            $bookings = $this->roombookingService->getUserBookings($request->all());
            if ($request->ajax()) {
                $html = view('admin.manage-room.table-booking', compact(['bookings', 'rooms']))->render();
                return response()->json(['html' => $html]);
            }
            return view('admin.manage-room.manage-booking', compact(['bookings', 'rooms']));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.controller-manager.error'));
        }
    }
    public function manageRoom(Request $request)
    {
        try {
            $rooms = $this->roomService->getAllRoomManage();
            $roomList = $this->roomListService->manageRoomList($request->all());
            if ($request->ajax()) {
                $html = view('admin.manage-room.table-room', compact(['roomList', 'rooms']))->render();
                return response()->json(['html' => $html]);
            }
            return view('admin.manage-room.manage-room', compact(['roomList', 'rooms']));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.controller-manager.error'));
        }
    }
    public function detailOrder($id)
    {
        try {
            $booking = $this->roombookingService->getBookingById($id);
            if ($booking !== null) {
                return view('admin.manage-room.detail-order', compact('booking'));
            }
            return redirect()->back()->with('error', __('content.controller-manager.error_booking_for_user'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.controller-manager.error'));
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $result = $this->roomListService->updateStatusOrder($id, $request);
            if (is_array($result) && isset($result['error'])) {
                return redirect()->back()->with('error', $result['error']);
            }
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.update_status_title')])
                ->log(__('content.activity.update_status'));
            return redirect()->back()->with('success', __('content.controller-manager.success'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.controller-manager.error_fail'));
        }
    }
    public function detailRoom($id)
    {
        try {
            $data = $this->roomListService->getRoomList($id);
            $room = $data['room'];
            $booking = $data['bookingDetails'];
            $isRoomAvailable = $data['isRoomAvailable'];
            if ($room !== null) {
                return view('admin.manage-room.detail-room', compact('room', 'booking', 'isRoomAvailable'));
            }
            return redirect()->back()->with('error', __('content.controller-manager.error_booking_for_user'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.controller-manager.error'));
        }
    }
}
