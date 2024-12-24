<?php

namespace App\Console;

use App\Console\Commands\SendAnnouncement;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendAnnouncement::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:send_announcement')->everyThirtyMinutes();
        $schedule->command('command:reset_access_day')->daily();
        $schedule->command('command:reset_office_location')->daily();
        $schedule->job(new \App\Jobs\UpdateUserOnlineStatus)->everyFiveMinutes();
        $schedule->job(new \App\Jobs\ClearExpiredOtps)->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
