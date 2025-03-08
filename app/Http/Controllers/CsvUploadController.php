<?php

namespace App\Http\Controllers;

use App\Models\Population;
use Illuminate\Http\Request;

class CsvUploadController extends Controller
{
    public function uploadCSV(Request $request){

        $errors = [];
        $years = null;

        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        $sjisData = file_get_contents($path);
        $utf8Data = mb_convert_encoding($sjisData, "UTF-8", "SJIS-win");
        $tempPath = storage_path('app/temp_utf8.csv');
        file_put_contents($tempPath, $utf8Data);
        $fileHandle = fopen($tempPath, 'r');

        while (($row = fgetcsv($fileHandle, 0, ",")) !== false) {
            if (empty($row) || count($row) < 2) {
                continue;
            }
            if (is_numeric(trim($row[1]))) {
                $years = $row;
                break;
            }
        }
        if (!$years) {
            fclose($fileHandle);
            return back()->with('error', 'Invalid CSV format: No valid header row found.');
        }
        try {
            while (($row = fgetcsv($fileHandle)) !== false) {
                $prefecture = trim($row[0]);
                if (empty($row) || count($row) < 2) {
                    continue;
                }
                for ($i = 1; $i < count($row); $i++) {
                    $data =([
                        'year' => $years[$i],
                        'prefecture' => $prefecture,
                        'population' => (int) str_replace(',', '', $row[$i]),
                    ]);
                    try {
                        Population::create($data);
                    }catch (\Illuminate\Database\QueryException $e){
                        if ($e->errorInfo[1] == 1062) { // MySQL duplicate entry error code
                            $errors[] = "Duplicate entry for Year: {$data['year']}, Prefecture: {$data['prefecture']}, Population: {$data['population']}.";
                        } else {
                            throw $e;
                        }
                    }
                }
            }
            fclose($fileHandle);
            if (empty($errors)) {
                return back()->with('success', 'CSV imported successfully!');
            } else {
                return back()->with('error', implode('<br>', $errors));
            }
        }catch (\Exception $e) {
            fclose($fileHandle);
            return back()->with('error', 'Sorry,Invalid CSV format:');
        }
    }
}
