<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SongReviewController extends Controller
{
    public function index()
    {
        $questions = DB::table('review_questions')
            ->where('review_level', auth()->user()->review_level)
            ->get();
        
        $answers = DB::table('review_answers')
                ->get();
         
        $nameQuestions = $questions->filter(function($question) {
            return $question->field == 'name';
        });
        
        $pdfQuestions = $questions->filter(function($question) {
            return $question->field == 'pdf';
        });
        
        $midiQuestions = $questions->filter(function($question) {
            return $question->field == 'midi';
        });
        
        $composerQuestions = $questions->filter(function($question) {
            return $question->field == 'composer_id';
        });
        
        $categoriesQuestions = $questions->filter(function($question) {
            return $question->field == 'categories';
        });
        
        $songsUserHasReviewed = DB::table('reviews')
            ->where('user_id', auth()->user()->id)
            ->pluck('song_id')
            ->all();
        

        $mandatoryQuestions = $questions->filter(function ($question){
            return $question->mandatory;
        })->count();
                
        $songsAlredyInReviewProcess = DB::table('reviews')
            ->whereNotIn('song_id', $songsUserHasReviewed)
            ->groupBy('song_id', 'user_id')
            ->select(DB::raw('count(*) as answered, song_id, user_id'))
            ->get()
            ->filter(function ($review) use ($mandatoryQuestions) {
                return $review->answered < ($mandatoryQuestions * config('song.reviews.no_of_reviews_per_song'));
            })
            ->pluck('song_id')
            ->toArray();
            
        $song = Song::pending()
            ->whereNotIn('id', $songsUserHasReviewed)
            ->whereNotIn('user_id', [auth()->user()->id])
            ->when($songsAlredyInReviewProcess, function($query, $songsAlredyInReviewProcess) {
                return $query->whereIn(
                    'id',
                    $songsAlredyInReviewProcess
                );
            })
            ->inRandomOrder()
            ->first();
        
        return view(
            'songs.review.index',
            compact(
                'song',
                'nameQuestions',
                'pdfQuestions',
                'composerQuestions',
                'midiQuestions',
                'categoriesQuestions',
                'answers'
            )
        );
    }
    
    public function store(Request $request)
    {
        $song = Song::find($request->input('song_id'));
        $questions = DB::table('review_questions')
            ->get();
        
        $customMessages = [];
        
        foreach($questions as $question) {
            if(!$song->midi && $question->field == 'midi') {
                continue;
            }
            $customMessages['answer' . $question->id . '.required'] = 'Tafadhali jibu maswali yote';
        }
        
        foreach($questions as $question) {
            if(!$song->midi && $question->field == 'midi') {
                continue;
            }

            $validations['answer' . $question->id] = 'required';
        }
  
        $this->validate(
            $request,
            $validations,
            $customMessages
        );
        
        $reviews = [];
        
        
        $iDontKnows = 0;
        foreach ($questions as $question) {
            if (($question->field == 'midi') && !$song->midi) {
                continue;
            }
            
            if(
                $question->critical
                && $request->input('answer' . $question->id) == 3
            ) {
                $iDontKnows += 1; 
            }
            
            $reviews[] = [
                'user_id' => auth()->user()->id,
                'song_id' => $song->id,
                'review_question_id' =>  $question->id,
                'review_answer_id' => $request->input('answer' . $question->id),
                'suggestion' => $request->input('suggestion' . $question->id),
                'comment' => $request->input('comment' . $question->id),
                'created_at' => Carbon::now()->toDateString(),
                'updated_at' => Carbon::now()->toDateString(),
            ];
        }
        
        if(!$iDontKnows) {            
            DB::table('reviews')
                ->insert($reviews);
        }
        
        $reviewedSongs = session('songs_reviewed', 0);
        session(['songs_reviewed' => $reviewedSongs + 1]);
        
        return redirect()->route('song-review.index');
    }
}