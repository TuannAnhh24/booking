<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteVariantRequest;
use App\Http\Requests\StoreVariantRequest;
use App\Services\Contracts\VariantServiceInterface;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    protected $variantService;
    public function __construct(VariantServiceInterface $variantService)
    {
        $this->variantService = $variantService;
    }
    public function index(Request $request)
    {
        $variants = $this->variantService->getAllVariant($request->keyword);
        if ($request->ajax()) {
            $html = view('admin.variants.partials.table', compact('variants'))->render();
            return response()->json(['html' => $html]);
        }
        return view('admin.variants.index', compact('variants'));
    }


    public function create()
    {
        return view('admin.variant.create');
    }


    public function store(StoreVariantRequest $request)
    {
        try {
            $variants = $this->variantService->storeVariant($request);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.create_variant_title')])
                ->log(__('content.activity.create_variant') . ': ' . $variants->name);
            return redirect()->route('admin.variants.index')->with('success', __('content.variant.success_create'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.variant.error_create'));
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $variant = $this->variantService->getVariantById($id);
        return view('admin.variants.modals.modal_edit', compact('variant'));
    }


    public function update(StoreVariantRequest $request, $id)
    {
        try {
            $variant = $this->variantService->updateVariant($request, $id);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.update_variant_title')])
                ->log(__('content.activity.update_variant') . ': ' . $variant->name);
            return redirect()->route('admin.variants.index')->with('success', __('content.variant.success_update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.variant.error_update'));
        }
    }

    public function destroy(DeleteVariantRequest $request, $id)
    {
        try {

            $variant = $this->variantService->deleteVariant($request, $id);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.delete_variant_title')])
                ->log(__('content.activity.delete_variant') . ': ' . $variant->name);
            return redirect()->route('admin.variants.index')->with('success', __('content.variant.success_delete'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.variant.error_delete'));
        }
    }
    public function restoreTrash($id)
    {
        $variants = $this->variantService->restoreTrash($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.restore_variant_title')])
            ->log(__('content.activity.restore_variant') . ': ' . $variants->name);
        return response()->json([
            'success' => true,
            'message' => __('content.variant.variant_restored_successfully')
        ], 200);
    }
    public function getTrash()
    {
        $variants = $this->variantService->getTrash();
        return view('admin.variants.trash', compact('variants'));
    }
    public function forceDelete($id)
    {
        $variants = $this->variantService->forceDelete($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.delete_variant_title')])
            ->log(__('content.activity.delete_variant') . ': ' . $variants->name);
        return response()->json([
            'success' => true,
            'message' => __('content.variant.variant_deleted_successfully')
        ], 200);
    }
}
