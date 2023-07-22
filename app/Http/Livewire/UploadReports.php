<?php

namespace App\Http\Livewire;

use App\Imports\ImportDonor;
use App\Jobs\ProcessReport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class UploadReports extends Component
{
    use WithFileUploads;

    public $report;

    public $successMessage;

    public function render()
    {
        return view('livewire.upload-reports');
    }

    public function submit()
    {
        $this->report->store('uploads/reports');
//        dd($this->report->hashName());
        ProcessReport::dispatch('uploads/reports/' . $this->report->hashName());
//        Excel::import(new ImportDonor, 'uploads/reports/' . $this->report->hashName());
        $this->successMessage = "File tayari!. Tafadhali kidogo tuandae ripoti";
    }
}
