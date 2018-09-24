<?php

namespace App\Http\Controllers;

use App\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $title = "Wanaopakia Nyimbo Swahili Music Notes";
        $description = "Wafahamu wadau mbalimbali wanaopakia nyimbo";
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        
        $users = User::all()
            ->sortBy('first_name')
            ->filter(
                function ($user) {
                    return $user->has_songs && $user->name;
                }
            );  
        
        return view(
            'users.index',
            compact('users', 'title', 'description')
        );
    }
    
    public function songs(string $url, User $user)
    {
        SEOMeta::setTitle("Nyimbo zilizopakiwa na " . $user->name);
        SEOMeta::setDescription("Mkusanyiko wa nyimbo zilizopakiwa na " . $user->name);
        
        return view(
            'users.songs',
            compact('user')
        );
    }
}
