<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Propaganistas\LaravelPhone\PhoneNumber;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        login as protected tlogin;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/akaunti';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $password = request()->input('password');
        $user = User::where('email', request()->input('username'))
                ->first();

        if($user) {
            $salt = substr($user->password, 0, 10);

            if($salt . substr(sha1($salt . $password), 0, -10) == $user->password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        }

        return $this->tlogin($request);
    }

    public function username()
    {
        $login = request()->input('username');

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } else {
            $field = 'phone';
            $login = PhoneNumber::make($login, request()->input('phone_country'))->formatE164();
        }

        request()->merge([$field => $login]);

        return $field;
    }
}
