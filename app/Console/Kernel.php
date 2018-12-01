<?php

namespace App\Console;

use App\Console\Commands\ReviewSongs;
use App\Console\Commands\FindComposerDuplicates;
use App\Console\Commands\UpdateComposerActiveSongs;
use App\Console\Commands\UpdateUserActiveSongs;
use App\Console\Commands\CleanUpDownloadsAndViewsTable;
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
        ReviewSongs::class,
        FindComposerDuplicates::class,
        UpdateComposerActiveSongs::class,
        UpdateUserActiveSongs::class,
        CleanUpDownloadsAndViewsTable::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('clean-up:downloads-views')->daily();
        $schedule->command('review:songs')->everyFiveMinutes();
        $schedule->command('composers:update-active-songs')->everyTenMinutes();
        $schedule->command('users:update-active-songs')->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
