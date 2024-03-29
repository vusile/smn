<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords {
        reset as protected treset;
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(Request $request)
    {
        Session::flash('msg', 'Umefanikiwa kubadili password na tumeshakulogin. Karibu tena SMN');

        return $this->treset($request);
    }

    public function resetWithCode(Request $request, User $user)
    {
        Session::flash('msg', 'Umefanikiwa kubadili password na tumeshakulogin. Karibu tena SMN');

        if(($user->verification_code == $request->code) || ($user->verification_code == base64_decode($request->session_var))) {
            $this->resetPassword($user, $request->password);
            return $this->sendResetResponse($request, null);
        } else {
            return $this->sendResetFailedResponse($request, null);
        }
    }
}
