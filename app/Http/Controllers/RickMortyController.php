<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
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
        InsertEpisodesJob::dispatch();
        return redirect()->route('root');
    }
}
