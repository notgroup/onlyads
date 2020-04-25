<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

/*

https://www.codediesel.com/php/convert-csv-to-excel-format-in-php/
https://github.com/PHPOffice/PhpSpreadsheet
https://github.com/PHPOffice/PhpSpreadsheet/blob/master/samples/Reader/21_Reader_CSV_Long_Integers_with_String_Value_Binder.php
http://kargotakip.deposerileti.com:90/xml.asp?user=7700000423&password=123DEF123&alim_start=24/03/2020&alim_end=26/03/2020

*/

class FileController extends Controller
{

    public function csvToXls(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $reader      = new \PhpOffice\PhpSpreadsheet\Reader\Csv();

/* Set CSV parsing options */
        $reader->setDelimiter(',');
        $reader->setEnclosure('"');
        $reader->setSheetIndex(0);

/* Load a CSV file and save as a XLS */
        $spreadsheet = $reader->load("countries.csv");
        $writer      = new Xls($spreadsheet);
        $writer->save('countries.xls');

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
        return response()->json([]);
    }

}
