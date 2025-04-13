<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Locations extends Model
{
    protected $table = 'locations';

    protected $fillable = ['location_id', 'location_name', 'residents', 'location_url'];

    protected $casts = [
        'residents' => 'array',
    ];
    public static function clearLocationsTable()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('locations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
    public function selectLocationById($location_id)
    {
        return self::where('location_id', $location_id)->first();
    }
    public function insertLocation($location_id, $location_name, $residents, $location_url)
    {
        $data = [
            'location_id' => $location_id,
            'location_name' => $location_name,
            'residents' => $residents,
            'location_url' => $location_url,
        ];
        return self::create($data);
    }
    public function insertLocationsFromUrl($url) {
        $response = Http::withOptions(['verify' => false])->get($url);
        $json = $response->json();
        $results = $json['results'];

        foreach ($results as $result) {
            $result['residents'] = str_replace('https://rickandmortyapi.com/api/character/', '', $result['residents']);
            foreach ($result['residents'] as $key => $resident) {
                $result['residents'][$key] = intval($resident);
            }
            $this->insertLocation($result['id'], $result['name'], $result['residents'], $result['url']);
        }

        // loop during get all data from external API
        $nextPage = $json['info']['next'];
        if ($nextPage) {
            $this->insertLocationsFromUrl($nextPage);
        }
    }
}
