<?php

namespace App\Exports;

use App\Imports\CodeImport;
use App\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;



class UsersExport implements FromArray, WithEvents, WithDrawings 
{
    use Exportable;
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }
    public function drawings()
    {
        $array = [];

        foreach ($this->data as $k => $v) {
            $id = $v[1];
            $qrCode = QrCode::format('png')->size(50)->generate($id);
            //  $file_name = $id . '.png';
            //   $file_name = 'test.png';
            //    $file_name = storage_path($file_name);
            //    file_put_contents($file_name, $qrCode);
            // $drawing = new Drawing();
            $drawing = new MemoryDrawing();
            $drawing->setName('Logo');
            $drawing->setDescription('This is my logo');
            //            $drawing->setPath($file_name);
            $drawing->setImageResource(imagecreatefromstring($qrCode));
            $drawing->setHeight(height: 50);
            $drawing->setCoordinates('C' . $k);
            $array[] = $drawing;

            // unlink($file_name);
        }

        return $array;
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet;
                $imageHeight = 50; // Set the height of the image (same as the image's height)
    
                // Loop through all rows and set the row height to match the image height
                $highestRow = $sheet->getHighestRow(); // Get the highest row number in the sheet
    
                for ($row = 1; $row <= 105; $row++) {
                    // Set the height of each row based on the image height
                    $sheet->getRowDimension($row)->setRowHeight($imageHeight);
                }

                // Optionally, adjust the column width to fit the image
                $sheet->getColumnDimension('A')->setWidth($imageHeight / 7); // Adjust width as necessary
            },
        ];
    }

}
?>