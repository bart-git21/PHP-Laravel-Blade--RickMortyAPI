<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class RickMortyController extends Controller
{
    public function index($id)
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->get("https://rickandmortyapi.com/api/character/?page=$id");
        $characters = $response->json();

        if ($characters) {
            return view('home')->with(['buttonHidden' => true, 'characters' => $characters['results']]);
        } else {
            return view('home')->with(['buttonHidden' => false, 'error' => $response->json()]);
        }
    }
}
