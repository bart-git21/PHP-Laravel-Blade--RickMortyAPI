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
        $requestName = $data['name'] || '';
        $requestStatus = $data['options'] || '';
        $requestEpisode = $data['episode'] || '';
        $requestLocation = $data['location'] || '';

        $characters = (new Characters)->getFilteredCharactes($requestName, $requestStatus, $requestEpisode, $requestLocation);

        // // fill the excel sheet
        $row = 2; // Start from the second row
        foreach ($characters as $single) {
            $sheet->setCellValue('A' . $row, $single["character_id"]);
            $sheet->setCellValue('B' . $row, $single["name"]);
            $sheet->setCellValue('C' . $row, $single["status"]);
            $sheet->setCellValue('D' . $row, $single["location_name"]);
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
