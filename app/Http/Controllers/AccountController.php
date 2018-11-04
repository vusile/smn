<?php

namespace App\Http\Controllers;

use App\Models\User;

class AccountController extends Controller
{
    public function index()
    {
        return view(
            'account.index',
            compact('composers')
        );
    }
    
    public function impersonate(User $user)
    {
        auth()->user()->impersonate($user);
    }
    
    public function stopImpersonating()
    {
        auth()->user()->leaveImpersonation();
    }
}