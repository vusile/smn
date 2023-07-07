<?php

namespace App\Console\Commands;

use App\Models\Composer;
use App\Models\Donor;
use App\Models\DonorContribution;
use App\Models\MonthlyContribution;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateTotalContributions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'donor-contributions:update-total';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates total contributions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $contributions = DonorContribution::where('processed', false)->get(['id, donor_id, amount']);
        $totals = [];
        $contributionIds = [];

        foreach ($contributions as $contribution) {
            $contributionIds[] = $contribution->id;
            if(isset($totals[$contribution->donor_id])) {
                $totals[$contribution->donor_id] = $totals[$contribution->donor_id] + $contribution->amount;
            } else {
                $totals[$contribution->donor_id] = $contribution->amount;
            }
        }

        $donors = Donor::all(['id, total_contribution']);

        foreach($totals as $donorId => $total) {
            Donor::where('id', $donorId)
                ->update([
                    'total_contribution' => $total
                ]);
        }

        DonorContribution::whereIn('id', $contributionIds)
            ->update([
                'processed' => true
            ]);
    }

    /*
     * $months = 1;

            if($contribution->divide_monthly && $contribution->amount > config('donor.monthly_contribution')) {
                $months = ceil($contribution->amount/config('donor.monthly_contribution'));
            }

            for($i=0; $i<$months;$i++) {
                if($contribution->amount > config('donor.monthly_contribution')) {
                    $amount = 8000;
                    $remaining =- config('donor.monthly_contribution');
                } else {
                    $amount = $remaining;
                }

                MonthlyContribution::create(
                    [
                        'donor_contribution_id' => $contribution->id,
                        'amount' => $amount,
                    ]
                );

            }
     */
}
