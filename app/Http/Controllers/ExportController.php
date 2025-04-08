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
        $data = $request->json()->all();
        $request_table = $data['table'] ?? null;

        // fill the excel sheet
        $row = 2; // Start from the second row
        foreach ($request_table as $request_row) {
            $sheet->setCellValue('A' . $row, $request_row["character_id"]);
            $sheet->setCellValue('B' . $row, $request_row["name"]);
            $sheet->setCellValue('C' . $row, $request_row["status"]);
            $sheet->setCellValue('D' . $row, $request_row["location_name"]);
            $row++;
        }

        // Save to a temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'export');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Read the file and encode as base64
        $fileData = base64_encode(file_get_contents($tempFile));
        unlink($tempFile); // Delete the temp file

        return response()->json([
            'success' => true,
            'fileData' => $fileData
        ]);
    }
}
