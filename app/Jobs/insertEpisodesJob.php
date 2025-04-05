<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use App\Models\Episodes;

class insertEpisodesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
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
    }
}
