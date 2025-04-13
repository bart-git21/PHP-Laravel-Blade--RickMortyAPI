<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
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
        $jobId = Str::uuid()->toString();
        $url = 'https://rickandmortyapi.com/api/';
        InsertRickMortyApiDataJob::dispatch($url);
        return response()->json(['jobId' => $jobId], 201);
    }
}
