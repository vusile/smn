<?php

namespace App\Listeners;

use App\Events\SongApproved;
use App\Mail\UserSongApprovedEmail;
use App\Mail\ComposerSongApprovedEmail;
use App\Services\SmsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSongApprovedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SongApproved  $event
     * @return void
     */
    public function handle(SongApproved $event)
    {
        $song = $event->song;

        $smsService = new SmsService();
        if(
            $smsService->sendSms(
                $song->user,
                'song_approved',
                ['name' => $song->name],
                ['url' => $song->url],
            )
        ) {
            return;
        }

        $userMessage = (new UserSongApprovedEmail($song))
                ->onQueue('songs');

        Mail::to($song->user->email)
            ->queue($userMessage);

        $composer = $song->composer;

        //todo: See if you can also send this as a message
        if ($composer->email && $composer->user_id != $song->user->id) {
            $composerMessage = (new ComposerSongApprovedEmail($song))
                    ->onQueue('songs');

            Mail::to($song->composer->email)
                ->bcc('admin@swahilimusicnotes.com')
                ->queue($composerMessage);
        }
    }
}
