<?php

namespace App\Mail;

use App\Models\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class IthibatiRejectedEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $song;

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
        $failedReview = DB::table('ithibati_songs')
            ->where('song_id', $this->song->id)
            ->first();

        return $this->subject('Wimbo ' . $this->song->name . ' Umekosa Ithibati')
            ->view('emails.ithibati-rejected')
            ->with(
                [
                    'song' => $this->song,
                    'failedReview' => $failedReview,
                ]
            );
    }
}
