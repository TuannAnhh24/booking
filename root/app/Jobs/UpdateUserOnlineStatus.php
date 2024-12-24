<?php

namespace App\Jobs;

use App\Models\UserDevice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateUserOnlineStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // GET ALL USER DEVICE 
        $devices = UserDevice::all();

        foreach ($devices as $device) {

            if ($device->last_active < now()->subMinutes(5)) {
                $device->update(['status' => NOT_ACTIVE]); // update offline status
            } else {
                $device->update(['status' => ACTIVE]); // users online
            }
        }
    }
}
