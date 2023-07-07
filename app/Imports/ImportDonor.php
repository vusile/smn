<?php

namespace App\Imports;

use App\Models\Donor;
use App\Models\DonorContribution;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportDonor implements ToCollection
{
    public function collection(Collection $rows)
    {
        $index = 0;
        foreach($rows as $row) {
            $amount = str_replace([','], '', $row[4]);
            if($index != 0) {
                $contributionString = $row[2] . "-" . $row[3] . "-" .  str_replace(['.00'], '', $amount);
                if(!in_array($contributionString, config('donor.upload_exception'))) {
                    $donor = Donor::firstOrCreate(
                        [
                            'phone' => $row[2]
                        ],
                        [
                            'phone' => $row[2],
                            'name' => str_replace($row[2] . " - ", "", $row[1]),
                        ]
                    );


                    DonorContribution::firstOrCreate(
                        [
                            'donor_id' => $donor->id,
                            'contribution_date' => $row[3],
                            'amount' => $amount,
                        ],
                        [
                            'contribution_date' => $row[3],
                            'amount' => $amount,
                            'donor_id' => $donor->id,
                        ]
                    );
                }
            }

            $index += 1;
        }
    }
}
