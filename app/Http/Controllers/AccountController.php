<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
            ->select(DB::raw('count(*) as reviewed'))
            ->where('user_id', auth()->user()->id)
            ->where('review_question_id', 1)
            ->groupBy('user_id')
            ->get();
        
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
        
        $status = 'Nyimbo zilizo Live na zenye Ithibati';
        
        return view(
            'account.songs',
            compact('songs', 'status', 'count')
        );
    }
    
    protected function getLiveSongs()
    {
        return Song::where(function (Builder $query) {
                $query->approved()->orWhere->forRecording();
            })
            ->when(!auth()->user()->hasAnyRole(['super admin', 'admin']), function ($query) {
                return $query->ownedBy(auth()->user());
            })
            ->orderBy('id', 'desc');
    }
    
    protected function getPendingSongs()
    {
        return Song::pending()            
            ->when(!auth()->user()->hasAnyRole(['super admin', 'admin']), function ($query) {
                return $query->ownedBy(auth()->user());
            })
            ->orderBy('id', 'desc');
    }
}