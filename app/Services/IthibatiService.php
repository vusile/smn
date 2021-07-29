<?php

namespace App\Services;

use App\Models\Song;
use setasign\Fpdi\Fpdi;

class IthibatiService
{
    function printIthibatiNumberOnPdf(Song $song, $pdfName = null) {

        if(!$pdfName) {
            $pdfName = $song->pdf;
        }

        $path = storage_path('app/public/' . config('song.files.paths.pdf') . $pdfName);
        $savePath = storage_path('app/public/' . config('song.files.paths.pdf') . 'ithibati-' . $pdfName);

        $pdf = new Fpdi();

        $pageCount = $pdf->setSourceFile(
            $path
        );

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            // import a page
            $templateId = $pdf->importPage($pageNo);

            $pdf->AddPage();
            // use the imported page and adjust the page size
            $pdf->useTemplate($templateId, ['adjustPageSize' => false]);

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(10, 5);
            $pdf->Write(8, 'Namba ya Ithibati: ' . $song->ithibati_number);
        }
        $pdf->Output($savePath, 'F');
    }
}
