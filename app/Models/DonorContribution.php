<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonorContribution extends Model
{
    protected $fillable = ['reference_number', 'amount', 'divide_monthly', 'contribution_date', 'donor_id'];

    public function donor()
    {
        return $this->belongsTo('App\Models\Donor');
    }
}
