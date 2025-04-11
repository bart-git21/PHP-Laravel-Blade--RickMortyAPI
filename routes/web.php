<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RickMortyController;
use App\Http\Controllers\JobStatusController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProtectedController;
use App\Http\Controllers\FavoriteCharactersController;

Route::get('/', [HomeController::class, 'index'])->name('root');
Route::post('/', [HomeController::class, 'index']);
Route::get('/rickmortyapi', [RickMortyController::class, 'store'])->name('rickmortyapi.store');
Route::get('/jobstatus/{id}', [JobStatusController::class, 'check'])->name('jobstatus.check');
Route::post('/export', [ExportController::class, 'export']);
Route::get('/favorite', [FavoriteCharactersController::class, 'index'])->middleware(['auth'])->name('readFavorite');
Route::post('/favorite', [FavoriteCharactersController::class, 'create'])->middleware(['auth'])->name('createFavorite');
Route::delete('/favorite', [FavoriteCharactersController::class, 'destroy'])->middleware(['auth'])->name('deleteFavorite');

require __DIR__.'/auth.php';
