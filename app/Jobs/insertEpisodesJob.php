<?php

namespace App\Jobs;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use App\Models\Episodes;

class insertEpisodesJob implements ShouldQueue
{
    use Queueable;

    public $tries = 3;
    public $timeout = 120;
    protected $url;

    /**
     * Create a new job instance.
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // clear table
        DB::table('episodes')->delete();
        
        //get episodes from external rickmorty API and insert into database
        $this->getEpisodes($this->url);
    }

    protected function getEpisodes($url)
    {
        $response = Http::withOptions(['verify' => false])->get($url);
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

        // loop during get all data from external API
        $nextPage = $json['info']['next'];
        if ($nextPage) {
            $this->getEpisodes($nextPage);
        }
    }
}
