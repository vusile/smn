<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        $activeSongs = $this->getLiveSongs()->count();
        $pendingSongs = $this->getPendingSongs()->count();
        $views = $this->getLiveSongs()->sum('views');
        $downloads = $this->getLiveSongs()->sum('downloads');
        $songsReviewed = DB::table('reviews')
            ->where('user_id', auth()->user()->id)
            ->groupBy('song_id')
            ->count();
        
        return view(
            'account.index',
            compact(
                'composers',
                'activeSongs',
                'pendingSongs',
                'views',
                'downloads',
                'songsReviewed'
            )
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
    
    public function pending()
    {
        $songs = $this->getPendingSongs()
            ->paginate(20);
        
        $status = 'Nyimbo zinazosubiri Review';
        $count = $songs->total();
        
        return view(
            'account.songs',
            compact('songs', 'status', 'count')
        );
    }
    
    public function live()
    {
        $songs = $this->getLiveSongs()
            ->paginate(20);
        
        $status = 'Nyimbo zilizo Live';
        
        return view(
            'account.songs',
            compact('songs', 'status', 'count')
        );
    }
    
    protected function getLiveSongs()
    {
        return Song::approved()
            ->ownedBy(auth()->user())
            ->orderBy('id', 'desc');
    }
    
    protected function getPendingSongs()
    {
        return Song::pending()
            ->ownedBy(auth()->user())
            ->orderBy('id', 'desc');
    }
}