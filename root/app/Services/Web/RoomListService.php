<?php

namespace App\Services\Web;

use App\Models\RoomList;
use App\Repositories\Contracts\RoomListRepository;
use App\Services\Contracts\RoomListServiceInterface;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RoomListService implements RoomListServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $roomListRepository;

    public function __construct(RoomListRepository $roomListRepository)
    {
        $this->roomListRepository = $roomListRepository;
    }

    public function getRoomQuantity($roomId)
    {
        return $this->roomListRepository->countByRoomId($roomId);
    }

    public function getRoomListsByRoomId($roomId)
    {
        // Sửa lại để trả về tất cả danh sách phòng theo `room_id`
        return $this->roomListRepository->findByRoomId($roomId);
    }

    public function createRoomListEntry($roomId, $status = 'trống')
    {
        return $this->roomListRepository->create([
            'room_id' => $roomId,
            'status' => $status,
        ]);
    }

    public function deleteRoomListEntries($ids)
    {

        return $this->roomListRepository->deleteMany($ids);
    }
    public function findRoomListById($id)
    {
        return $this->roomListRepository->find($id);
    }
    public function manageRoomList($request)
    {
        $userId = auth()->id();
        if (!$userId) {
            return null;
        }
        $filters = [];
        if (!empty($request['keyword'])) {
            $filters['keyword'] = $request['keyword'];
        }
        if (!empty($request['roomType'])) {
            $filters['roomType'] = $request['roomType'];
        }
        if (!empty($request['maxGuests'])) {
            $filters['maxGuests'] = $request['maxGuests'];
        }
        if (!empty($request['bookerName'])) {
            $filters['bookerName'] = $request['bookerName'];
        }
        if (!empty($request['phoneNumber'])) {
            $filters['phoneNumber'] = $request['phoneNumber'];
        }
        if (!empty($request['status'])) {
            $filters['status'] = $request['status'];
        }
        $roomListRepository = $this->roomListRepository->buildQuery(RoomList::query(), $filters)
            ->orderBy('updated_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->withQueryString();

        return $roomListRepository;
    }
    public function updateStatusOrder($id, $request)
    {
        if (!is_array($id)) {
            $id = [$id];
        }
        $bookings = DB::table('room_list_booking')
            ->whereIn('booking_id', $id)
            ->get(['booking_id', 'status', 'available_from', 'available_to']);

        foreach ($bookings as $booking) {
            if (in_array($booking->status, [COMPLETED, CANCELED])) {
                return ['error' => __('content.controller-manager.status_not_allowed')];
            }
            if ($request->status === CANCELED) {
                $now = Carbon::now();
                $checkTime = Carbon::parse($booking->available_from);
                if ($checkTime->diffInDays($now, false) <= 15) {
                    return ['error' => __('content.controller-manager.status_too_early')];
                }
            }
            if ($request->status === COMPLETED) {
                $now = Carbon::now();
                $availableTo = Carbon::parse($booking->available_to);
                if ($now->lessThanOrEqualTo($availableTo)) {
                    return ['error' => __('content.controller-manager.status_not_allowed_due_to_time')];
                }
            }
        }
        $updated = DB::table('room_list_booking')
            ->where('booking_id', $id)
            ->update(['status' => $request->status]);
        return $updated;
    }

    public function addNameRoom($id, $data)
    {
        $roomList = $this->roomListRepository->find($id);
        $params = [
            'name_room' => $data->name_room,
        ];
        $roomList = $this->roomListRepository->update($params, $roomList->id);
        return $roomList;
    }
    public function getRoomList($id)
    {
        $room = $this->roomListRepository->with(['roomListBookings', 'room.destinations.locations', 'room.images'])->find($id);
        $currentDateTime = now();
        $bookingDetails = null;

        foreach ($room->roomListBookings as $booking) {
            if ($booking->available_from <= $currentDateTime && $booking->available_to >= $currentDateTime) {
                $bookingDetails = $booking->booking;
                break;
            }
        }
        return [
            'room' => $room,
            'bookingDetails' => $bookingDetails,
            'isRoomAvailable' => $bookingDetails ? false : true
        ];
    }
}
