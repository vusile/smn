<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SongDownload extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['downloaded_on', 'downloads', 'song_id'];
}
