<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuthAnswer;
use App\Models\AuthQuestion;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PasswordResetQuestionsController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return Application|RedirectResponse|Redirector|View
     */

    public function show()
    {
        if(!auth()->user()->authAnswers()->count()) {
            $authQuestions = AuthQuestion::all();
            return view('auth.questions',
                compact('authQuestions'));
        } else {
            return redirect('/');
        }
    }

    public function save(Request $request) {
        $authQuestions = AuthQuestion::all();
        $this->validation($request, $authQuestions);

        foreach($authQuestions as $authQuestion) {
            AuthAnswer::create([
                'user_id' => auth()->user()->id,
                'question_id' => $authQuestion->id,
                'answer' => Hash::make(
                    cleanUpAnswer($request->get('answer' . $authQuestion->id))
                )
            ]);
        }

        Session::flash('msg', 'Majibu yako yamehifadhiwa. Tutatumia maswali haya kama umesahau password yako. Sasa unaweza kuingia kwenye akaunti yako');
        return redirect('/');
    }

    private function validation($request, $authQuestions)
    {
        $validationRules = [];
        $validationMessages = [];

        foreach($authQuestions as $authQuestion) {
            $validationRules['answer' . $authQuestion->id] = 'required';
            $validationMessages['answer' . $authQuestion->id . '.required'] = 'Lazima kujibu swali namba ' . $authQuestion->id;
        }

        $this->validate(
            $request,
            $validationRules,
            $validationMessages
        );
    }

    public function getQuestionsToVerify(User $user) {
        $authQuestions = AuthQuestion::inRandomOrder()->limit(2)->get();
        return view('auth.verify-answers',
            compact('authQuestions', 'user'));
    }

    public function verifyAnswers(Request $request) {
        $questionIdsArray = explode(',', $request->get('questions'));
        $authQuestions = AuthQuestion::whereIn('id', $questionIdsArray);
        $userId = base64_decode($request->get('mod_id'));

        $this->validation($request, $authQuestions);
        $authAnswers = AuthAnswer::where('user_id', $userId)
            ->whereIn('question_id', $questionIdsArray)
            ->get();
        $user = User::find($userId);

        $allClear = false;

        foreach($authAnswers as $authAnswer) {
            if(Hash::check(cleanUpAnswer($request->get('answer' . $authAnswer->question_id)), $authAnswer->answer)) {
                $allClear = true;
            } else {
                $allClear = false;
            }
        }

        if($allClear) {
            $code = rand(0001, 9999);
            $user->verification_code = $code;
            $user->forgotten_password_code = $code;
            $user->forgotten_password_time = time();
            $user->save();

            return redirect('/password-reset-code/' . $user->id . '/0')->with('message', 'Majibu yako ni sahihi. Badili password yako');
        } else {
            return redirect()->back()->with('error', 'Majibu yako hayafanani na uliyoweka awali. Tafadhali jaribu tena');
        }
    }
}
