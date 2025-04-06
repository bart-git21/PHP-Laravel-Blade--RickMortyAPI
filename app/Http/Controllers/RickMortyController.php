<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Jobs\InsertCharactersJob;
use App\Jobs\InsertLocationsJob;
use App\Jobs\InsertEpisodesJob;

class RickMortyController extends Controller
{
    public function index()
    {
        // 
    }
    public function store()
    {
        $charactersUrl = 'https://rickandmortyapi.com/api/character/';
        InsertCharactersJob::dispatch($charactersUrl);
        $locationUrl = 'https://rickandmortyapi.com/api/location/';
        InsertLocationsJob::dispatch($locationUrl);
        $episodeUrl = 'https://rickandmortyapi.com/api/episode/';
        InsertEpisodesJob::dispatch($episodeUrl);
        return redirect()->route('root');
    }
}
