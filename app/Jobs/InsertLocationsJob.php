<?php

namespace App\Jobs;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use App\Models\Characters;
use App\Models\Episodes;
use App\Models\Locations;
use App\Models\FavoriteCharacters;

class InsertLocationsJob implements ShouldQueue
{
    use Queueable;

    public $tries = 1;
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
        // clear tables
        FavoriteCharacters::clearFavoriteCharactersTable();
        Characters::clearCharactersTable();
        Locations::clearLocationsTable();
        Episodes::clearEpisodesTable();

        // create empty 'unknown' location
        $locations = new Locations();
        if ($locations->selectLocationById(0) === null) {
            $locations->insertLocation(0, 'unknown', '[]', '');
        }

        //get locations from external rickmorty API and insert into database
        $this->getLocations($this->url);
    }
    protected function getLocations($url)
    {
        $response = Http::withOptions(['verify' => false])->get($url);
        $json = $response->json();
        $results = $json['results'];

        foreach ($results as $result) {
            $result['residents'] = str_replace('https://rickandmortyapi.com/api/character/', '', $result['residents']);
            foreach ($result['residents'] as $key => $resident) {
                $result['residents'][$key] = intval($resident);
            }
            $locations = new Locations();
            $locations->location_id = $result['id'];
            $locations->location_name = $result['name'];
            $locations->residents = $result['residents'];
            $locations->location_url = $result['url'];
            $locations->save();
        }

        // loop during get all data from external API
        $nextPage = $json['info']['next'];
        if ($nextPage) {
            $this->getLocations($nextPage);
        }
    }
}
