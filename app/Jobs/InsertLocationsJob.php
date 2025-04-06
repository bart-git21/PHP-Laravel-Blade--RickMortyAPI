<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use App\Models\Locations;

class InsertLocationsJob implements ShouldQueue
{
    use Queueable;

    public $tries = 3;
    public $timeout = 120;

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
        $response = Http::withOptions(['verify' => false])->get("https://rickandmortyapi.com/api/location/");
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
    }
}
