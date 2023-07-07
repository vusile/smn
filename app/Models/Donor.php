<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = ['name', 'phone', 'total_contribution'];

    public function contributions()
    {
        return $this->hasMany('App\Models\DonorContribution');
    }
}
