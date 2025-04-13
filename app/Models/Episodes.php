<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class episodes extends Model
{
    protected $table = 'episodes';

    protected $fillable = ['episode_id', 'name', 'url', 'air_date', 'characters'];

    protected $casts = [
        'characters' => 'array',
    ];
    public static function clearEpisodesTable()
    {
        DB::table('episodes')->truncate();
    }
    public function insertEpisode($episode_id, $name, $url, $air_date, $characters)
    {
        $data = [
            'episode_id' => $episode_id,
            'name' => $name,
            'url' => $url,
            'air_date' => $air_date,
            'characters' => $characters
        ];
        return self::create($data);
    }
    public function insertEpisodesFromUrl($url)
    {
        $response = Http::withOptions(['verify' => false])->get($url);
        $json = $response->json();
        $results = $json['results'];
        foreach ($results as $result) {
            $result['characters'] = str_replace('https://rickandmortyapi.com/api/character/', '', $result['characters']);
            foreach ($result['characters'] as $key => $character) {
                $result['characters'][$key] = intval($character);
            }
            $this->insertEpisode($result['id'], $result['name'], $result['url'], $result['air_date'], $result['characters']);
        }

        // loop during get all data from external API
        $nextPage = $json['info']['next'];
        if ($nextPage) {
            $this->insertEpisodesFromUrl($nextPage);
        }
    }
}
