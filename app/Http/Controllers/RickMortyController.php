<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Jobs\InsertRickMortyApiDataJob;

class RickMortyController extends Controller
{
    public function store()
    {
        $jobId = Str::uuid()->toString();
        $url = 'https://rickandmortyapi.com/api/';
        InsertRickMortyApiDataJob::dispatch($jobId, $url);
        return response()->json(['jobId' => $jobId], 201);
    }
}
