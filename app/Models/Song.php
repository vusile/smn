<?php

namespace App\Models;

use App\Models\SongDownload;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use Sluggable;
    
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'composer_id',
        'pdf',
        'midi',
        'lyrics',
        'user_id',
        'status',
        'url',
        'software_id',
        'software_file',
        'nota_original',
        'approved_date',
        'approved_by',
        'downloads',
        'views',
        'uploaded_date',
    ];
    
    public function sluggable()
    {
        return [
            'url' => [
                'source' => 'name'
            ]
        ];
    }
    
    public function composer()
    {
        return $this->belongsTo('App\Models\Composer');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'song_categories');
    }
    
    public function dominikas()
    {
        return $this->belongsToMany('App\Models\Dominika', 'dominikas_songs');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    
    public function songDownloads()
    {
        return $this->hasMany('App\Models\SongDownload');
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
    
    public function getIsActiveAttribute()
    {
        if (in_array($this->status, [1, 2])) {
            return true;
        }
        
        return false;
    }
    
    public function scopeApproved($query)
    {
        return $query->whereIn('status', [1, 2]);
    }
    
    public function scopePending($query)
    {
        return $query->whereNotIn('status', [1, 2]);
    }
    
    public function scopeOwnedBy($query, $user)
    {
        return $query->where('user_id', $user->id);
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
