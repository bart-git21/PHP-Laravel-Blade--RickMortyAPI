<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
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
        $locationUrl = 'https://rickandmortyapi.com/api/location/';
        InsertLocationsJob::dispatch($locationUrl);

        $episodeUrl = 'https://rickandmortyapi.com/api/episode/';
        InsertEpisodesJob::dispatch($episodeUrl);

        $jobId = Str::uuid()->toString();
        $charactersUrl = 'https://rickandmortyapi.com/api/character/';
        InsertCharactersJob::dispatch($jobId, $charactersUrl);

        return response()->json(['jobId' => $jobId], 201);
    }
}
