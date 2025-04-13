<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Characters extends Model
{
    protected $table = 'characters';

    protected $fillable = ['character_id', 'name', 'status', 'species', 'gender', 'location_id', 'episodes_id', 'img_href'];

    protected $casts = [
        'episodes_id' => 'array'
    ];
    public static function clearCharactersTable()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('characters')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
    protected function insertCharacter($character_id, $name, $status, $species, $gender, $location_id, $episodes_id, $img_href)
    {
        $data = [
            'character_id' => $character_id,
            'name' => $name,
            'status' => $status,
            'species' => $species,
            'gender' => $gender,
            'location_id' => $location_id,
            'episodes_id' => $episodes_id,
            'img_href' => $img_href,
        ];
        return self::create($data);
    }
    public function insertCharactersFromUrl($url)
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
            $this->insertCharacter($result['id'], $result['name'], $result['status'], $result['species'], $result['gender'], $result['location'], $result['episode'], $result['image']);
        }

        // loop during get all data from external API
        $nextPage = $json['info']['next'];
        if ($nextPage) {
            $this->insertCharactersFromUrl($nextPage);
        }
    }

    public function getAllCharacters()
    {
        return Characters::
            select('characters.*', 'locations.location_name')
            ->leftJoin('locations', 'characters.location_id', '=', 'locations.location_id')
            ->get();
    }

    public function getFilteredCharactes($name, $options, $episode, $location)
    {
        return Characters::
            where('name', 'LIKE', "%$name%")
            ->where('status', 'LIKE', "%$options%")
            ->when($episode, function ($query) use ($episode) {
                return $query->whereRaw('JSON_CONTAINS(episodes_id, CAST(? AS JSON))', [$episode]);
            })
            ->select('characters.*', 'locations.location_name')
            ->leftJoin('locations', 'characters.location_id', '=', 'locations.location_id')
            ->where('location_name', 'LIKE', "%$location%")
            ->orderBy('character_id', 'asc')
            ->get();
    }

    public function getPaginatedCharacters($offset, $step, $name, $options, $episode, $location)
    {
        return Characters::
            where('name', 'LIKE', "%$name%")
            ->where('status', 'LIKE', "%$options%")
            ->when($episode, function ($query) use ($episode) {
                return $query->whereRaw('JSON_CONTAINS(episodes_id, CAST(? AS JSON))', [$episode]);
            })
            ->select('characters.*', 'locations.location_name')
            ->leftJoin('locations', 'characters.location_id', '=', 'locations.location_id')
            ->where('location_name', 'LIKE', "%$location%")
            ->orderBy('character_id', 'asc')
            ->offset($offset * $step)
            ->limit($step)
            ->get();
    }
}
