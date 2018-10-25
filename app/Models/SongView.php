<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SongView extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['viewed_on', 'views', 'song_id'];
}
