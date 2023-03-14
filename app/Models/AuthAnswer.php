<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthAnswer extends Model
{
    protected $fillable = ['user_id', 'question_id', 'answer'];

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
