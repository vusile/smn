<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\DonorContribution;
use Illuminate\Support\Carbon;

class DonorsController extends Controller
{
    public function upload()
    {
        return view(
            'donors.upload',
        );
    }

    public function mkeka()
    {
        $date = Carbon::now();

        if(request('minus')) {
            $date->subMonths(request('minus'));
        }

        if(request('plus')) {
            $date->addMonths(request('plus'));
        }

        $contributions = DonorContribution::whereMonth('contribution_date' , $date->month)
            ->whereYear('contribution_date' , $date->year)
            ->get();

        $allContributions = DonorContribution::all(['donor_id', 'amount']);

        $monthlyTotals = [];
        $totals = [];
        $monthlyTotal = 0;

        foreach ($contributions as $contribution) {
            if(isset($monthlyTotals[$contribution->donor_id])) {
                $monthlyTotals[$contribution->donor_id] = $monthlyTotals[$contribution->donor_id] + $contribution->amount;
            } else {
                $monthlyTotals[$contribution->donor_id] = $contribution->amount;
            }

            $monthlyTotal += $contribution->amount;
        }

        foreach ($allContributions as $contribution) {
            if(isset($totals[$contribution->donor_id])) {
                $totals[$contribution->donor_id] = $totals[$contribution->donor_id] + $contribution->amount;
            } else {
                $totals[$contribution->donor_id] = $contribution->amount;
            }
        }

        $donors = Donor::orderBy('name')->get();

        $minus = request('minus') ? request('minus') + 1 : 1;
        $plus = request('plus') ? request('plus') + 1 : 1;

        return view(
            'donors.mkeka',
            compact('contributions', 'date', 'totals', 'donors', 'minus', 'plus', 'monthlyTotals', 'monthlyTotal')
        );
    }
}
