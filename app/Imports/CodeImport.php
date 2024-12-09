<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CodeImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {


        $data = [];
       // dd($collection);
        foreach ($collection as $key => $value) {
            if ($key == 0)
                continue;
            $value = $value->toArray();

            if ($key == 2)
                break;


            $qrCode = QrCode::size(50)->generate('Hello, Laravel 11!');

            $data[] = [
                'code' => $value[0],
                'id' => $value[1],
                'img' => $qrCode
            ];

            dd($data) ;


            # code...
        }

        dd($data);
    }
}
