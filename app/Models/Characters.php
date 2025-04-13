<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
