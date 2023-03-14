<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\CommentPosted' => [
            'App\Listeners\SendCommentEmail',
        ],
        'App\Events\ComposerEmailCreated' => [
            'App\Listeners\SendComposerEmail',
        ],
        'App\Events\SongCreated' => [
            'App\Listeners\SendSongCreatedEmail',
        ],
        'App\Events\SongApproved' => [
            'App\Listeners\SendSongApprovedNotification',
        ],
        'App\Events\SongRejected' => [
            'App\Listeners\SendSongRejectedNotification',
        ],
        'App\Events\IthibatiApproved' => [
            'App\Listeners\SendIthibatiApprovedEmail',
        ],
        'App\Events\IthibatiRejected' => [
            'App\Listeners\SendIthibatiRejectedEmail',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
