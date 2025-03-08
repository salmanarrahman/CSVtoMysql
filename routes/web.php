<?php
use App\Http\Controllers\CsvUploadController;
use App\Http\Controllers\PopulationController;
use Illuminate\Support\Facades\Route;

Route::get('/upload', function () {
    return view('upload');
});
Route::get('/', [PopulationController::class, 'index'])->name('home');
Route::post('/', [PopulationController::class, 'getPopulation'])->name('get.population');
Route::post('/upload', [CsvUploadController::class, 'uploadCSV'])->name('csv.upload');
