<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Composer extends Model
{    
    public function songs()
    {
        return $this->hasMany('App\Song');
    }
    
    public function getHasProfileAttribute()
    {
        return $this->details || $this->has_photo || $this->phone;
    }
    
    public function getHasPhotoAttribute()
    {
        return $this->photo2 || $this->photo || $this->photo3;
    }
    
    public function getHasSongsAttribute()
    {
        return $this->songs->count();
    }    
}
