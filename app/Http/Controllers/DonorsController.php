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

        $message = $this->generateWhatsappMessage($monthlyTotals, $totals, $monthlyTotal, $donors, $date);

        return view(
            'donors.mkeka',
            compact('date', 'totals', 'donors', 'minus', 'plus', 'monthlyTotals', 'monthlyTotal', 'message')
        );
    }

    public function generateWhatsappMessage($monthlyTotals, $totals, $monthlyTotal, $donors, $date)
    {

        $message = whatsappBold(
            sprintf('TUMSIFU YESU KRISTO*.<br><br>*Jumla ya michango mwezi wa %s %s: %s', $date->monthName, $date->year, number_format($monthlyTotal))
        );

        $message .= '<br><br>_Maelezo: Namba iliyo baada ya jina lako, ni mchango wa mwezi huu. Namba iliyo kwenye mabano ni jumla ya michango yako tangia zoezi lianze_';
        $message .= '<br><br>';
        $message .= '_Mfano: Francis John - 2,000 (10,000). 2,000 ni mchango wa mwezi huu. 10,000 ni jumla uliyochanga (ikijumuisha hiyo 2,000) tangu tuanze kuchangia._';
        $message .= '<br><br>Sponsors waliochangia mwezi wa ' . $date->monthName . ' ' . $date->year . ' kupitia M-Koba (SMN SPONSORS) na CHANGISHA NUMBER 8182296 (VUSILE SILONDA SMN SPONSORS) Ni:';
        $message .= '<br><br>*_Kama kuna kasoro yoyote tafadhali tufahamishe_*';

        $index = 1;

        foreach ($donors as $donor) {
            $message .= $index . ". " . $donor->name . " - ";
            $message .= isset($monthlyTotals[$donor->id]) ? number_format($monthlyTotals[$donor->id]) : 0;
            $message .= " (";
            $message .= isset($totals[$donor->id]) ? number_format($totals[$donor->id]) : 0 ;
            $message .= ')<br>';
            $index += 1;
        }

        $message .= "<br>" . whatsappBold("Asanteni sana, Mungu awabariki");

        return $message;
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
