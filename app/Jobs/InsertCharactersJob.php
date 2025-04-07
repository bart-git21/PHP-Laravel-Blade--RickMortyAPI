<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use App\Models\Characters;

class InsertCharactersJob implements ShouldQueue
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
        $this->getCharacters($this->url);
    }

    protected function getCharacters(string $url): void
    {
        $response = Http::withOptions(['verify' => false])->get($url);
        $json = $response->json();
        $results = $json['results'];
        foreach ($results as $result) {
            $result['location'] = intval(str_replace('https://rickandmortyapi.com/api/location/', '', $result['location']['url']));
            $result['episode'] = str_replace('https://rickandmortyapi.com/api/episode/', '', $result['episode']);
            foreach ($result['episode'] as $key => $episode) {
                $result['episode'][$key] = intval($episode);
            }
            $characters = new Characters();
            $characters->character_id = $result['id'];
            $characters->name = $result['name'];
            $characters->status = $result['status'];
            $characters->species = $result['species'];
            $characters->gender = $result['gender'];
            $characters->location_id = $result['location'];
            $characters->episodes_id = $result['episode'];
            $characters->img_href = $result['image'];
            $characters->save();
        }

        // loop during get all data from external API
        $nextPage = $json['info']['next'];
        if ($nextPage) {
            $this->getCharacters($nextPage);
        }
    }
}
