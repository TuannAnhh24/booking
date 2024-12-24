<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::where('causer_id', auth()->id())
            ->latest()
            ->paginate(PAGINATE_MAX_RECORD);
        return view('client.user_profiles.activity', compact('activities'));
    }

}