<?php

namespace App;

use App\Song;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        return $this->hasMany('App\Song');
    }
    
    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }
    
    public function getHasSongsAttribute()
    {
        return $this->songs->count();
    }    
}
