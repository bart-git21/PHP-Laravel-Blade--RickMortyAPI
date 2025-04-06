<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Characters;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Status');
        $sheet->setCellValue('D1', 'Location');

        // Fetch data
        $request_table = json_decode($request->table);

        // fill the excel sheet
        $row = 2; // Start from the second row
        foreach ($request_table as $request_row) {
            $sheet->setCellValue('A' . $row, $request_row->character_id);
            $sheet->setCellValue('B' . $row, $request_row->name);
            $sheet->setCellValue('C' . $row, $request_row->status);
            $sheet->setCellValue('D' . $row, $request_row->location_name);
            $row++;
        }

        // Save the file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'filtered_characters.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}
