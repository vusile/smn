<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class Dominika extends Model
{
    protected $table = 'dominika';
    protected $dates = ['dominika_date'];
    
    public function songs()
    {
        return $this->belongsToMany('App\Song', 'dominikas_songs');
    }
    
    public function scopeThisWeek($query)
    {
        $now = Carbon::now()->format('Y-m-d');
        $sunday = Carbon::now()
                ->modify("next Sunday")
                ->format('Y-m-d');
        
        return $query->whereBetween(
            'dominika_date',
            [
                $now,
                $sunday
            ]
        );
    }
}
