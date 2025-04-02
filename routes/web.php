<?php

use App\Http\Controllers\RickMortyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get( '/rickmortyapi', [RickMortyController::class, 'index']);