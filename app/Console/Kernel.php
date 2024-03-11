<?php

namespace App\Console;

use App\Console\Commands\CleanUpDownloadsAndViewsTable;
use App\Console\Commands\FindComposerDuplicates;
use App\Console\Commands\CycleADominikaUpdates;
use App\Console\Commands\CycleBDominikaUpdates;
use App\Console\Commands\CycleCDominikaUpdates;
use App\Console\Commands\ReviewSongs;
use App\Console\Commands\UpdateComposerActiveSongs;
use App\Console\Commands\UpdateTotalContributions;
use App\Console\Commands\UpdateUserActiveSongs;
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
        CleanUpDownloadsAndViewsTable::class,
        CycleADominikaUpdates::class,
        CycleBDominikaUpdates::class,
        CycleCDominikaUpdates::class,
        UpdateTotalContributions::class,
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
        $schedule->command('sitemap:generate')->dailyAt("22:00");
        $schedule->command('review:songs')->everyFiveMinutes();
        $schedule->command('composers:update-active-songs')->everyTenMinutes();
        $schedule->command('users:update-active-songs')->everyTenMinutes();
        $schedule->command('queue:work --tries=2 --queue=songs --timeout=30')->cron('*/17 * * * *');
        $schedule->command('cache:clear')->everyTwoHours();
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
