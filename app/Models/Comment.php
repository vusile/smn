<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'song_comments';
    public $timestamps = false;

    protected $fillable = ['name', 'phone', 'email', 'comment', 'song_id', 'comment_date'];

    public function song()
    {
        return $this->belongsTo('App\Models\Song');
    }
}
