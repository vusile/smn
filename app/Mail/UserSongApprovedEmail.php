<?php

namespace App\Mail;

use App\Models\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserSongApprovedEmail extends Mailable
{
    use Queueable, SerializesModels;
    
     public $song;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Wimbo ' . $this->song->name . ' sasa Upo kwenye Tovuti')
            ->view('emails.user-song-approved');
    }
}
