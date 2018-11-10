<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Services\SocialAccountService;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    /**
     * Redirect the user to the Social authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Social.
     *
     * @return \Illuminate\Http\Response|RedirectResponse;
     */
    public function handleProviderCallback($provider, SocialAccountService $socialAccountService)
    {
        $socialUser = Socialite::driver($provider)->user();

        if ($socialAccountService->getUser($socialUser, $provider)) {
            Session::flash('msg', 'Umefanikiwa ku-login. Karibu SwahiliMusicNotes');
            return redirect('/');
        } else {
            $user = $socialAccountService->createUser($socialUser, $provider);
            Session::flash('msg', 'Umefanikiwa kujisajili na tumeshaku-login. Karibu SwahiliMusicNotes');

            return view('auth.social_register', compact('experiences', 'user'));
        }
    }
}