<?php

use App\Imports\CodeImport;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/', function () {

  //  Excel::import(new CodeImport,storage_path('app/file2.xlsx')  ) ;


  $qrCode = QrCode::format('png')->size(200)->generate('fffff');

  $ee = file_put_contents('fdf.png', $qrCode);
  dd($ee);
  dd($qrCode);

  return response($qrCode)->header('Content-Type', 'image/svg+xml');
});
