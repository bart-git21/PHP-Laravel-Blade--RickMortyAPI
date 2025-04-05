<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RickMortyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('root');
Route::get('/rickmortyapi', [RickMortyController::class, 'store'])->name('rickmortyapi.store');