<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteRoomRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Repositories\Contracts\DestinationRepository;
use App\Services\Contracts\RoomListServiceInterface;
use App\Services\Contracts\RoomServiceInterface;
use App\Services\Contracts\VariantServiceInterface;
use App\Services\Web\DestinationService;
use App\Services\Web\ReviewService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    protected $roomService;
    protected $roomListService;

    protected $destinationRepository;
    protected $variantService;
    protected $destinationService;
    protected $reviewService;

    public function __construct(RoomServiceInterface $roomService, VariantServiceInterface $variantService, DestinationRepository $destinationRepository, DestinationService $destinationService, ReviewService $reviewService, RoomListServiceInterface $roomListService)
    {
        $this->roomService = $roomService;
        $this->roomListService = $roomListService;
        $this->variantService = $variantService;
        $this->destinationRepository = $destinationRepository;
        $this->destinationService = $destinationService;
        $this->reviewService = $reviewService;
    }
    public function index()
    {
        $rooms = $this->roomService->getAllRoom();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create(Request $request)
    {
        try {
            $destinations = $this->destinationService->getAllDestinations();
            $variants = $this->variantService->getAllVariant($request->keyword, $paginate = false);

            return view('admin.rooms.partials.modal_content', compact('destinations', 'variants'));
        } catch (\Exception $e) {
            Log::error('Error in create method: ' . $e->getMessage());
            return redirect()->back()->with('error', __('content.room.error_create'));
        }
    }

    public function store(StoreRoomRequest $request)
    {
        try {
            $room = $this->roomService->storeRoom($request);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.create_room_title')])
                ->log(__('content.activity.create_room') . ': ' . $room->name);
            return redirect()->route('admin.rooms.index')->with('success', __('content.room.success_create'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.room.error_create'));
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $destinations = $this->destinationRepository->all();
            $variants = $this->variantService->getAllVariant($request->keyword, $paginate = false);
            $room = $this->roomService->getRoomById($id);
            $prices = $room->variants->first()->pivot->price_per_night ?? 0;
            $roomQuantity = $this->roomListService->getRoomQuantity($id);
            return view('admin.rooms.modals.modal_edit', compact('destinations', 'variants', 'room', 'prices', 'roomQuantity'));
        } catch (\Exception $e) {
            Log::error('Error in edit method: ' . $e->getMessage());
            return redirect()->back()->with('error', __('content.room.error_edit'));
        }
    }

    public function update(StoreRoomRequest $request, $id)
    {
        try {
            $room = $this->roomService->updateRoom($request, $id);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.update_room_title')])
                ->log(__('content.activity.update_room') . ': ' . $room->name);
            return redirect()->route('admin.room.index')->with('success', __('content.room.success_update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.room.error_update'));
        }
    }

    public function destroy(DeleteRoomRequest $request, $id)
    {
        try {

            $room = $this->roomService->deleteRoom($request, $id);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.delete_room_title')])
                ->log(__('content.activity.delete_room') . ': ' . $room->name);
            return redirect()->route('admin.rooms.index')->with('success', __('content.room.success_delete'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.room.error_delete'));
        }
    }
    public function restoreTrash($id)
    {
        $rooms = $this->roomService->restoreTrash($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.restore_room_title')])
            ->log(__('content.activity.restore_room') . ': ' . $rooms->name);
        return response()->json([
            'success' => true,
            'message' => 'Phòng đã được khôi phục thành công.'
        ], 200);
    }
    public function getTrash()
    {
        $rooms = $this->roomService->getTrash();
        return view('admin.rooms.trash', compact('rooms'));
    }
    public function forceDelete($id)
    {
        $rooms = $this->roomService->forceDelete($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.delete_room_title')])
            ->log(__('content.activity.delete_room') . ': ' . $rooms->name);
        return response()->json([
            'success' => true,
            'message' => 'Phòng đã được xóa thành công.'
        ], 200);
    }
}
