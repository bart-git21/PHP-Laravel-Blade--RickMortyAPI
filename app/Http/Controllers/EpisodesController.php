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
        $id = $request['getEpisode'];
        $response = Http::withOptions(['verify' => false])->get("https://rickandmortyapi.com/api/episode/$id");
        $json = $response->json();
        $json['characters'] = str_replace('https://rickandmortyapi.com/api/character/', '', $json['characters']);
        foreach ($json['characters'] as $key => $character) {
            $json['characters'][$key] = intval($character);
        }
        $episodes = new Episodes();
        $episodes->episode_id = $json['id'];
        $episodes->name = $json['name'];
        $episodes->url = $json['url'];
        $episodes->air_date = $json['air_date'];
        $episodes->characters = $json['characters'];
        $episodes->save();
        return redirect()->route('root');
    }
}
