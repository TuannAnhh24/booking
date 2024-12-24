<?php

namespace App\Helpers;

use Carbon\Carbon;

if (!function_exists('formatDate')) {
    function formatDate($date, string $format = 'Y/m/d')
    {
        if ($date instanceof Carbon) {
            return $date->format($format);
        }

        return $date;
    }
}

if (!function_exists('getAssetUrl')) {
    function getAssetUrl($path)
    {
        if (str_starts_with($path, 'storage/')) {
            return asset(str_replace('storage/', '', $path));
        }
        return asset($path);
    }
}