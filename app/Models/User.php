<?php

namespace App\Models;

use App\Notifications\MailResetPasswordNotification;
use App\Traits\SongTrait;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements CanResetPassword
{
    use Notifiable, Impersonate, SongTrait, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'has_whatsapp', 'first_name', 'last_name', 'phone_verified'
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
    
    /**
 * Send a password reset email to the user
 */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token));
    }
}
