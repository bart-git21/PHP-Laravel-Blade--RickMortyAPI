<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Episodes;

class EpisodesController extends Controller
{
    public function index()
    {

    }
    public function store(Request $request)
    {
        $response = Http::withOptions(['verify' => false])->get("https://rickandmortyapi.com/api/episode/");
        $json = $response->json();
        $results = $json['results'];
        foreach ($results as $result) {
            $result['characters'] = str_replace('https://rickandmortyapi.com/api/character/', '', $result['characters']);
            foreach ($result['characters'] as $key => $character) {
                $result['characters'][$key] = intval($character);
            }
            $episodes = new Episodes();
            $episodes->episode_id = $result['id'];
            $episodes->name = $result['name'];
            $episodes->url = $result['url'];
            $episodes->air_date = $result['air_date'];
            $episodes->characters = $result['characters'];
            $episodes->save();
        }
        return redirect()->route('root');
    }
}
