<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteDestinationRequest;
use App\Http\Requests\DestinationRequest;
use App\Http\Requests\DestinationUpdateRequest;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ConvenientServiceInterface;
use App\Services\Contracts\DestinationServiceInterface;
use App\Services\Contracts\LocationServiceInterface;
use Illuminate\Http\Request;


class DestinationController extends Controller
{
    protected $destinationService;
    protected $locationService;
    protected $categoryService;
    protected $convenientService;

    public function __construct(DestinationServiceInterface $destinationService, LocationServiceInterface $locationService, CategoryServiceInterface $categoryService, ConvenientServiceInterface $convenientService)
    {
        $this->destinationService = $destinationService;
        $this->locationService = $locationService;
        $this->categoryService = $categoryService;
        $this->convenientService = $convenientService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->getAllCategory($request->keyword, false);
        $convenients = $this->convenientService->getAllConvenients(false);
        $locations = $this->locationService->getAllLocations($request->keyword, false);
        $destinations = $this->destinationService->getAllDestinations();
        return view('admin.destinations.index', compact('destinations', 'locations', 'categories', 'convenients'));
    }

    public function store(DestinationRequest $request)
    {


        try {
            $destination = $this->destinationService->createDestination($request);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.create_destination_title')])
                ->log(__('content.activity.create_destination') . ': ' . $destination->name);
            return redirect()->route('admin.destinations.index')
                ->with('success', __('content.requests.Success_add'));
        } catch (\Exception $e) {
            return redirect()->route('admin.destinations.index')
                ->with('error', __('content.requests.Fail_add') . $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        $locations = $this->locationService->getAllLocations($request->keyword);
        $destination = $this->destinationService->getDestination($id);
        $categories = $this->categoryService->getAllCategory($request->keyword);
        $convenients = $this->convenientService->getAllConvenients();

        return view('admin.destinations.edit', compact('destination', 'locations', 'categories', 'convenients'));
    }


    public function update(DestinationUpdateRequest $request, $id)
    {

        try {
            $destination = $this->destinationService->updateDestination($request, $id);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.update_destination_title')])
                ->log(__('content.activity.update_destination') . ': ' . $destination->name);
            return redirect()->route('admin.destinations.index')
                ->with('success', __('content.requests.Success_update'));
        } catch (\Exception $e) {
            return redirect()->route('admin.destinations.index')
                ->with('error', __('content.requests.Fail_update') . $e->getMessage());
        }
    }

    public function destroy(DeleteDestinationRequest $request, $id)
    {
        try {
            $destination = $this->destinationService->deleteDestination($id, $request->input('deleted_reason'));
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.delete_destination_title')])
                ->log(__('content.activity.delete_destination') . ': ' . $destination->name);
            return redirect()->route('admin.destinations.index')
                ->with('success', __('content.requests.Success_delete'));
        } catch (\Exception $e) {
            return redirect()->route('admin.destinations.index')
                ->with('error', __('content.requests.Fail_delete') . $e->getMessage());
        }
    }
    public function restoreTrash($id)
    {
        $destination = $this->destinationService->restoreTrash($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.restore_destination_title')])
            ->log(__('content.activity.restore_destination') . ': ' . $destination->name);
        return redirect()->route('admin.destinations.index')
            ->with('success', __('content.category.category_restored_successfully'));
    }
    public function getTrash()
    {
        $destinations = $this->destinationService->getTrash();
        return view('admin.destinations.trash', compact('destinations'));
    }
    public function forceDelete($id)
    {
        $destination = $this->destinationService->forceDelete($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.delete_destination_title')])
            ->log(__('content.activity.delete_destination') . ': ' . $destination->name);
        return redirect()->route('admin.destinations.index')
            ->with('success', __('content.category.category_deleted_successfully'));
    }
}
