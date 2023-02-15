<?php

namespace App\Mail;

use App\Models\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserSongRejectedEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected Song $song;
    protected array $comments;
    protected Collection $approvedQuestionScores;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Song $song, array $comments, Collection $approvedQuestionScores)
    {
        $this->song = $song;
        $this->comments = $comments;
        $this->approvedQuestionScores = $approvedQuestionScores;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Wimbo ' . $this->song->name . ' Haujawa Reviewed')
            ->view('emails.user-song-rejected')
            ->with(
                [
                    'song' => $this->song,
                    'approvalQuestionScores' => $this->approvedQuestionScores,
                    'comments' => $this->comments,
                ]
            );
    }
}
