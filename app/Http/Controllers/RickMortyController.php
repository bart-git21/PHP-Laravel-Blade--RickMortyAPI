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
        InsertLocationsJob::dispatch();
        InsertEpisodesJob::dispatch();
        return redirect()->route('root');
    }
}
