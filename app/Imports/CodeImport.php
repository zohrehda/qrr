<?php

namespace App\Imports;

use App\Exports\UsersExport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class CodeImport implements ToArray
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

    }

    public function array(array $array)
    {

       // $export = new UsersExport($array);

       // $export->queue("invoices-" . rand(0, 100000) . "xlsx");
        
        // Excel::download($export, "invoices-" . rand(0, 100000) . "xlsx");

        //  dd($array) ;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function progressBar($progressBar)
    {
        $progressBar->advance();
    }


}
