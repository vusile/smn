<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use setasign\Fpdi\Fpdi;


class IthibatiController extends Controller
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

        $assignedToUsers = DB::table('ithibati_songs')
            ->where('user_id', $user->id)
            ->get()
            ->pluck('song_id')
            ->toArray();

        $song = Song::waitingForIthibati()
            ->has('categories')
            ->whereNotIn('user_id', [$user->id])
            ->whereIn('id', $assignedToUsers)
            ->first();

        if(!$song) {
            $song = Song::waitingForIthibati()
                ->orderBy('priority_review', 'desc')
                ->has('categories')
                ->whereNotIn('user_id', [$user->id])
                ->first();

            if($song) {
                DB::table('ithibati_songs')
                    ->insert(
                        [
                            'song_id' => $song->id,
                            'user_id' => $user->id
                        ]

                    );
            }
        }

        return view(
            'songs.ithibati.index',
            compact(
                'song'
            )
        );
    }

    public function store(Request $request)
    {
        $validationRules = [
            'fit_for_liturgy' => 'required',
            'give_ithibati' => 'required'
        ];

        $validationMessages = [
            'fit_for_liturgy.required' => 'Tafadhali chagua kama wimbo unafaa kuimbwa kwenye ibada ya misa au la',
            'give_ithibati.required' => 'Tafadhali changua kama wimbo unapaswa kupata ithibati au la.',
        ];

        if($request->get('give_ithibati') == 2){
            $validationMessages = array_merge(
                $validationMessages,
                ['comment.required' => 'Tafadhali weka maoni ili aliyepakia aelewe kwa nini wimbo haujapata ithibati.']
            );

            $validationRules = array_merge(
                $validationRules,
                ['comment' => 'required']
            );
        }

        $this->validate(
            $request,
            $validationRules,
            $validationMessages
        );

        $song = Song::find($request->input('song_id'));

        if($request->get('fit_for_liturgy')) {
            $song->fit_for_liturgy = true;
        } else {
            $song->fit_for_liturgy = false;
        }

        if($request->get('give_ithibati') == 1) {
            if($song->for_recording) {
                $song->status = 7;
            } else {
                $song->status = 8;
            }

            $song->ithibati_number = sprintf(config('song.ithibati.format'), strtoupper(substr(str_shuffle(MD5(microtime())), 0, 5)), $song->id, date("y"));


            $song->approved_date = Carbon::now()->toDateString();

            $path = storage_path('app/public/' . config('song.files.paths.pdf') . $song->pdf);
            $savePath = storage_path('app/public/' . config('song.files.paths.pdf') . 'ithibati-' . $song->pdf);

            $pdf = new Fpdi();

            $pageCount = $pdf->setSourceFile(
                $path
            );

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                // import a page
                $templateId = $pdf->importPage($pageNo);

                $pdf->AddPage();
                // use the imported page and adjust the page size
                $pdf->useTemplate($templateId, ['adjustPageSize' => false]);

                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(10, 5);
                $pdf->Write(8, 'Namba ya Ithibati: ' . $song->ithibati_number);
            }
            $pdf->Output($savePath, 'F');
        } else {
            $song->status = 9;

            if($request->get('comment')) {
                DB::table('ithibati_songs')
                    ->where('song_id', $song->id)
                    ->update(['comment' => $request->get('comment')]);
            }
        }

        $song->save();

        return view(
            'songs.ithibati.preview',
            compact(
                'song'
            )
        );
    }

    public function review()
    {
        $song = Song::find(request()->get('song_id'));
        $songReviews = DB::table('reviews')
            ->join('review_questions', 'reviews.review_question_id', '=', 'review_questions.id')
            ->join('review_answers', 'reviews.review_answer_id', '=', 'review_answers.id')
            ->where('song_id', $song->id)
            ->where('user_id', auth()->user()->id)
            ->get();

        return view(
            'songs.review.preview',
            compact(
                'song',
                'songReviews'
            )
        );
    }

    public function changeMtoaIthibati(Song $song) {
        $users = User::role('ithibati')
            ->orderBy('first_name')
            ->get()
            ->mapWithKeys(function ($user) {
                return [
                    $user->id => $user->name,
                ];
            })
            ->toArray();


        $currentIthibati = DB::table('ithibati_songs')
            ->where('song_id', $song->id)
            ->first();

        $mtoaIthibati = null;

        if($currentIthibati) {
            $mtoaIthibati = User::find($currentIthibati->user_id);
        }

        return view(
            'songs.ithibati.change-mtoa-ithibati',
            compact(
                'song',
                'users',
                'mtoaIthibati'
            )
        );
    }

    public function saveMtoaIthibati() {

        DB::table('ithibati_songs')
            ->where('song_id', request()->get('song_id'))
            ->delete();

        DB::table('ithibati_songs')
            ->insert([
                'song_id' => request()->get('song_id'),
                'user_id' => request()->get('user_id'),
            ]);

        return redirect('akaunti/nyimbo/pending')
            ->with('msg', 'Umefanikiwa kubadili mtoa Ithibati');

    }
}
