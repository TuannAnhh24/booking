<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConvenientRequest;
use App\Http\Requests\DeleteConvenientRequest;
use App\Services\Contracts\ConvenientServiceInterface;
use Illuminate\Http\Request;

class ConvenientController extends Controller
{
    protected $convenientService;
    public function __construct(ConvenientServiceInterface $convenientService)
    {
        $this->convenientService = $convenientService;
    }
    public function index(Request $request)
    {
        $convenients = $this->convenientService->getAllConvenients();
        return view('admin.convenients.index', compact('convenients'));
    }
    public function store(Request $request)
    {
        try {
            $convenient = $this->convenientService->createConvenient($request);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.create_convenient_title')])
                ->log(__('content.activity.create_convenient') . ': ' . $convenient->name);
            return redirect()->route('admin.convenients.index')
                ->with('success', __('content.requests.Success_add'));
        } catch (\Exception $e) {
            return redirect()->route('admin.convenients.index')
                ->with('error', __('content.requests.Fail_add') . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $convenient = $this->convenientService->getConvenient($id);

        // Xử lý logic và chuyển dữ liệu cần thiết
        return view('admin.convenients.edit', compact('convenient'));
    }

    public function update(ConvenientRequest $request, $id)
    {

        try {
            $convenient = $this->convenientService->updateConvenient($request, $id);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.update_convenient_title')])
                ->log(__('content.activity.update_convenient') . ': ' . $convenient->name);
            return redirect()->route('admin.convenients.index')
                ->with('success', __('content.requests.Success_update'));
        } catch (\Exception $e) {
            return redirect()->route('admin.convenients.index')
                ->with('error', __('content.requests.Fail_update') . $e->getMessage());
        }
    }
    public function destroy(DeleteConvenientRequest $request, $id)
    {
        try {
            $convenient = $this->convenientService->deleteConvenient($id, $request->input('deleted_reason'));
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.delete_convenient_title')])
                ->log(__('content.activity.delete_convenient') . ': ' . $convenient->name);
            return redirect()->route('admin.convenients.index')
                ->with('success', __('content.requests.Success_delete'));
        } catch (\Exception $e) {
            return redirect()->route('admin.convenients.index')
                ->with('error', __('content.requests.Fail_delete') . $e->getMessage());
        }
    }
    public function restoreTrash($id)
    {
        $convenient = $this->convenientService->restoreTrash($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.restore_convenient_title')])
            ->log(__('content.activity.restore_convenient') . ': ' . $convenient->name);
        return redirect()->route('admin.convenients.index')
            ->with('success', __('content.category.category_restored_successfully'));
    }
    public function getTrash()
    {
        $convenients = $this->convenientService->getTrash();
        return view('admin.convenients.trash', compact('convenients'));
    }
    public function forceDelete($id)
    {
        $convenient = $this->convenientService->forceDelete($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.delete_convenient_title')])
            ->log(__('content.activity.delete_convenient') . ': ' . $convenient->name);
        return redirect()->route('admin.convenients.index')
            ->with('success', __('content.category.category_deleted_successfully'));
    }
}
