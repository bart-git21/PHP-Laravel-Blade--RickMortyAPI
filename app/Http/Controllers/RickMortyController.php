<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Jobs\InsertEpisodesJob;

class RickMortyController extends Controller
{
    public function index()
    {
        // 
    }
    public function store()
    {
        InsertEpisodesJob::dispatch();
        return redirect()->route('root');
    }
}
