<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
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
        $locations->insertLocationsFromUrl($this->url);
    }
}
