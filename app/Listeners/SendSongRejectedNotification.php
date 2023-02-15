<?php

namespace App\Listeners;

use App\Events\SongRejected;
use App\Mail\UserSongRejectedEmail;
use App\Services\SmsService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendSongRejectedNotification
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
     * @param  SongRejected  $event
     * @return void
     */
    public function handle(SongRejected $event)
    {
        $song = $event->song;
        $reviews = $this->getReviews($song);

        if($song->user->has_whatsapp) {
            $smsService = new SmsService();
            $this->formatForWhatsApp($reviews);

            $smsService->sendSms(
                $song->user,
                'song_not_approved',
                [
                    'name' => whatsappBold($song->name),
                    'reasons' => $this->formatForWhatsApp($reviews)
                ],
            );

            return;
        }


        $message = (new UserSongRejectedEmail($song, $reviews[1], $reviews[0]))
                ->onQueue('songs');

        Mail::to($song->user->email)
            ->bcc('vusile@gmail.com')
            ->queue($message);
    }

    public function getReviews($song): array
    {
        $approvalQuestionScores = DB::table('reviews')
            ->select(DB::raw('count(*) as answers_count, review_question_id, question'))
            ->join('review_questions', 'review_questions.id', '=', 'reviews.review_question_id')
            ->groupBy('review_question_id')
            ->where('song_id', $song->id)
            ->where('review_answer_id', 2)
            ->get();

        $comments = [];

        foreach($approvalQuestionScores as $ap) {

            if((config('song.reviews.no_of_reviews_per_song') - $ap->answers_count) < 2) {
                $reviewsWithComments = DB::table('reviews')
                    ->select(DB::raw('review_question_id, comment'))
                    ->whereNotNull('comment')
                    ->where('song_id', $song->id)
                    ->where('review_question_id', $ap->review_question_id)
                    ->get();

                $counter = 1;
                foreach($reviewsWithComments as $reviewWithComment) {
                    $comment = '<strong>Pendekezo la ' . $counter . '.</strong> ' .$reviewWithComment->comment . "<br>";
                    if($counter == 1) {
                        $comments[$reviewWithComment->review_question_id] = $comment;
                    } else {
                        $comments[$reviewWithComment->review_question_id] .= $comment;
                    }
                    $counter+=1;
                }
            }
        }

        return [
            $approvalQuestionScores,
            $comments
        ];
    }

    private function formatForWhatsApp(array $reviews)
    {
        $approvalQuestions = $reviews[0];
        $comments = $reviews[1];
        $whatsappReviews = '';
        foreach($approvalQuestions as $approvalQuestion){
            if(config('song.reviews.no_of_reviews_per_song') - $approvalQuestion->answers_count < 2) {

                    $whatsappReviews .= $approvalQuestion->question . ':\n';
                    $whatsappReviews .= whatsappBold('Umepata ' . (config('song.reviews.no_of_reviews_per_song') - $approvalQuestion->answers_count) . "/" . config('song.reviews.no_of_reviews_per_song'));


                if(isset($comments[$approvalQuestion->review_question_id])) {
                    $whatsappReviews .= '\n\n' . whatsappBold('Mapendekezo') . '\n';
                    $whatsappReviews .= $comments[$approvalQuestion->review_question_id];
                }
            }
        }

        $whatsappReviews = str_replace("<strong>", "*", $whatsappReviews);
        $whatsappReviews = str_replace("</strong>", "*", $whatsappReviews);
        return str_replace("<br>", '\n', $whatsappReviews);
    }
}
