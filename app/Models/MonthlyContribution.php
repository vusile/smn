<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyContribution extends Model
{
    protected $fillable = ['donor_contribution_id', 'amount', 'month_year_id'];
}
