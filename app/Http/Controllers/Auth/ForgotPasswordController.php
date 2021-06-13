<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendEmailResetInstructions(Request $request) {
        $user = User::where('email', $request->email)
            ->get()
            ->first();

        if($user->phone_verified) {
            $code = rand(0001, 9999);
            $user->verification_code = $code;
            $user->forgotten_password_code = $code;
            $user->forgotten_password_time = time();
            $user->save();

            $smsService = new SmsService();
            $smsService->sendActivationCode($user, $code);

            return redirect('/password-reset-code/' . $user->id)->with('message', 'Tumekutumia Ujumbe mfupi wenye namba itakayosaidia kubadili password yako.');
        } else {
            return $this->sendResetLinkEmail($request);
        }
    }

    public function passwordResetCode(User $user) {
        return view('auth.passwords.reset-code',
                compact('user'));
    }
}
