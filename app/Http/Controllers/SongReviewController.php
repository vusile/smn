<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SongReviewController extends Controller
{
    /*
     * @var SongService
     */
    protected $songService;

    public function __construct(SongService $songService)
    {
        $this->songService = $songService;
    }

    public function index()
    {
        $user = auth()->user();

        $questions = DB::table('review_questions')
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

        $dominikaQuestions = $questions->filter(function($question) {
            return $question->field == 'dominika';
        });

        $assignedToUsers = DB::table('reviewer_songs')
                ->where('user_id', $user->id)
                ->get()
                ->pluck('song_id')
                ->toArray();


        $song = Song::pending()
            ->has('categories')
            ->whereNotIn('user_id', [$user->id])
            ->whereIn('id', $assignedToUsers)
            ->first();

        if(!$song) {
            $song = Song::pending()
                ->has('categories')
                ->whereNotIn('user_id', [$user->id])
                ->first();


            DB::table('reviewer_songs')
                    ->insert(
                        [
                            'song_id' => $song->id,
                            'user_id' => $user->id
                        ]

                    );
        }

        $parts = null;

        if($song->dominikas) {
            $parts = $this->songService->determinePartOfMass($song);
        }

        return view(
            'songs.review.index',
            compact(
                'song',
                'nameQuestions',
                'pdfQuestions',
                'composerQuestions',
                'midiQuestions',
                'categoriesQuestions',
                'dominikaQuestions',
                'answers',
                'parts'
            )
        );
    }

    public function store(Request $request)
    {
        $song = Song::find($request->input('song_id'));
        $questions = DB::table('review_questions')
            ->where('review_level', auth()->user()->review_level)
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

        foreach ($questions as $question) {
            if (($question->field == 'midi') && !$song->midi) {
                continue;
            }

            $reviews[] = [
                'user_id' => auth()->user()->id,
                'song_id' => $song->id,
                'review_question_id' =>  $question->id,
                'review_answer_id' => (int) $request->input('answer' . $question->id),
                'suggestion' => $request->input('suggestion' . $question->id),
                'comment' => $request->input('comment' . $question->id),
                'created_at' => Carbon::now()->toDateString(),
                'updated_at' => Carbon::now()->toDateString(),
            ];
        }

        DB::table('reviews')
            ->insert($reviews);


        $songReviews = DB::table('reviews')
            ->join('review_questions', 'reviews.review_question_id', '=', 'review_questions.id')
            ->join('review_answers', 'reviews.review_answer_id', '=', 'review_answers.id')
            ->where('song_id', $song->id)
            ->get();

        return view(
            'songs.review.preview',
            compact(
                'song',
                'songReviews'
            )
        );
    }
}
