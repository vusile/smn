<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Dominika extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'dominikas';
    // protected $primaryKey = 'id';
     public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['title', 'year_id', 'dominika_date'];
    // protected $hidden = [];
    protected $dates = ['dominika_date'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function songs()
    {
        return $this->belongsToMany('App\Models\Song', 'dominikas_songs');
    }

    public function year()
    {
        return $this->belongsTo('App\Models\Year');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeThisWeek($query)
    {
        $now = Carbon::now()->format('Y-m-d');
        $sunday = Carbon::now()
                ->addDays(14)
                ->format('Y-m-d');

        return $query->whereBetween(
            'dominika_date',
            [
                $now,
                $sunday
            ]
        );
    }
    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
