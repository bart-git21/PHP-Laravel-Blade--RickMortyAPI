<?php

use App\Http\Controllers\CharactersController;
use App\Http\Controllers\RickMortyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('characters', CharactersController::class);
Route::get( '/rickmortyapi/{id}', [RickMortyController::class, 'index']);