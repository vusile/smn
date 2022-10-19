<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlySongStat extends Model
{
    public $timestamps = false;

    protected $fillable = ['month', 'year', 'song_id', 'downloads', 'views'];
}
