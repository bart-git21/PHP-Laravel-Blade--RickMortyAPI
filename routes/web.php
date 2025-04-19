<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RickMortyController;
use App\Http\Controllers\JobStatusController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FavoriteCharactersController;

Route::get('/', [HomeController::class, 'index'])->name('root');
Route::post('/', [HomeController::class, 'index']);
Route::get('/rickmortyapi', [RickMortyController::class, 'store'])->name('rickmortyapi.store');
Route::get('/jobstatus/{id}', [JobStatusController::class, 'check'])->name('jobstatus.check');
Route::post('/export', [ExportController::class, 'export']);
Route::resource('favorite', FavoriteCharactersController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
