<?php

namespace App\Mail;

use App\Models\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UserSongRejectedEmail extends Mailable
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
        $approvalQuestionScores = DB::table('reviews')
            ->select(DB::raw('count(*) as answers_count, review_question_id, question'))
            ->join('review_questions', 'review_questions.id', '=', 'reviews.review_question_id')
            ->groupBy('review_question_id')
            ->where('song_id', $this->song->id)
//            ->where('review_answer_id', 2)
            ->get();
        
        return $this->subject('Wimbo ' . $this->song->name . ' Haujawa Reviewed')
            ->view('emails.user-song-rejected')
            ->with(
                [
                    'song' => $this->song,
                    'approvalQuestionScores' => $approvalQuestionScores
                ]
            );
    }
}
