<?php

namespace App\Mail;

use App\Models\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class IthibatiApprovedComposerEmail extends Mailable
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
        $songReview = DB::table('reviewer_songs')
            ->where('song_id', $this->song->id)
            ->first();
        
        $uhakikiUsers = DB::table('model_has_roles')
            ->where('role_id', 2)
            ->pluck('model_id')
            ->toArray();
        
        $whoMadeChange = $this->song
            ->revisionHistory
            ->pluck('user_id')
            ->toArray();
        
        if(count(array_intersect($uhakikiUsers, $whoMadeChange)) > 0) {
            $showChanges = true;
        } else {
            $showChanges = false;
        }
        
        return $this->subject('Wimbo ' . $this->song->name . ' Umepata Ithibati')
            ->view('emails.composer-ithibati-approved')
            ->with(
                    [
                        'songReview' => $songReview,
                        'showChanges' => $showChanges,
                    ]
                );
    }
}
