<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class RickMortyController extends Controller
{
    public function index()
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->get('https://rickandmortyapi.com/api/character/?page=19');
        $characters = $response->json();

        return view('rickmorty', ["characters" => $characters['results']]);
    }
}
