<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\DonorContribution;
use App\Services\SmsService;
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

        $monthlyTotals = $this->generateMonthlyTotals($date);
        $totals = $this->generateTotalsToDate($date);

        $monthlyTotal = collect($monthlyTotals)->sum();
        $donors = Donor::orderBy('name')->get();

        $minus = request('minus') ? request('minus') + 1 : 1;
        $plus = request('plus') ? request('plus') + 1 : 1;

        return view(
            'donors.mkeka',
            compact('date', 'totals', 'donors', 'minus', 'plus', 'monthlyTotals', 'monthlyTotal')
        );
    }

    public function tumaMkeka()
    {
        $date = Carbon::parse(request('date'));

        $monthlyTotals = $this->generateMonthlyTotals($date);
        $totals = $this->generateTotalsToDate($date);
        $monthlyTotal = collect($monthlyTotals)->sum();
        $donors = Donor::orderBy('name')->get();

        $message = whatsappBold(
            sprintf("Jumla ya michango mwezi wa %s %s: %s", $date->monthName, $date->year, number_format($monthlyTotal))
        );

        $message .= "\n\n";

        $index = 1;

        foreach ($donors as $donor) {
            $message .= $index . " " . $donor->name . " - ";
            $message .= isset($monthlyTotals[$donor->id]) ? number_format($monthlyTotals[$donor->id]) : 0;
            $message .= " (";
            $message .= isset($totals[$donor->id]) ? number_format($totals[$donor->id]) : 0 ;
            $message .= ") \n";
            $index += 1;
        }

        $smsService = new SmsService();

        dd(
            $smsService->sendSms(
                auth()->user(),
                'song_not_approved',
                ['name' => $date->monthName . " - " . $date->year],
                ['reasons' => $message],
            )
        );

        if (
            $smsService->sendSms(
                auth()->user(),
                'song_not_approved',
                ['name' => $date->monthName . " - " . $date->year],
                ['reasons' => $message],
            )
        ) {
            return;
        }
    }

    private function generateMonthlyTotals($date): array
    {
        $monthlyTotals = [];

        $contributions = DonorContribution::whereMonth('contribution_date' , $date->month)
            ->whereYear('contribution_date' , $date->year)
            ->get(['donor_id', 'amount']);

        foreach ($contributions as $contribution) {
            if(isset($monthlyTotals[$contribution->donor_id])) {
                $monthlyTotals[$contribution->donor_id] = $monthlyTotals[$contribution->donor_id] + $contribution->amount;
            } else {
                $monthlyTotals[$contribution->donor_id] = $contribution->amount;
            }
        }

        return $monthlyTotals;
    }

    private function generateTotalsToDate(Carbon $date): array
    {
        $totals = [];
        $allContributions = DonorContribution::whereDate('contribution_date', '<=', $date->endOfMonth())
            ->get(['donor_id', 'amount']);

        foreach ($allContributions as $contribution) {
            if(isset($totals[$contribution->donor_id])) {
                $totals[$contribution->donor_id] = $totals[$contribution->donor_id] + $contribution->amount;
            } else {
                $totals[$contribution->donor_id] = $contribution->amount;
            }
        }

        return $totals;
    }
}
