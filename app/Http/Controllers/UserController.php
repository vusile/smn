<?php

namespace App\Http\Controllers;

use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $title = "Wanaopakia Nyimbo Swahili Music Notes";
        $description = "Wafahamu wadau mbalimbali wanaopakia nyimbo";
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        
        $users = User::where('active_songs', '>', 0)
            ->orderBy('first_name')
            ->get();  
        
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
    
    public function getPhoneNumber()
    {
        return view(
            'auth.get-phone'
        );
    }
    
    public function savePhoneNumber(Request $request)
    {
        Session::flash('msg', 'Umefanikiwa Kuweka namba yako. Endelea kupakia wimbo');
        User::where('id', auth()->user()->id)
            ->update(
                [
                    'phone' => $request->phone
                ]
            );
        
        return redirect(route('song-upload.index'));
    }
}
