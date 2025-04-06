<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RickMortyController;
use App\Http\Controllers\ExportController;

Route::get('/', [HomeController::class, 'index'])->name('root');
Route::post('/', [HomeController::class, 'index']);
Route::get('/rickmortyapi', [RickMortyController::class, 'store'])->name('rickmortyapi.store');
Route::post('/export', [ExportController::class, 'export']);