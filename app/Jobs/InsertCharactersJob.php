<?php

namespace App\Jobs;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use App\Models\Characters;
use App\Models\JobStatus;

class InsertCharactersJob implements ShouldQueue
{
    use Queueable;
    public $tries = 3;
    public $timeout = 300;
    protected $job_id;
    protected $url;

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
        // clear table
        DB::table('characters')->delete();

        // insert job status into jobStatus table
        JobStatus::updateOrCreate(
            ['job_id' => $this->job_id],
            ['status' => 'processing']
        );

        //get characters from external rickmorty API and insert into database
        $this->getCharacters($this->url);

        // update job status for client side
        JobStatus::updateOrCreate(
            ['job_id' => $this->job_id],
            ['status' => 'completed']
        );
    }

    protected function getCharacters(string $url): void
    {
        $response = Http::withOptions(['verify' => false])->get($url);
        $json = $response->json();
        $results = $json['results'];
        foreach ($results as $key => $result) {
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
