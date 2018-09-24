<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComposerEmail extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['sender_name', 'sender_phone', 'sender_email', 'composer_id', 'message'];
    
    public function composer()
    {
        return $this->belongsTo('App\Composer');
    }
}
