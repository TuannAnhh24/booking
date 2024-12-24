<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LocationController extends Controller
{
    public function getProvinces(): JsonResponse
    {
        return $this->getJsonData('provinces.json');
    }

    public function getDistricts(): JsonResponse
    {
        return $this->getJsonData('districts.json');
    }

    public function getWards(): JsonResponse
    {
        return $this->getJsonData('wards.json');
    }

    private function getJsonData(string $filename): JsonResponse
    {
        $path = public_path("public/api/{$filename}");
        if (!File::exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }
        
        $data = json_decode(File::get($path), true);
        return response()->json($data);
    }
}
