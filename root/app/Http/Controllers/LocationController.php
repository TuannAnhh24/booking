<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteLocationRequest;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Services\Contracts\CharacteristicServiceInterface;
use App\Services\Contracts\LocationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    protected $locationService;
    protected $characteristicService;

    public function __construct(LocationServiceInterface $locationService, CharacteristicServiceInterface $characteristicService)
    {
        $this->locationService = $locationService;
        $this->characteristicService = $characteristicService;
    }

    public function index(Request $request)
    {
        $characteristics = $this->characteristicService->getAllCharacteristics(false);
        $locations = $this->locationService->getAllLocations($request->keyword);
        if ($request->ajax()) {
            $html = view('admin.location.partials.table', compact('locations'))->render();
            return response()->json(['html' => $html]);
        }
        return view('admin.location.index', compact('locations', 'characteristics'));
    }

    public function store(LocationRequest $request)
    {

        DB::beginTransaction();
        try {
            $location = $this->locationService->createLocation($request);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.create_location_title')])
                ->log(__('content.activity.create_location') . ': ' . $location->name);
            DB::commit();
            return redirect()->route('admin.locations.index')
                ->with('success', __('content.requests.Success_add'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();

            return redirect()->route('admin.locations.index')
                ->with('error', __('content.requests.Fail_add') . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $characteristics = $this->characteristicService->getAllCharacteristics();
        $location = $this->locationService->getLocation($id);
        return view('admin.location.modal.edit', compact('location', 'characteristics'));
    }


    public function update(LocationUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $location = $this->locationService->updateLocation($request, $id);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.update_location_title')])
                ->log(__('content.activity.update_location') . ': ' . $location->name);
            DB::commit();
            return redirect()->route('admin.locations.index')
                ->with('success', __('content.requests.Success_update'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->route('admin.locations.index')
                ->with('error', __('content.requests.Fail_update') . $e->getMessage());
        }
    }

    public function destroy(DeleteLocationRequest $request, $id)
    {

        try {
            $location = $this->locationService->deleteLocation($id, $request->input('deleted_reason'));
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.delete_location_title')])
                ->log(__('content.activity.delete_location') . ': ' . $location->name);
            return redirect()->route('admin.locations.index')
                ->with('success', __('content.requests.Success_delete'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.locations.index')
                ->with('error', __('content.requests.Fail_delete') . $e->getMessage());
        }
    }
    public function restoreTrash($id)
    {
        $location = $this->locationService->restoreTrash($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.restore_location_title')])
            ->log(__('content.activity.restore_location') . ': ' . $location->name);
        return redirect()->route('admin.locations.index')
            ->with('success', __('content.category.category_restored_successfully'));
    }
    public function getTrash()
    {
        $locations = $this->locationService->getTrash();
        return view('admin.location.trash', compact('locations'));
    }
    public function forceDelete($id)
    {
        $location = $this->locationService->forceDelete($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.delete_location_title')])
            ->log(__('content.activity.delete_location') . ': ' . $location->name);
        return redirect()->route('admin.locations.index')
            ->with('success', __('content.category.category_deleted_successfully'));
    }
}
