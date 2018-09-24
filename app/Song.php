<?php

namespace App;

use App\SongDownload;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public $timestamps = false;
    
    public function composer()
    {
        return $this->belongsTo('App\Composer');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'song_categories');
    }
    
    public function dominikas()
    {
        return $this->belongsToMany('App\Dominika', 'dominikas_songs');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function songDownloads()
    {
        return $this->hasMany('App\SongDownload');
    }
    
    public function getActualDownloadsAttribute()
    {
        return number_format( 
            $this->songDownloads->sum(function ($songDownload) {
                return $songDownload->downloads;
            })
        );
    }
    
    public function getDescriptionAttribute()
    {
        return $this->lyrics ?? 'Wimbo huu wa ' . $this->name . ' umetungwa na ' . $this->composer->name;
    }
    
    public function songViews()
    {
        return $this->hasMany('App\SongView');
    }
    
    public function getActualViewsAttribute()
    {
        return number_format(
            $this->songViews->sum(function ($songView) {
                return $songView->views;
            })
        );
    }
    
    public function scopeApproved($query)
    {
        return $query->whereIn('status', [1, 2]);
    }
    
    public function scopeTopTen($query)
    {
        $topTen = SongDownload::selectRaw('sum(downloads) as downloads, song_id')
                ->groupBy('song_id')
                ->orderBy('downloads', 'desc')
                ->limit(10)
                ->get()
                ->pluck('song_id');
        
        return $query->whereIn('id', $topTen);
    }
    
    public function scopeWeeklyTopTen($query)
    {
        $now = Carbon::now();
        
        $topTen = SongDownload::selectRaw('sum(downloads) as downloads, song_id')
                ->whereBetween('downloaded_on', [
                    $now->startOfWeek()->format('Y-m-d'),
                    $now->endOfWeek()->format('Y-m-d')
                ])
                ->groupBy('song_id')
                ->orderBy('downloads', 'desc')
                ->limit(10)
                ->get()
                ->pluck('song_id');
        
        return $query->whereIn('id', $topTen);
    }
}
