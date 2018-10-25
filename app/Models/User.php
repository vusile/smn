<?php

namespace App\Models;

use App\Models\Song;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable
{
    use Notifiable, Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function songs()
    {
        return $this->hasMany('App\Models\Song');
    }
    
    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }
    
    public function getHasSongsAttribute()
    {
        return $this->songs->count();
    }
    
    public function getHasActiveSongsAttribute()
    {
        return $this->activeSongs()->count();
    }

    public function scopeActiveSongs()
    {
        return $this->songs
                ->filter(function ($song) {
                    return $song->is_active;
                });
    }
}
