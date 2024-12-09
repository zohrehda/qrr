<?php

use App\Exports\UsersExport;
use App\Imports\CodeImport;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/', function () {

  //  dd('ff');

  $ee = Excel::toArray(new CodeImport, storage_path('app/filee.csv'), null, \Maatwebsite\Excel\Excel::CSV);
  //$ee = Excel::queueImport(new CodeImport, storage_path('app/filee.csv'), null, \Maatwebsite\Excel\Excel::CSV);
  $data = array_slice($ee[0], 1);

  // dd($data);

  // $export = new UsersExport($data);
  //return $export->queue("invoices.xlsx");

  //  dd('ff');
  // return Excel::download($export, "invoices.xlsux");

  $chunks = array_chunk($data, 1000);

 // dd($chunks[0]);

  foreach ($chunks as $key => $value) {

    if ($key == 1)
      break;

    $export = new UsersExport($data);
    return Excel::download($export, "invoices-$key.xlsx");
  }





});
