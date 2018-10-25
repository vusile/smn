<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Hash;

class CheckPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $password = $request->input('password');
        $user = User::where('email', $request->input('email'))->first();

        if (password_needs_rehash($user->getAuthPassword(), PASSWORD_BCRYPT))
        {
              // User old password matches - so now lets re-hash the password as bcrypt
            $user->password = Hash::make($password);
            $user->save();
        }
        return $next($request);
    }
}
