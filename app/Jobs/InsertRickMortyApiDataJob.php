<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Characters;
use App\Models\Episodes;
use App\Models\JobStatus;
use App\Models\Locations;
use App\Models\FavoriteCharacters;

class InsertRickMortyApiDataJob implements ShouldQueue
{
    use Queueable;

    public $tries = 1;
    public $timeout = 300;
    protected $url;
    protected $job_id;

    /**
     * Create a new job instance.
     */
    public function __construct($job_id, $url)
    {
        $this->job_id = $job_id;
        $this->url = $url;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // insert job status into jobStatus table
        JobStatus::updateOrCreate(
            ['job_id' => $this->job_id],
            ['status' => 'processing']
        );

        // clear tables
        FavoriteCharacters::clearFavoriteCharactersTable();
        Characters::clearCharactersTable();
        Locations::clearLocationsTable();
        Episodes::clearEpisodesTable();

        // insert the data from external rickmorty API into database
        $locations = new Locations();
        if ($locations->selectLocationById(0) === null) {
            $locations->insertLocation(0, 'unknown', '[]', ''); // create empty 'unknown' location
        }
        $locations->insertLocationsFromUrl("$this->url/location/");
        (new Episodes())->insertEpisodesFromUrl("$this->url/episode/");
        (new Characters())->insertCharactersFromUrl("$this->url/character/");

        // update job status for client side
        JobStatus::updateOrCreate(
            ['job_id' => $this->job_id],
            ['status' => 'completed']
        );
    }
}
