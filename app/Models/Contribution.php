<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $fillable = ['reference_number', 'amount', 'divide_monthly', 'contribution_date', 'donor_id'];
}
