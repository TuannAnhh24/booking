<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacteristicRequest;
use App\Http\Requests\DeleteCharacteristicRequest;
use App\Services\Contracts\CharacteristicServiceInterface;
use Illuminate\Http\Request;

class CharacteristicController extends Controller
{
    protected $characteristicService;
    public function __construct(CharacteristicServiceInterface $characteristicService)
    {
        $this->characteristicService = $characteristicService;
    }
    public function index(Request $request)
    {
        $characteristics = $this->characteristicService->getAllCharacteristics();
        return view('admin.characteristics.index', compact('characteristics'));
    }
    public function store(CharacteristicRequest $request)
    {
        try {
            $characteristic = $this->characteristicService->createCharacteristic($request);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.create_characteristic_title')])
                ->log(__('content.activity.create_characteristic') . ': ' . $characteristic->name);
            return redirect()->route('admin.characteristics.index')
                ->with('success', __('content.requests.Success_add'));
        } catch (\Exception $e) {
            return redirect()->route('admin.characteristics.index')
                ->with('error', __('content.requests.Fail_add') . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $characteristic = $this->characteristicService->getCharacteristic($id);

        // Xử lý logic và chuyển dữ liệu cần thiết
        return view('admin.characteristics.edit', compact('characteristic'));
    }

    public function update(CharacteristicRequest $request, $id)
    {

        try {
            $characteristic = $this->characteristicService->updateCharacteristic($request, $id);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.update_characteristic_title')])
                ->log(__('content.activity.update_characteristic') . ': ' . $characteristic->name);
            return redirect()->route('admin.characteristics.index')
                ->with('success', __('content.requests.Success_update'));
        } catch (\Exception $e) {
            return redirect()->route('admin.characteristics.index')
                ->with('error', __('content.requests.Fail_update') . $e->getMessage());
        }
    }
    public function destroy(DeleteCharacteristicRequest $request, $id)
    {
        try {
            $characteristic = $this->characteristicService->deleteCharacteristic($id, $request->input('deleted_reason'));
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.delete_characteristic_title')])
                ->log(__('content.activity.delete_characteristic') . ': ' . $characteristic->name);
            return redirect()->route('admin.characteristics.index')
                ->with('success', __('content.requests.Success_delete'));
        } catch (\Exception $e) {
            return redirect()->route('admin.characteristics.index')
                ->with('error', __('content.requests.Fail_delete') . $e->getMessage());
        }
    }
    public function restoreTrash($id)
    {
        $characteristic = $this->characteristicService->restoreTrash($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.restore_characteristic_title')])
            ->log(__('content.activity.restore_characteristic') . ': ' . $characteristic->name);
        return redirect()->route('admin.convenients.index')
            ->with('success', __('content.category.category_restored_successfully'));
    }
    public function getTrash()
    {
        $characteristics = $this->characteristicService->getTrash();
        return view('admin.characteristics.trash', compact('characteristics'));
    }
    public function forceDelete($id)
    {
        $characteristic = $this->characteristicService->forceDelete($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.delete_characteristic_title')])
            ->log(__('content.activity.delete_characteristic') . ': ' . $characteristic->name);
        return redirect()->route('admin.characteristics.index')
            ->with('success', __('content.category.category_deleted_successfully'));
    }
}
