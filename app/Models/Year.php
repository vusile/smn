<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    public $timestamps = false;
    
    public function dominikas()
    {
        return $this->hasMany('App\Models\Dominika');
    }
}
