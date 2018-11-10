<?php

namespace App\Services;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createUser(ProviderUser $providerUser, $provider)
    {
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            Auth::login($account->user);

            redirect('/');
        } else {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $provider
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $names = explode(' ', $providerUser->getName());
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'first_name' => head($names),
                    'last_name' => last($names),
                    'password' => md5(rand(1, 10000)),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }

    public function getUser(ProviderUser $providerUser, $provider)
    {
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            Auth::login($account->user);

            return $account->user;
        }

        return false;
    }
}